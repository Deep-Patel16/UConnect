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

$name = $_GET['username'];
$_SESSION["id"] = $_GET['email'];
$password = $_GET['password'];

$stmt = $mysqli->prepare("INSERT INTO Users (username, password, id) VALUES (?,?,?)");
$hashed= hash('sha256',$password);
$stmt->bind_param("sss", $name, $hashed, $_SESSION["id"]);
$stmt->execute();



$mysqli->close();

?>
