<?php

if (isset($_POST['signin']))
{
    $uname = addslashes($_POST['rollnumber']);
    $password = addslashes($_POST['password']);

    require_once('database.php');

    $q = "SELECT * FROM profiles WHERE uname = '$uname'";

    $res = mysql_query($q);
    $row = mysql_fetch_assoc($res);
    mysql_close($dbconn);

    if ($row == null)
    {
        Header("Location: index.php?wronguname=1");
    }
    else if($row["password"] == $password)
    {
        session_start();
        $_SESSION["uname"]= $uname;
        Header("Location: profile.php");
    }
    else
    {
        Header("Location: index.php?wrongpass=1");
    }
}
else
{
    Header("Location: index.php");
}
?>