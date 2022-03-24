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

echo($record[3]);


 ?>
