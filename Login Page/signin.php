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

	$_SESSION["id"] = $_GET['email'];
	$password = $_GET['password'];

	$stmt = $mysqli->prepare("SELECT password FROM Users WHERE id=?");
	$stmt->bind_param('s', $_SESSION['id']);
	$stmt->execute();
	$stmt->bind_result($value);
	$stmt->fetch();


	if ((is_null($value)) || ($value != hash('sha256',$password))) {
		echo("Incorrect password");
	} else {
		echo("Correct password");
	}
