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
    $goingto = convertToHtml($row['goingto']);
    $iwishihad = convertToHtml($row['iwishihad']);
    $songdescribe = convertToHtml($row['songdescribe']);
    $bestmoment = convertToHtml($row['bestmoment']);
    $tenyears = convertToHtml($row['tenyears']);
    $partingpunch = $row['partingpunch'];
    $testimonial1 = convertToHtml($row['testimonial1']);
    $testimonial2 = convertToHtml($row['testimonial2']);
    $groupphoto = $row['groupphoto'];
    $profilephoto = $row['profilephoto'];

    mysql_close($dbconn);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Episode 2015 - My Profile</title>
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
        footer p {
            text-align: center;
        }
    </style>
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
        <div class="span8">
          <div class="row">
            <div class="span4">
                <h2>My details</h2>
            </div>
            <div class="span4" style="line-height: 60px; position: relative;">
                <a href="profileedit.php" class="btn btn-primary btn-large"><i class="icon-edit icon-large"></i> Edit Details</a>
            </div>
          </div>
            <table class="table table-striped">
                <tr>
                    <th class="span4">Full Name</th>
                    <td class="span4"><?php echo $fullname; ?></td>
                </tr>
                <tr>
                    <th class="span4">Nickname</th>
                    <td class="span4"><?php echo $nickname; ?></td>
                </tr>
                <tr>
                    <th class="span4">Email</th>
                    <td class="span4"><?php echo $email; ?></td>
                </tr>
                
                <tr>
                    <th class="span4">Future Plans</th>
                    <td class="span4"><?php echo $goingto; ?></td>
                </tr>
                <tr>
                    <th class="span4">I wish I had ...</th>
                    <td class="span4"><?php echo $iwishihad; ?></td>
                </tr>
                <tr>
                    <th class="span4">How NITDGP changed me...</th>
                    <td class="span4"><?php echo $songdescribe; ?>
                </tr>
                <tr>
                    <th class="span4">My best moment in college was when ...</th>
                    <td class="span4"><?php echo $bestmoment; ?></td>
                </tr>
                <tr>
                    <th class="span4">The most testing time for me...</th>
                    <td class="span4"><?php echo $tenyears; ?></td>
                </tr>
                <tr>
                    <th class="span4">Where do I see myself when I come for the 25th Reunion...</th>
                    <td class="span4"><?php echo $partingpunch; ?></td>
                </tr>
                <tr>
                    <th class="span4">Testimonial 1</th>
                    <td class="span4"><?php echo $testimonial1; ?></td>
                </tr>
                <tr>
                    <th class="span4">Testimonial 2</th>
                    <td class="span4"><?php echo $testimonial2; ?></td>
                </tr>
                <tr>
                    <th class="span4">Group photo</th>
                    <td class="span4">
                    <?php if ($groupphoto != null && $groupphoto != "") { ?>
                        <img src="groupphotos/<?php echo $groupphoto ?>" />
                    <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th class="span4">Profile photo</th>
                    <td class="span4">
                    <?php if ($profilephoto != null && $profilephoto != "") { ?>
                        <img src="profilephotos/<?php echo $profilephoto ?>" />
                    <?php } ?>
                    </td>
                </tr>
            </table>
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