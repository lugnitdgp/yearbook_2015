<?php

require_once("util.php");

session_start();

if (!isset($_SESSION['uname']))
{
    header("Location: index.php");
    exit(0);
}
else
{
    $uname = $_SESSION['uname'];

    require_once('database.php');

    $q = "SELECT * FROM profiles WHERE uname = '$uname'";
    $res = mysql_query($q);
    $row = mysql_fetch_assoc($res);

    $fullname = $row['fullname'];
    $nickname = $row['nickname'];
    $email = $row['email'];
    $facebookid = $row['facebookid'];
    $goingto = $row['goingto'];
    $iwishihad = $row['iwishihad'];
    $songdescribe = $row['songdescribe'];
    $bestmoment = $row['bestmoment'];
    $tenyears = $row['tenyears'];
    $partingpunch = $row['partingpunch'];
    $testimonial1 = $row['testimonial1'];
    $testimonial2 = $row['testimonial2'];
    $groupphoto = $row['groupphoto'];
    $profilephoto = $row['profilephoto'];

    mysql_close($dbconn);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Episode 2013 - My Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <style>
        #detailsform input[type="text"], #detailsform textarea {
            width: 100%;
        }
        footer p {
            text-align: center;
        }
        #submit {
            margin-top: 50px;
            width: 100%;
        }
        h2 {
            text-align: center;
            padding-bottom: 30px;
            padding-top: 10px;
        }
        .errort {
            background-color: #f2dede !important;
            border-color: #b94a48 !important;
        }
        #sizelimitalert {
            display: none;
        }
    </style>
    <script>
        function removeErrors() {
            $(".errort").removeClass('errort');
        }
        function validateForm() {
            removeErrors();
            var item = $("#fullname");
            if (item.val().length > 30) {
                item.addClass("errort");
                $("#sizelimitalert").show();
                return false;
            }
            var item = $("#nickname");
            if (item.val().length > 20) {
                item.addClass("errort");
                $("#sizelimitalert").show();
                return false;
            }
            var item = $("#email");
            if (item.val().length > 30) {
                item.addClass("errort");
                $("#sizelimitalert").show();
                return false;
            }
            var item = $("#facebookid");
            if (item.val().length > 40) {
                item.addClass("errort");
                $("#sizelimitalert").show();
                return false;
            }
            var item = $("#goingto");
            if (item.val().length > 120) {
                item.addClass("errort");
                $("#sizelimitalert").show();
                return false;
            }
            var item = $("#iwishihad");
            if (item.val().length > 120) {
                item.addClass("errort");
                $("#sizelimitalert").show();
                return false;
            }
            var item = $("#songdescribe");
            if (item.val().length > 120) {
                item.addClass("errort");
                $("#sizelimitalert").show();
                return false;
            }
            var item = $("#bestmoment");
            if (item.val().length > 180) {
                item.addClass("errort");
                $("#sizelimitalert").show();
                return false;
            }
            var item = $("#tenyears");
            if (item.val().length > 120) {
                item.addClass("errort");
                $("#sizelimitalert").show();
                return false;
            }
            var item = $("#partingpunch");
            if (item.val().length > 180) {
                item.addClass("errort");
                $("#sizelimitalert").show();
                return false;
            }
            var item = $("#testimonial1");
            if (item.val().length > 250) {
                item.addClass("errort");
                $("#sizelimitalert").show();
                return false;
            }
            var item = $("#testimonial2");
            if (item.val().length > 250) {
                item.addClass("errort");
                $("#sizelimitalert").show();
                return false;
            }
            return true;
        }
    </script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#"><?php echo $uname; ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="index.php">Home</a></li>
              <li class="active"><a href="profile.php">Profile</a></li>
              <li><a href="testimonial.php">Testimonials</a></li>
              <!--<li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>-->
            </ul>
            <a href="logout.php" class="btn pull-right">Sign out</a>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <div class="row">
        <div class="span10">
          <h2>Enter your details</h2>
          <div id="sizelimitalert" class="alert alert-error"><strong>Size limits exceeded! </strong>Please check the highlighted fields</div>
          <form name="detailsform" id="detailsform" method="POST" action="doprofileedit.php" enctype="multipart/form-data" onsubmit="return validateForm()" >
            <div class="row">
                <div class="span3">New Password</div>
                <div class="span2">&nbsp;</div>
                <div class="span5"><input type="password" id="password" name="password" placeholder="Leave blank to keep unchanged" value="" style="width: 100%;"/></div>
            </div>
            <div class="row">
                <div class="span3">Full Name</div>
                <div class="span2"><small><em>30 Characters</em></small></div>
                <div class="span5"><input type="text" id="fullname" name="fullname" placeholder="Example: John Doe" value="<?php echo $fullname; ?>" /></div>
            </div>
            <div class="row">
                <div class="span3">Nickname</div>
                <div class="span2"><small><em>20 Characters</em></small></div>
                <div class="span5"><input type="text" id="nickname" name="nickname" placeholder="Example: fattu" value="<?php echo $nickname; ?>" /></div>
            </div>
    
            <div class="row">
                <div class="span3">Email</div>
                <div class="span2"><small><em>30 Characters</em></small></div>
                <div class="span5"><input type="text" id="email" name="email" placeholder="Example: hello123@mymail.com" value="<?php echo $email; ?>"/></div>
            </div>
            <div class="row">
                <div class="span3">Facebook ID</div>
                <div class="span2"><small><em>40 Characters</em></small></div>
                <div class="span5"><input type="text" id="facebookid" name="facebookid" placeholder="example: facebook.com/cooldude.124" value="<?php echo $facebookid; ?>" /></div>
            </div>

            <div class="row">
                <div class="span3">Going to ...</div>
                <div class="span2"><small><em>120 Characters</em></small></div>
                <div class="span5"><input type="text" id="goingto" name="goingto" placeholder="example: Tehelka Infocomm Limited" value="<?php echo $goingto; ?>" /></div>
            </div>

            <div class="row">
                <div class="span3">I wish I had ...</div>
                <div class="span2"><small><em>120 Characters</em></small></div>
                <div class="span5"><textarea id="iwishihad" name="iwishihad" placeholder="something that you wish you had done in college." rows="1"><?php echo $iwishihad; ?></textarea></div>
            </div>

            <div class="row">
                <div class="span3">Song that best describes me</div>
                <div class="span2"><small><em>120 Characters</em></small></div>
                <div class="span5">
