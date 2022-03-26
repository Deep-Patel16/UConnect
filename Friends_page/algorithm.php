<?php

session_start();

?>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="footer/fonts/icomoon/style.css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="footer/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- Style CSS -->
<link rel="stylesheet" href="footer/css/style.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

<link rel="stylesheet" href="fonts/icomoon/style.css">

<link rel="stylesheet" href="css/owl.carousel.min.css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- Style -->

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="friends.css">
<link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

<?php
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

$stmt = $mysqli->prepare("SELECT * FROM Interests WHERE NOT id = ?");
$stmt->bind_param("s",$id_var);
for ($x = 0; $x < 3; $x++) {
  $stmt->execute();
  $result = $stmt->get_result();
  while ($rows = $result->fetch_all(MYSQLI_ASSOC)){
    foreach($rows as $row) {
      if ($row[$choices[$x]] > 0) {
        if(array_key_exists($row['id'], $other_users)){
          $other_users[$row['id']] = $other_users[$row['id']] + (3-$x);
        } else {
          $other_users[$row['id']] = 3-$x;
        }
      }
    }
  }
}
arsort($other_users);
$stmt->close();

?>

 <!-- Gallery item -->
<?php
 foreach($other_users as $id=>$score) {
   $stmt = $mysqli->prepare("SELECT Profile_Image FROM Profile_Images WHERE ID=?");
   $stmt->bind_param("s", $id);
   $stmt->bind_result($result);
   $stmt->execute();
   $img = $result->fetch_assoc();
   header('Content-type: image/jpeg');
   imagejpeg($img['image']);
   $stmt->close();

   $details_stmt = $mysqli->prepare("SELECT Forename, Surname, Course FROM Users WHERE id=?");
   $details_stmt->bind_param("s", $id);
   $details_stmt->bind_result($fname, $sname, $course);
   $details_stmt->execute();
   $details_stmt->close();

   echo('<div class="col-xl-3 col-lg-4 col-md-6 mb-4">
       <div class="card p-0">
           <div class="card-image"> <img src=" '.$img["image"] . '" alt=""> </div>
           <div class="card-content d-flex flex-column align-items-center">
               <h4 class="pt-2">'. $fname . ' ' . $sname . ' </h4>
               <h5>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu</h5>
               <ul class="social-icons d-flex justify-content-center">
                   <li style="--i:1"> <a href="https://google.com"  target="_blank"> <span class="fab fa-facebook"></span> </a> </li>
                   <li style="--i:2"> <a href="#"> <span class="fab fa-linkedin"></span> </a> </li>
                   <li style="--i:3"> <a href="#"> <span class="fab fa-instagram"></span> </a> </li>
                   <li style="--i:4"> <a href="#"> <span class="fab fa-snapchat"></span> </a> </li>
               </ul>
           </div>
       </div>
   </div>
 <!-- End -->');
 } ?>
