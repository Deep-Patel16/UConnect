<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://codepen.io/P1N2O/pen/xxbjYqx.css'><link rel="stylesheet" href="./style.css">

</head>


<body>
<!-- partial:index.partial.html -->
<?php
$id_var=$_SESSION['id'];
require_once('../config.inc.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);
$_SESSION['sqli'] = $mysqli;
if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}

$stmt = $_SESSION['sqli']->prepare("SELECT username FROM Users WHERE id=?");
$stmt->bind_param('s', $id_var);
$stmt->execute();
$stmt->bind_result($value);
$stmt->fetch();
echo("Logged in as " . $value);
?>
<div class="puzzles">
  <a href="../Profile_page/profilepage.php">
  <div class="jigsaw1 grid">
      <span class="t"></span>
      <span class="r"></span>
      <span class="b"></span>
      <span class="l"></span>
      <span class="text">Profile</span>
  </div>
  </a>
  <div class="jigsaw3 grid">
      <span class="t"></span>
      <span class="r"></span>
      <span class="b"></span>
      <span class="l"></span>
      <span class="text">Notifications</span>
  </div>
  <a href="../Friends_page/final.html">
  <div class="jigsaw2 grid">
      <span class="t"></span>
      <span class="r"></span>
      <span class="b"></span>
      <span class="l"></span>
      <span class="text">Friends</span>
  </div>
</a>
  <div class="jigsaw4 grid">
      <span class="t"></span>
      <span class="r"></span>
      <span class="b"></span>
      <span class="l"></span>
      <span class="text">Settings</span>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" integrity="sha256-qM7QTJSlvtPSxVRjVWNM2OfTAz/3k5ovHOKmKXuYMO4=" crossorigin="anonymous"></script>
<!-- partial -->
  <script  src="./script.js"></script>


</body>
</html>
