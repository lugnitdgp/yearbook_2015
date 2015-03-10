<?php

session_start();

if (!isset($_SESSION['uname']) || !isset($_POST['requestroll']))
{
    header("Location: index.php");
    exit(0);
}
else
{
    $for = $_POST['requestroll'];
    $by = $_SESSION['uname'];

    require_once("database.php");

    $q = "SELECT count(*) from profiles WHERE `uname` = '$for'";
    $res = mysql_query($q);
    $row = mysql_fetch_row($res);

    if ($row == null || $row[0] != 1)
    {
        header("Location: request.php?incorrectuname=true");
        exit(0);
    }
    else
    {
        $q = "SELECT count(*) from testimonialrequests WHERE `for` = '$for' AND `by` = '$by'";
        $res = mysql_query($q);
        $row = mysql_fetch_row($res);
        if ($row == null || $row[0] != 0)
        {
            header("Location: request.php?alreadyrequested=true");
            exit(0);
        }
        else
        {
            $q = "SELECT count(*) from testimonials WHERE `for` = '$by' AND `by` = '$for'";
            $res = mysql_query($q);
            $row = mysql_fetch_row($res);
            if ($row == null || $row[0] != 0)
            {
                header("Location: request.php?alreadytestified=true");
                exit(0);
            }
            else
            {
                $q = "INSERT into testimonialrequests(`for`, `by`) VALUES ('$for', '$by')";
                mysql_query($q);
                header("Location: request.php?success=true");
                exit(0);
            }
        }
    }
}
?>