<textarea id="songdescribe" name="songdescribe" placeholder="Example: Mai Senti Hu" rows="3"><?php echo $songdescribe; ?></textarea></div>
            </div>

            <div class="row">
                <div class="span3">My best moment in college was when ...</div>
                <div class="span2"><small><em>180 Characters</em></small></div>
                <div class="span5"><textarea id="bestmoment" name="bestmoment" placeholder="your best moment in college" rows="2"><?php echo $bestmoment; ?></textarea></div>
            </div>

            <div class="row">
                <div class="span3">10 years hence ...</div>
                <div class="span2"><small><em>120 Characters</em></small></div>
                <div class="span5"><textarea id="tenyears" name="tenyears" placeholder="Where you see yourself in 10 years from now" rows="2"><?php echo $tenyears; ?></textarea></div>
            </div>

            <div class="row">
                <div class="span3">Parting punch</div>
                <div class="span2"><small><em>180 Characters</em></small></div>
                <div class="span5"><input type="text" id="partingpunch" name="partingpunch" placeholder="An awesome quote" value="<?php echo $partingpunch; ?>" /></div>
            </div>

            <div class="row">
                <div class="span3">Testimonial 1</div>
                <div class="span2"><small><em>250 Characters</em></small></div>
                <div class="span5"><textarea id="testimonial1" name="testimonial1" placeholder="Paste a testimonial from a friend here" rows="8"><?php echo $testimonial1; ?></textarea></div>
            </div>
            <div class="row">
                <div class="span3">Testimonial 2</div>
                <div class="span2"><small><em>250 Characters</em></small></div>
                <div class="span5"><textarea id="testimonial2" name="testimonial2" placeholder="Paste a testimonial from another friend here" rows="8"><?php echo $testimonial2; ?></textarea></div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="span3">Group Photo</div>
                <div class="span5">
                    <input type="file" name="groupPhoto" id="groupPhoto" accept="image/*" />
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="span3">Profile Photo<br/><small><em><strong>Do not</strong> use a group photo.</em></small></div>
                <div class="span5">
                    <input type="file" name="profilePhoto" id="profilePhoto" accept="image/*" />
                </div>
            </div>
            <div class="row">
                <div class="offset3 span2">
                    <button type="submit" name="changeprofile" class="btn btn-primary btn-large"><i class="icon-save icon-large"></i> Save</button></div>
            </div>

          </form>
        </div>
      </div>

      <hr>

      <footer>
        <p>An initiative by <a href="http://nitdgplug,org"><b>GNU/Linux Users' Group</b></a> and <b>Literary Circle</b>, NIT Durgapur</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.file-input.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>

<?php
}
?>