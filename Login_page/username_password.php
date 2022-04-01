<?php
session_start();
?>





<?php

require_once('../config.inc.php');



mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}

$name = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$email_check = explode('@', $email);
if ($email_check[1] != "student.manchester.ac.uk") {
  header('Location: index.html');
} else {


  $stmt = $mysqli->prepare("SELECT email FROM Users WHERE email==?");
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $stmt->bind_result($find_email);
  $stmt->fetch();
  $stmt->close();
  if (!is_null($find_email)) {
    header('Location: index.html');
  } else {
    header('Location: ../Profile_page/profile.php');
    $hashed_pass= hash('sha256',$password);
    $hashed_id=hash('sha256',$email);
    $_SESSION['id'] = $hashed_id;

    $stmt = $mysqli->prepare("INSERT INTO Users (username, password, id, email) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $name, $hashed_pass, $hashed_id, $email);
    $stmt->execute();
  }


}




$mysqli->close();

?>
