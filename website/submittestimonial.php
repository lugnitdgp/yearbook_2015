<?php

session_start();

if (!isset($_SESSION['uname']) || !isset($_POST['submittestimonial']))
{
    header("Location: index.php");
    exit(0);
}
else
{
    $for = $_POST['testimonialfor'];
    $by = $_SESSION['uname'];
    $content = addslashes($_POST['testimonialcontent']);

    require_once("database.php");

    $q = "SELECT count(*) from profiles WHERE `uname` = '$for'";
    $res = mysql_query($q);
    $row = mysql_fetch_row($res);

    if ($row == null || $row[0] != 1)
    {
        header("Location: testimonial.php?incorrectuname=true");
        exit(0);
    }
    else
    {
        $q = "SELECT count(*) from testimonialrequests WHERE `for` = '$by' AND `by` = '$for'";
        $res = mysql_query($q);
        $row = mysql_fetch_row($res);
        if ($row == null || $row[0] != 1)
        {
            header("Location: testimonial.php?notrequested=true");
            exit(0);
        }
        else
        {
            $q = "DELETE from testimonialrequests WHERE `for` = '$by' AND `by` = '$for'";
            mysql_query($q);
            $q = "INSERT into testimonials (`for`, `by`, `content`) VALUES ('$for', '$by', '$content')";
            mysql_query($q);
            header("Location: testimonial.php?success=true");
            exit(0);
        }
    }
}
?>