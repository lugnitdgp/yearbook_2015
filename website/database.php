<?php
require_once("config.php");
$dbconn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("Could not connect");
//if ($result) echo "connected" else echo "not connected";
$database = DB_NAME;
mysql_select_db($database) or die ("Unable to select database $database. Please see if the database exists");
?>