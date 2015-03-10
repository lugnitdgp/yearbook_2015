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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Episode 2015 - Request Testimonial</title>
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
        #submit {
            margin-top: 50px;
        }
        input[type="text"] {
            width: 100%;
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
              <li><a href="profile.php">Profile</a></li>
              <li class="active"><a href="testimonial.php">Testimonials</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
            <a href="logout.php" class="btn pull-right">Sign out</a>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <div class="row">
        <div class="span9">

          <div class="row">
            <div class="span9">
                <h2>Pending requests</h2>
            </div>
          </div>

            <table class="table table-striped">
            <?php
            $q = "SELECT * FROM testimonialrequests WHERE `by` = '$uname'";
            $res = mysql_query($q);
            $count = 0;
            while ($row = mysql_fetch_assoc($res))
            {
                $count++;
                $for = $row['for'];
                $q2 = "SELECT `fullname` FROM profiles WHERE `uname` = '$for'";
                $res2 = mysql_query($q2);
                $row2 = mysql_fetch_row($res2);
                if ($row2 != null && $row2[0] != "")
                {
                    $displayname = $row2[0];
                }
                else
                {
                    $displayname = $for;
                }
                ?><tr>
                    <td class="span3"><?php echo $displayname; ?></td>
                <?php
            } 
            if ($count == 0)
            {
            ?>
                <tr>
                    <td>Nobody</td>
            <?php
            }
            ?>
            </table>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="span9">
            <h2>Request New Testimonial</h2>
            <form name="request" action="requesttestimonial.php" method="POST">
                <input type="text" name="requestroll" placeholder="Roll number of the person you want to request a testimonial" />
                <input type="submit" value="Send Request" name="submitrequest" />
            </form>
        </div>
      </div>

      <hr/>
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