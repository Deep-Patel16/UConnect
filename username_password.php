<?php

require_once('config.inc.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}

$sql = "INSERT INTO user_data (username, password, id)
        VALUES ('SteveJobs', 'pass', 111)";

if($mysqli->query($sql) === TRUE) {
  echo ("Record added successfully");
} else {
  echo ("Record failed to add");
}

$mysqli->close();

?>
