<?php
session_start();
?>





<?php

require_once('../config.inc.php');

header('Location: ../Profile_page/profilepage.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}

$name = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$hashed_pass= hash('sha256',$password);
$hashed_id=hash('sha256',$email);

$stmt = $mysqli->prepare("INSERT INTO Users (username, password, id, email) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $name, $hashed_pass, $hashed_id, $email);
$stmt->execute();


$mysqli->close();

?>
