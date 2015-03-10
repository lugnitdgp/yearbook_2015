<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Episode 2015</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
     [data-tip] {
        position:relative;
     }
     [data-tip]:before {
     content:'';
     /* hides the tooltip when not hovered */
     display:none;
     content:'';
     border-left: 5px solid transparent;
     border-right: 5px solid transparent;
     border-bottom: 5px solid #1a1a1a; 
     position:absolute;
     top:30px;
     left:35px;
     z-index:8;
     font-size:0;
     line-height:0;
     width:0;
     height:0;
     }
     [data-tip]:after {
     display:none;
     content:attr(data-tip);
     position:absolute;
     top:35px;
     left:0px;
     padding:5px 8px;
     background:#1a1a1a;
     color:#fff;
     z-index:9;
     font-size: 0.75em;
     height:18px;
     line-height:18px;
     -webkit-border-radius: 3px;
     -moz-border-radius: 3px;
     border-radius: 3px;
     white-space:nowrap;
     word-wrap:normal;
     }
      [data-tip]:hover:before,
      [data-tip]:hover:after {
      display:block;
      }
      body {
      }
      footer {
        text-align: center;
      }
      h1 {
        padding-top: 20px;
        padding-bottom: 20px;
        text-align: center;
      }
      .hero-unit {
        padding-top: 20px;
      }
      #poem {
        text-align: center;
      }
      #video {
        text-align: center;
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
          <a class="brand" href="#">
          <?php if (!isset($_SESSION['uname'])) { ?>
          Episode 2015
          <?php } else { echo $_SESSION['uname']; }
          ?>
          </a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="testimonial.php">Testimonials</a></li>
              <!--<li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>-->
            </ul>
            <?php if(!isset($_SESSION['uname'])) { ?>
            <form class="navbar-form " method="POST" action="login.php">
              <div style="float:right;"><button type="submit" class="btn" name="signin">Sign in</button></div>
              <div data-tip="Initial Password is the same as the Username." style="float:right; padding-right: 10px;"><input class="span2" name="password" type="password" placeholder="Password"></div>
              <div data-tip="Format: 11/CSE/67 OR 11/CSE/5" style="float:right; padding-right: 10px;"><input class="span2" name="rollnumber" type="text" placeholder="Roll Number"></div>
            </form>
            <?php } else {
            ?>
            <a href="logout.php" class="btn pull-right">Sign out</a>
            <?php } ?>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div style="width: 100%; height: 100%; background-image: url('../assets/img/swirl_pattern.png'); background-repeat: repeat-x repeat-y;">
    <div class="container" style="padding-top:80px;">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="well" style="border-radius: 10px; background-image: url('../assets/img/escheresque_ste.png'); background-repeat: repeat-x repeat-y;">
        <h1 style="color: #E5E6EB">Episode 2015</h1>
        <div id="video">
            <iframe width="560" height="315" src="http://www.youtube.com/embed/Rw9wtaPd-F0" frameborder="0" allowfullscreen></iframe>
        </div>
        <div id="poem" style="color: #E5E6EB">
            <b>The story of life is quicker than the wink of an eye,<br/>the story of love is hello and goodbye...<br/>until we meet again</b>
        </div>
      </div>


      <footer>
        <p>An initiative by <a href="http://nitdgplug.org"><b>GNU/Linux Users' Group</b></a> and <b>Literary Circle</b>, NIT Durgapur</p>
      </footer>

    </div> <!-- /container -->
  </div>

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
