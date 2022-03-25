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
$record = array("","","","","","","","","","","","");

$get1_stmt = $mysqli->prepare("SELECT * FROM Interests WHERE id=?");
$get1_stmt->bind_param("s", $id_var);
$get1_stmt->execute();
$get1_stmt->bind_result($record[0],$record[1],$record[2],$record[3],$record[4],$record[5],
                        $record[6],$record[7],$record[8],$record[9],$record[10],$record[11],);
$get1_stmt->fetch();
$get1_stmt->close();

$interests = array("Sports", "Movies", "Books", "VideoGames", "Music", "Science", "Art",
                    "Food", "Fashion", "Anime", "Computers");

for ($x = 0; $x < 11; $x++) {
  switch($record[$x+1]) {
    case 3:
      $choice1 = $interests[$x];
      break;
    case 2:
      $choice2 = $interests[$x];
      break;
    case 1:
      $choice3 = $interests[$x];
      break;
    default:
      break;

  }
}
$choices = array($choice1, $choice2, $choice3);
$other_users = array();
var_dump($other_users);

$stmt = $mysqli->prepare("SELECT * FROM Interests WHERE NOT id = ?");
$stmt->bind_param("s",$id_var);
for ($x = 0; $x < 3; $x++) {
  $stmt->execute();
  $result = $stmt->get_result();
  while ($rows = $result->fetch_array(MYSQLI_ASSOC)){
    foreach($rows as $row) {
      if ($row[$choice[$x]] > 0) {
        if(array_key_exists($row['id'], $other_users)){
          $other_users[$row['id']] = $other_users[$row['id']] + (3-$x);
        } else {
          $other_users[$row['id']] = 3-$x;
        }
      }
    }
  }
}
var_dump($other_users);






 ?>
