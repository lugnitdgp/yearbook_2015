<?php

$arr = array('BT', 'CE', 'CHE', 'CSE', 'ECE', 'EE', 'IT', 'ME', 'MME');

require_once("database.php");

foreach ($arr as $dept) {
    if ($dept != 'ME')
        $limit = 100;
    else
        $limit = 200;

    for ($i = 1; $i < $limit; $i++) {
        $roll = '11/' . $dept . '/' . $i;
        $q = "INSERT INTO profiles (`uname`, `password`) VALUES ('$roll', '$roll')";
        mysql_query($q);
    }
}
echo "Created";
?>
