<?php

session_start();

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

$stmt = $mysqli->prepare("INSERT INTO Interests(id,Sports,Movies,Books,VideoGames,Music,Science,Art,Food,Fashion,Anime,Computers)
                          VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("siiiiiiiiiii", $id_var, $values_to_add[0], $values_to_add[0], $values_to_add[0], $values_to_add[0],
                  $values_to_add[0], $values_to_add[0], $values_to_add[0], $values_to_add[0], $values_to_add[0],
                  $values_to_add[0], $values_to_add[0]);
$stmt->execute();

$mysqli->close();





 ?>
