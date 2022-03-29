<?php
session_start();

// getting data needed to display the stored data in the dropdowns
$id_var = $_SESSION['id'];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);
$_SESSION['sqli'] = $mysqli;
if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);

$dropdown_statement=$mysqli->prepare("SELECT id,Sports,Movies,Books,VideoGames,Music,Science,Art,Food,Fashion,Anime,Computers FROM Interests WHERE id=?");
$dropdown_statement->bind_param("s", $id_var);
$dropdown_statement->execute();
$dropdown_statement->bind_result($drop);
$drop1_array = array(null,null,null,null,null,null,null,null,null,null,null);
$drop2_array = array(null,null,null,null,null,null,null,null,null,null,null);
$drop3_array = array(null,null,null,null,null,null,null,null,null,null,null)
if (is_null($drop)){

} else {
  $drop_array = $drop ->fetch_array();

  //imma just assume that worked perfectly and $drop_array is now an array of the contents of the users intres row or null if the user hasnt filled it in yet

  // right so this bit takes the row an reads through it and updates the array for the dropdown to say this is the boi previously selected


  for ($iter = 1; $iter <= 11; $iter++) {
    switch ($drop_array[$iter]){
      case 0:
        break;
      case 1:
        $drop3_array[$iter-1]="selected";
        break;
      case 2:
        $drop2_array[$iter-1]="selected";
        break;
      case 3:
        $drop1_array[$iter-1]="selected";
        break;
      default:
        break;


    }
  }
}
$dropdown_statement ->close();
word_bits_statement

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Profile</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <script type='text/Javascript'></script>
    <link href='profilepage.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <style>



.form-control:focus {
    box-shadow: none;
    border-color: #c416e2;
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 17px;
    font-family: sans-serif;
}

.topNav {
  max-height: 250px;
  overflow:auto;
}

}</style>
</head>
<body oncontextmenu='return false' class='snippet-body'>
    <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
        <div class="container"><a class="navbar-brand" href="#">UCONNECT</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="../Home_page/index.php">HomePage</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="../Friends_page/final.php">Friends</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="#">Notifications</a></li>
                </ul>
        </div>
    </nav>
<form action = "saveprofile.php" method = "post" enctype="multipart/form-data">
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">

        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <div id="display_image"></div>
            <input type="file" accept="image/*"id="image_input" name="image_input" hidden/>
            <label for="image_input" id="image_input1">Choose file</label>
        </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Forename</label><input type="text" class="form-control" placeholder="First name"  name="forename" /></div>
                    <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control"  placeholder="Surname" name="surname" /></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Course</label><input type="text" class="form-control" placeholder="Enter your course" value="" name="course"></div>


                </div>
                <div class="row mt-4">

                    <div class="col-md-12"><label class="labels">Bio</label><textarea name="text" placeholder="About Me:" type="text" class="form-control"  maxlength="200" style="height: 180px;"></textarea><br><br></div>

                </div>
                <!-- Dropdown starts here -->


                    <select name = "choice1">
                      <option value = "Sports" $drop1_array[0]>Sports</option>
                      <option value = "Movies" $drop1_array[1]>Movies</option>
                      <option value = "Books" $drop1_array[2]>Books</option>
                      <option value = "Video Games" $drop1_array[3]>Video Games</option>
                      <option value = "Music" $drop1_array[4]>Music</option>
                      <option value = "Science" $drop1_array[5]>Science</option>
                      <option value = "Art" $drop1_array[6]>Art</option>
                      <option value = "Food" $drop1_array[7]>Food</option>
                      <option value = "Fashion" $drop1_array[8]>Fashion</option>
                      <option value = "Anime" $drop1_array[9]>Anime</option>
                      <option value = "Computers" $drop1_array[10]>Computers</option>
                    </select>
                    <select name = "choice2">
                      <option value = "Sports" $drop2_array[0]>Sports</option>
                      <option value = "Movies" $drop2_array[1]>Movies</option>
                      <option value = "Books" $drop2_array[2]>Books</option>
                      <option value = "Video Games" $drop2_array[3]>Video Games</option>
                      <option value = "Music" $drop2_array[4]>Music</option>
                      <option value = "Science" $drop2_array[5]>Science</option>
                      <option value = "Art" $drop2_array[6]>Art</option>
                      <option value = "Food" $drop2_array[7]>Food</option>
                      <option value = "Fashion" $drop2_array[8]>Fashion</option>
                      <option value = "Anime" $drop2_array[9]>Anime</option>
                      <option value = "Computers" $drop2_array[10]>Computers</option>
                    </select>
                    <select name = "choice3">
                      <option value = "Sports" $drop3_array[0]>Sports</option>
                      <option value = "Movies" $drop3_array[1]>Movies</option>
                      <option value = "Books" $drop3_array[2]>Books</option>
                      <option value = "Video Games" $drop3_array[3]>Video Games</option>
                      <option value = "Music" $drop3_array[4]>Music</option>
                      <option value = "Science" $drop3_array[5]>Science</option>
                      <option value = "Art" $drop3_array[6]>Art</option>
                      <option value = "Food" $drop3_array[7]>Food</option>
                      <option value = "Fashion" $drop3_array[8]>Fashion</option>
                      <option value = "Anime" $drop3_array[9]>Anime</option>
                      <option value = "Computers" $drop3_array[10]>Computers</option>
                    </select>


                <!-- Dropdown ends here -->
                <div class="mt-4 text-center"><input class="btn btn-primary profile-button" type="submit" value="Save Profile"></input></div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Social Media Profiles</span></div><br>
                <div class="col-md-12"><label class="labels"><img src="instagram_logo.png" alt="Instagram Logo" width="40" height="40"><br></label><input type="text" class="form-control" placeholder="Instagram Link" value=""></div> <br>
                <div class="col-md-12"><label class="labels"><img src="snapchaticon.png" alt="Snapchat Logo" width="40" height="40"><br></label><input type="text" class="form-control" placeholder="SnapChat Link" value=""></div><br>
                <div class="col-md-12"><label class="labels"><img src="facebooklogo.png" alt="Facebook Logo" width="40" height="40"><br></label><input type="text" class="form-control" placeholder="Facebook Link" value=""></div><br>
                <div class="col-md-12"><label class="labels"><img src="linkedin.png" alt="Linkedin Logo" width="40" height="40"><br></label><input type="text" class="form-control" placeholder="Linkedin Link" value=""></div><br>
            </div>
        </div>

    </div>
</div>
</form>
</div>
</div>
    <script  src="./profilepage.js"></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript' src=''></script>

    </body>
</html>
