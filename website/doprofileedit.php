<?php

session_start();
if (!isset($_POST['changeprofile']))
{
    header("Location: index.php");
    exit(0);
}

else
{
    $uname = $_SESSION['uname'];

    $password = addslashes($_POST['password']);
    $fullname = addslashes($_POST['fullname']);
    $nickname = addslashes($_POST['nickname']);
    $email = addslashes($_POST['email']);
    $facebookid = addslashes($_POST['facebookid']);
    $goingto = addslashes($_POST['goingto']);
    $iwishihad = addslashes($_POST['iwishihad']);
    $songdescribe = addslashes($_POST['songdescribe']);
    $bestmoment = addslashes($_POST['bestmoment']);
    $tenyears = addslashes($_POST['tenyears']);
    $partingpunch = addslashes($_POST['partingpunch']);
    $testimonial1 = addslashes($_POST['testimonial1']);
    $testimonial2 = addslashes($_POST['testimonial2']);

    $allowedExts = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");

    $groupextension = end(explode(".", $_FILES["groupPhoto"]["name"]));
    if ($_FILES["groupPhoto"]["error"] > 0)
    {
        echo "Error uploading file " . $_FILES["groupPhoto"]["name"];
    }
    else if ((($_FILES["groupPhoto"]["type"] == "image/gif")
        || ($_FILES["groupPhoto"]["type"] == "image/jpeg")
        || ($_FILES["groupPhoto"]["type"] == "image/png")
        || ($_FILES["groupPhoto"]["type"] == "image/pjpeg"))
        && ($_FILES["groupPhoto"]["size"] < 5000000)
        && in_array($groupextension, $allowedExts))
    {
        $groupfilename = str_replace('/', '', $uname) . "." . $groupextension;
        $groupfilename = str_replace('/', '', $uname) . "." . $groupextension;
        echo $_FILES["groupPhoto"]["tmp_name"] . " to ";
        echo "groupphotos/" . $groupfilename . "<br>";
        move_uploaded_file($_FILES["groupPhoto"]["tmp_name"],
        "groupphotos/" . $groupfilename);
    }
    else
    {
        echo "Invalid file " . $_FILES["groupPhoto"]["name"];
    }

    $profileextension = end(explode(".", $_FILES["profilePhoto"]["name"]));
    if ($_FILES["profilePhoto"]["error"] > 0)
    {
        echo "Error uploading file " . $_FILES["profilePhoto"]["name"];
    }
    else if ((($_FILES["profilePhoto"]["type"] == "image/gif")
        || ($_FILES["profilePhoto"]["type"] == "image/jpeg")
        || ($_FILES["profilePhoto"]["type"] == "image/png")
        || ($_FILES["profilePhoto"]["type"] == "image/pjpeg"))
        && ($_FILES["profilePhoto"]["size"] < 5000000)
        && in_array($profileextension, $allowedExts))
    {
        $profilefilename = str_replace('/', '', $uname) . "." . $profileextension;
        $profilefilename = str_replace('/', '', $uname) . "." . $profileextension;
        echo $_FILES["profilePhoto"]["tmp_name"] . " to ";
        echo "profilephotos/" . $profilefilename;
        move_uploaded_file($_FILES["profilePhoto"]["tmp_name"],
        "profilephotos/" . $profilefilename);
    }
    else
    {
        echo "Invalid file " . $_FILES["profilePhoto"]["name"];
    }

    require_once("database.php");

    $q = "SELECT password, groupphoto, profilephoto FROM profiles WHERE uname='$uname'";
    $res = mysql_query($q);
    $row = mysql_fetch_assoc($res);
    $oldpassword = $row['password'];
    $oldgroupphoto = $row['groupphoto'];
    $oldprofilephoto = $row['profilephoto'];
    if (!isset($groupfilename))
    {
        $groupphoto = $oldgroupphoto;
    }
    else
    {
        $groupphoto = addslashes($groupfilename);
    }
    if (!isset($profilefilename))
    {
        $profilephoto = $oldprofilephoto;
    }
    else
    {
        $profilephoto = addslashes($profilefilename);
    }
    $q = "DELETE FROM profiles WHERE uname='$uname'";
    mysql_query($q);
    if ($password == '')
        $password = $oldpassword;
    $q = "INSERT INTO profiles (uname, password, fullname, nickname, email, facebookid, goingto, iwishihad, songdescribe, bestmoment, tenyears, partingpunch, testimonial1, testimonial2, groupphoto, profilephoto) VALUES ('$uname', '$password', '$fullname', '$nickname', '$email', '$facebookid', '$goingto', '$iwishihad', '$songdescribe', '$bestmoment', '$tenyears', '$partingpunch', '$testimonial1', '$testimonial2', '$groupphoto', '$profilephoto')";
    mysql_query($q);
    header("Location: profile.php");
}

?>