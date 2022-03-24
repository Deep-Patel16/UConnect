<?php

session_start();

header('Location: profilepage.php');

$id_var = $_SESSION['id'];

require_once('../config.inc.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);
$_SESSION['sqli'] = $mysqli;
if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}

$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];
$choice3 = $_POST['choice3'];

$forename = $_POST['forename'];
$surname = $_POST['surname'];
$course = $_POST['course'];

$choices = array($choice1, $choice2, $choice3);

$values_to_add = array(0,0,0,0,0,0,0,0,0,0,0);

for ($x = 0; $x < 3; $x++) {
  switch ($choices[$x]) {
    case "Sports":
      $values_to_add[0] = 3-$x;
      break;
    case "Movies":
      $values_to_add[1] = 3-$x;
      break;
    case "Books":
      $values_to_add[2] = 3-$x;
      break;
    case "Video Games":
      $values_to_add[3] = 3-$x;
      break;
    case "Music":
      $values_to_add[4] = 3-$x;
      break;
    case "Science":
      $values_to_add[5] = 3-$x;
      break;
    case "Art":
      $values_to_add[6] = 3-$x;
      break;
    case "Food":
      $values_to_add[7] = 3-$x;
      break;
    case "Fashion":
      $values_to_add[8] = 3-$x;
      break;
    case "Anime":
      $values_to_add[9] = 3-$x;
      break;
    case "Computers":
      $values_to_add[10] = 3-$x;
      break;
  }
}

$profile_stmt = $mysqli->prepare("UPDATE Users SET Forename=?, Surname=?, Course=? WHERE id=?");
$profile_stmt->bind_param("ssss", $forename, $surname, $course, $id_var);
$profile_stmt->execute();
$profile_stmt->close();

$select_stmt = $mysqli->prepare("SELECT id FROM Interests WHERE id=?");
$select_stmt->bind_param("s", $id_var);
$select_stmt->execute();
$select_stmt->bind_result($is_id);
$select_stmt->fetch();
$select_stmt->close();

if (is_null($is_id)) {
  $stmt = $mysqli->prepare("INSERT INTO Interests(id,Sports,Movies,Books,VideoGames,Music,Science,Art,Food,Fashion,Anime,Computers)
                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
  $stmt->bind_param("siiiiiiiiiii", $id_var, $values_to_add[0], $values_to_add[1], $values_to_add[2], $values_to_add[3],
                    $values_to_add[4], $values_to_add[5], $values_to_add[6], $values_to_add[7], $values_to_add[8],
                    $values_to_add[9], $values_to_add[10]);

} else {
  $stmt = $mysqli->prepare("UPDATE Interests SET Sports=?,
                                                  Movies=?,
                                                  Books=?,
                                                  VideoGames=?,
                                                  Music=?,
                                                  Science=?,
                                                  Art=?,
                                                  Food=?,
                                                  Fashion=?,
                                                  Anime=?,
                                                  Computers=?
                                                  WHERE id=?");
  $stmt->bind_param("iiiiiiiiiiis", $values_to_add[0], $values_to_add[1], $values_to_add[2], $values_to_add[3],
                    $values_to_add[4], $values_to_add[5], $values_to_add[6], $values_to_add[7], $values_to_add[8],
                    $values_to_add[9], $values_to_add[10], $id_var);
}
$stmt->execute();
$stmt->close();



$image = $_POST["image_input"];
$img_content = addslashes(file_get_contents($image));
$select_stmt = $mysqli->prepare("SELECT id FROM Profile_Images WHERE id=?");
$select_stmt->bind_param("s", $id_var);
$select_stmt->execute();
$select_stmt->bind_result($is_id1);
$select_stmt->fetch();
$select_stmt->close();
if (is_null($is_id1)) {
  $stmt = $mysqli->prepare("INSERT INTO Profile_Images(ID,Profile_Image) VALUES (?,?)");
  $stmt->bind_param("sb",$id_var,$img_content);
} else{
  $stmt = $mysqli->prepare("UPDATE Profile_images SET Profile_Image=? WHERE id=?");
  $stmt->bind_param("sb",$id_var,$img_content);
}

$stmt->execute();
$stmt->close();


$mysqli->close();





 ?>
