<?php

	require_once('../config.inc.php');

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

	if($mysqli -> connect_error) {
    	die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
	}

	$id = $_GET['email'];
	$password = $_GET['password'];

	$stmt = $mysqli->query("SELECT password FROM Users WHERE id=?");
	$stmt->bind_param('s', $id);
	$value = $stmt->execute();

	if ((is_null($value)) || ($value == $password)) {
		echo("Incorrect password");
	} else {
		echo("Correct password");
	}