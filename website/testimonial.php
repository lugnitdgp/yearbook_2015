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
    <title>Episode 2015 - Testimonials</title>
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
        textarea {
            width: 100%;
        }
        #testimonialtoolong {
            display: none;
        }
    </style>
    <script>
        function validateForm() {
            var form = document.forms["testimonialrequest"];
            var item = form["testimonialcontent"].value;
            if (item.length > 250) {
                $('#testimonialtoolong').show();
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
              <li><a href="profile.php">Profile</a></li>
              <li class="active"><a href="testimonial.php">Testimonials</a></li>
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
        <div class="span9">
            <a href="request.php" class="btn btn-primary btn-large"><i class="icon-group"></i> Send testimonial requests</a>
        </div>
    </div>

    <hr/>

      <div class="row">
        <div class="span9">

          <div class="row">
            <div class="span9">
                <h2>Testimonials for me</h2>
            </div>
          </div>

            <table class="table table-striped">
            <?php
            $q = "SELECT COUNT(*) FROM testimonials WHERE `for` = '$uname'";
            $res = mysql_query($q);
            $row = mysql_fetch_row($res);
            if ($row == null || $row[0] < 1)
            { ?>
            <tr>
                <td>No testimonials for you.</td>
            </tr>
            <?php }
            else
            {
                $q = "SELECT * FROM testimonials WHERE `for` = '$uname'";
                $res = mysql_query($q);
                while ($row = mysql_fetch_assoc($res))
                {
                    $by = $row['by'];
                    $q2 = "SELECT `fullname` FROM profiles WHERE `uname` = '$by'";
                    $res2 = mysql_query($q2);
                    $row2 = mysql_fetch_row($res2);
                    if ($row2 != null && $row2[0] != "")
                    {
                        $displayname = $row2[0];
                    }
                    else
                    {
                        $displayname = $by;
                    }
                    $content = convertToHtml(stripslashes($row['content']));
                    ?><tr>
                        <th class="span3"><?php echo $displayname; ?></th>
                        <td class="span6"><?php echo $content; ?></th>
                    <?php
                }
            } ?>
            </table>
        </div>
      </div>

      <hr />

      <div class="row">
        <div class="span9">
            <h2>Testimonials requests for me</h2>
            <?php
            $q = "SELECT COUNT(*) FROM testimonialrequests WHERE `for` = '$uname'";
            $res = mysql_query($q);
            $row = mysql_fetch_row($res);
            if ($row == null || $row[0] < 1)
            { ?>
            No testimonial requests for you.
            <?php
            } else
            { ?>
            <div id="testimonialtoolong" class="alert alert-error">Your testimonial exceeds 250 characters.</div>
            <form name="testimonialrequest" action="submittestimonial.php" onsubmit="return validateForm()" method="POST">
            <div class="row">
                <div class="span3">
                    <?php
                    $q = "SELECT * FROM testimonialrequests WHERE `for` = '$uname'";
                    $res = mysql_query($q);
                    while ($row = mysql_fetch_assoc($res))
                    {
                        $by = $row['by'];
                        $q2 = "SELECT `fullname` FROM profiles WHERE `uname` = '$by'";
                        $res2 = mysql_query($q2);
                        $row2 = mysql_fetch_row($res2);
                        if ($row2 != null && $row2[0] != "")
                        {
                            $displayname = $row2[0];
                        }
                        else
                        {
                            $displayname = $by;
                        }
                        ?>
                        <div class="row">
                            <div class="span3">
                                <input type="radio" name="testimonialfor" value="<?php echo $by; ?>"> <?php echo $displayname; ?>
                            </div>
                        </div>
                    <?php }?>

                </div>
                <div class="span6">
                    <textarea name="testimonialcontent" placeholder="Enter your testimonial here" rows="7"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="span3">
                    <input type="submit" name="submittestimonial" value="Send Testimonial" />
                </div>
            </div>
            </form>
            <?php } ?>
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