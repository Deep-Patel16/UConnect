<?php
session_start();

// getting data needed to display the stored data in the dropdowns

require_once('../config.inc.php');
$id_var = $_SESSION['id'];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);
$_SESSION['sqli'] = $mysqli;
if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}

$dropdown_statement=$mysqli->prepare("SELECT id,Sports,Movies,Books,VideoGames,Music,Science,Art,Food,Fashion,Anime,Computers FROM Interests WHERE id=?");
$dropdown_statement->bind_param("s", $id_var);
$dropdown_statement->execute();
$dropdown_result = $dropdown_statement->get_result();
$drop_array = $dropdown_result->fetch_array();

$drop1_array = array(null,null,null,null,null,null,null,null,null,null,null);
$drop2_array = array(null,null,null,null,null,null,null,null,null,null,null);
$drop3_array = array(null,null,null,null,null,null,null,null,null,null,null);
if (is_null($drop_array)){

} else {


  //imma just assume that worked perfectly and $drop_array is now an array of the contents of the users intres row or null if the user hasnt filled it in yet

  // right so this bit takes the row an reads through it and updates the array for the dropdown to say this is the boi previously selected


  for ($iter = 1; $iter < 12; $iter++) {
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

//word_bits_statement

$word_statement=$mysqli->prepare("SELECT id,Forename,Surname,Course FROM Users WHERE id=?");
$word_statement->bind_param("s", $id_var);
$word_statement->execute();
$word_result = $word_statement->get_result();
$word_array = $word_result->fetch_array();
$word_statement->close();


//imagy stuff
$stmt = $mysqli->prepare("SELECT Profile_Image FROM Profile_Images WHERE ID=?");
$stmt->bind_param("s", $id_var);
$stmt->bind_result($result);
$stmt->execute();
$stmt->fetch();
$user_img = base64_encode($result);

$stmt->close();

?>
<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Profile</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <script type='text/Javascript'></script>
    <link href='profilepage.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link rel='stylesheet' href='https://codepen.io/P1N2O/pen/xxbjYqx.css'><link rel="stylesheet" href="./style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
<link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="shortcut icon" type="image/x-icon" href="logo.jpg" />
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
.header1{
    background:white;
}
.modal-header{
    color:purple;
}
</style>

</head>
<body oncontextmenu='return false' class='snippet-body'>
    <div class="header1">
        <header class="site-navbar sticky-top" role="banner">

          <div class="container">
            <div class="row align-items-center">

              <div class="col-11 col-xl-2">
                <a class="navbar-brand " href="#">
                  <img src="logo.png" width="40" height="40" class="d-inline-block align-top" alt="">
                  UCONNECT
                </a>
              </div>
              <div class="col-12 col-md-10 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">

                  <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block" >
                    <li><a href="../Home_page/index.html"><span style="color:purple">HomePage</span></a></li>
                    <li><a href="../Friends_page/final.php"><span style="color:purple">Friends</span></a></li>
                    <li ><a href="../Login_page/index.html"><span style="color:purple">LogOut</span></a></li>
                  </ul>
                </nav>
              </div>


              <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

              </div>

            </div>


        </header>
        </div>
        <form action = "saveprofile.php" method = "post" enctype="multipart/form-data">
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">

                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <div id="display_image"></div>
                    <input type="file" accept="image/*,.png"id="image_input" name="image_input" hidden/>
                    <label for="image_input" id="image_input1">Choose file</label>
                </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Forename</label><input type="text" class="form-control" placeholder="First name"  name="forename" value = <?php echo($word_array[1]);?> /></div>
                            <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control"  placeholder="Surname" name="surname" value = <?php echo($word_array[2]);?> /></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Course</label><input type="text" class="form-control" placeholder="Enter your course" name="course" value=<?php echo($word_array[3]);?> /></div>


                        </div>
                        <div class="row mt-4">

                            <div class="col-md-12"><label class="labels">Bio</label><textarea name="text" placeholder="About Me:" type="text" class="form-control"  maxlength="200" style="height: 180px;"></textarea><br><br></div>

                        </div>
                        <!-- Dropdown starts here -->
                        <div class="row mt-4">
                          <div class="col-md-12"><label class="labels">1st Preference</label>
                            <select name = "choice1">
                              <option value = "Sports" <?php if ($drop1_array[0]=="selected") echo 'selected="selected"';?>>Sports</option>
                              <option value = "Movies" <?php if ($drop1_array[1]=="selected") echo 'selected="selected"';?>>Movies</option>
                              <option value = "Books" <?php if ($drop1_array[2]=="selected") echo 'selected="selected"';?>>Books</option>
                              <option value = "Video Games" <?php if ($drop1_array[3]=="selected") echo 'selected="selected"';?>>Video Games</option>
                              <option value = "Music" <?php if ($drop1_array[4]=="selected") echo 'selected="selected"';?>>Music</option>
                              <option value = "Science" <?php if ($drop1_array[5]=="selected") echo 'selected="selected"';?>>Science</option>
                              <option value = "Art" <?php if ($drop1_array[6]=="selected") echo 'selected="selected"';?>>Art</option>
                              <option value = "Food" <?php if ($drop1_array[7]=="selected") echo 'selected="selected"';?>>Food</option>
                              <option value = "Fashion" <?php if ($drop1_array[8]=="selected") echo 'selected="selected"';?>>Fashion</option>
                              <option value = "Anime" <?php if ($drop1_array[9]=="selected") echo 'selected="selected"';?>>Anime</option>
                              <option value = "Computers" <?php if ($drop1_array[10]=="selected") echo 'selected="selected"';?>>Computers</option>
                            </select>
                          </div>
                        </div>
                        <div class="row mt-4">
                          <div class="col-md-12"><label class="labels">2nd Preference</label>
                            <select name = "choice2">
                              <option value = "Sports" <?php if ($drop2_array[0]=="selected") echo 'selected="selected"';?>>Sports</option>
                              <option value = "Movies" <?php if ($drop2_array[1]=="selected") echo 'selected="selected"';?>>Movies</option>
                              <option value = "Books" <?php if ($drop2_array[2]=="selected") echo 'selected="selected"';?>>Books</option>
                              <option value = "Video Games" <?php if ($drop2_array[3]=="selected") echo 'selected="selected"';?>>Video Games</option>
                              <option value = "Music" <?php if ($drop2_array[4]=="selected") echo 'selected="selected"';?>>Music</option>
                              <option value = "Science" <?php if ($drop2_array[5]=="selected") echo 'selected="selected"';?>>Science</option>
                              <option value = "Art" <?php if ($drop2_array[6]=="selected") echo 'selected="selected"';?>>Art</option>
                              <option value = "Food" <?php if ($drop2_array[7]=="selected") echo 'selected="selected"';?>>Food</option>
                              <option value = "Fashion" <?php if ($drop2_array[8]=="selected") echo 'selected="selected"';?>>Fashion</option>
                              <option value = "Anime" <?php if ($drop2_array[9]=="selected") echo 'selected="selected"';?>>Anime</option>
                              <option value = "Computers" <?php if ($drop2_array[10]=="selected") echo 'selected="selected"';?>>Computers</option>
                            </select>
                        </div>
                      </div>
                      <div class="row mt-4">
                        <div class="col-md-12"><label class="labels">3rd Preference</label>
                            <select name = "choice3">
                              <option value = "Sports" <?php if ($drop3_array[0]=="selected") echo 'selected="selected"';?>>Sports</option>
                              <option value = "Movies" <?php if ($drop3_array[1]=="selected") echo 'selected="selected"';?>>Movies</option>
                              <option value = "Books" <?php if ($drop3_array[2]=="selected") echo 'selected="selected"';?>>Books</option>
                              <option value = "Video Games" <?php if ($drop3_array[3]=="selected") echo 'selected="selected"';?>>Video Games</option>
                              <option value = "Music" <?php if ($drop3_array[4]=="selected") echo 'selected="selected"';?>>Music</option>
                              <option value = "Science" <?php if ($drop3_array[5]=="selected") echo 'selected="selected"';?>>Science</option>
                              <option value = "Art" <?php if ($drop3_array[6]=="selected") echo 'selected="selected"';?>>Art</option>
                              <option value = "Food" <?php if ($drop3_array[7]=="selected") echo 'selected="selected"';?>>Food</option>
                              <option value = "Fashion" <?php if ($drop3_array[8]=="selected") echo 'selected="selected"';?>>Fashion</option>
                              <option value = "Anime" <?php if ($drop3_array[9]=="selected") echo 'selected="selected"';?>>Anime</option>
                              <option value = "Computers" <?php if ($drop3_array[10]=="selected") echo 'selected="selected"';?>>Computers</option>
                            </select>
                        </div>
                      </div>


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
                    </div>
                </div>

            </div>
        </div>
        </form>
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Privacy Policy</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
    <ul>
      <li>UConnect's services provide users with a platform to find and make new friends. The use of this service
      requires the user's details such as contact details, log-in credentials as well as account holder information.</li>
      <li>UConnect's use of your personal data:</li>
      <ul>
        <li>Using your information to provide services to match your account with others to find friends</li>
        <li>Contact you regarding your account or changes with our service</li>
        <li>Prevent misuse of our service and to review users' content</li>
        <li>Displaying information users have authorised to other users to make friends</li>
        <li>Use data to improve and enhance our services</li>
        <li>Personal information will not be retained for longer than is necessary and will also be used to verify users via university emails.</li>
      </ul>
      <li>UConnect will not share your data with third parties unless otherwise specified and consented to.</li>
      <li>UConnect has implemented security features to prevent data and personal information from being stolen.</li>
  </ul>
        </div>
      </div>
    </div>
  </div>




  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel2">Report</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
                <input type="file" id="myFile" name="filename">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text" placeholder="Explain your reason behind the reporting"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color:white; background:purple;">Close</button>
          <button type="button" class="btn btn-primary" style="color:white; background:purple;">Report</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel3">About UCONNECT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
    <p style="color:black;">Uconnect will help university students, particularly pre-university and first year students, find friends before and during their early weeks of university, when they may not know many or even any people at all.
    Uconnect will help you find people who have similar interests and hobbies that you may never have met, which will help the transition into university life easier as you will have one less thing to stress about, knowing that you have people to talk to and go out with.
    Uconnect introduces you to their other forms of social media when you become friends, acting as a bridge for you to connect with them and building the University of Manchester community.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel4">Terms and Conditions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
    <ol>
      <li><h5>Agreement to Terms</h5>
      <p style="color:black;">These Terms of Use constitute a legally binding agreement made between you, whether personally or on behalf of an entity (“you”) and UConnect ("Company," “we," “us," or “our”), concerning your access to and use of the uconnect.com website as well as any other media form, media channel, mobile website or mobile application related, linked, or otherwise connected thereto (collectively, the “Site”). You agree that by accessing the Site, you have read, understood, and agreed to be bound by all of these Terms of Use. IF YOU DO NOT AGREE WITH ALL OF THESE TERMS OF USE, THEN YOU ARE EXPRESSLY PROHIBITED FROM USING THE SITE AND YOU MUST DISCONTINUE USE IMMEDIATELY.</p>
    <p style="color:black;">Supplemental terms and conditions or documents that may be posted on the Site from time to time are hereby expressly incorporated herein by reference. We reserve the right, in our sole discretion, to make changes or modifications to these Terms of Use from time to time. We will alert you about any changes by updating the “Last updated” date of these Terms of Use, and you waive any right to receive specific notice of each such change. Please ensure that you check the applicable Terms every time you use our Site so that you understand which Terms apply. You will be subject to, and will be deemed to have been made aware of and to have accepted, the changes in any revised Terms of Use by your continued use of the Site after the date such revised Terms of Use are posted.</p>
  <p style="color:black;">The information provided on the Site is not intended for distribution to or use by any person or entity in any jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject us to any registration requirement within such jurisdiction or country. Accordingly, those persons who choose to access the Site from other locations do so on their own initiative and are solely responsible for compliance with local laws, if and to the extent local laws are applicable.</p>
  <p style="color:black;">The Site is intended for users who are at least 18 years old. Persons under the age of 18 are not permitted to use or register for the Site.</p></li>


      <li>
        <h5>Intellectual Property Rights</h5>
        <p style="color:black;">Unless otherwise indicated, the Site is our proprietary property and all source code, databases, functionality, software, website designs, audio, video, text, photographs, and graphics on the Site (collectively, the “Content”) and the trademarks, service marks, and logos contained therein (the “Marks”) are owned or controlled by us or licensed to us, and are protected by copyright and trademark laws and various other intellectual property rights and unfair competition laws of the United States, international copyright laws, and international conventions. The Content and the Marks are provided on the Site “AS IS” for your information and personal use only. Except as expressly provided in these Terms of Use, no part of the Site and no Content or Marks may be copied, reproduced, aggregated, republished, uploaded, posted, publicly displayed, encoded, translated, transmitted, distributed, sold, licensed, or otherwise exploited for any commercial purpose whatsoever, without our express prior written permission.</p>
        <p style="color:black;">Provided that you are eligible to use the Site, you are granted a limited license to access and use the Site and to download or print a copy of any portion of the Content to which you have properly gained access solely for your personal, non-commercial use. We reserve all rights not expressly granted to you in and to the Site, the Content and the Marks.
        </p>
      </li>

      <li>
        <h5>User Data</h5>
        <p style="color:black;">We will maintain certain data that you transmit to the Site for the purpose of managing the performance of the Site, as well as data relating to your use of the Site. Although we perform regular routine backups of data, you are solely responsible for all data that you transmit or that relates to any activity you have undertaken using the Site. You agree that we shall have no liability to you for any loss or corruption of any such data, and you hereby waive any right of action against us arising from any such loss or corruption of such data.
        </p>
      </li>


    <li>
      <h5>Copyright Infrigements</h5>
      <p style="color:black;">We respect the intellectual property rights of others. If you believe that any material available on or through the Site infringes upon any copyright you own or control, please immediately notify us using the contact information provided below (a “Notification”). A copy of your Notification will be sent to the person who posted or stored the material addressed in the Notification. Please be advised that pursuant to applicable law you may be held liable for damages if you make material misrepresentations in a Notification. Thus, if you are not sure that material located on or linked to by the Site infringes your copyright, you should consider first contacting an attorney.</p>

    </li>
  </ol>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color:white; background:purple;">Close</button>

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel5">Contact Us</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
    <p style="color:black;">In order to resolve a complaint regarding the Site or to receive further information regarding use of the Site, please contact us at:  </p>
    <ul>
      <li style="color:black;">Phone: +447498547446</li>
      <li style="color:black;">Email: hrishit1801@gmail.com</li>
    </ul>
        </div>
      </div>
    </div>
  </div>

<footer class="footer-16371">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-9 text-center">
          <div class="footer-site-logo mb-4">
            <a href="#">UCONNECT</a>
          </div>
          <ul class="list-unstyled nav-links mb-5">
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal3">About</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal1">Privacy</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2">Report</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal4">Terms and Conditions</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal5">Contact Us</a></li>
          </ul>

          <div class="social mb-4">
            <h3>Stay in touch</h3>
            <ul class="list-unstyled">
              <li class="in"><a href="#"><span class="icon-instagram"></span></a></li>
              <li class="fb"><a href="#"><span class="icon-facebook"></span></a></li>
            </ul>
          </div>

          <div class="copyright">
            <p class="mb-0" style="color:purple;"><small>&copy; UConnect. All Rights Reserved.</small></p>
          </div>


        </div>
      </div>
    </div>
  </footer>






    <script  src="./profilepage.js"></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript' src=''></script>
    <script type='text/javascript' src=''></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/main.js"></script>


<script src="footer/js/jquery-3.3.1.min.js"></script>
<script src="footer/js/popper.min.js"></script>
<script src="footer/js/bootstrap.min.js"></script>
    </body>
</html>
