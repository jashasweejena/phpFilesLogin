<?php
$host = "localhost";
$user = "root";
$pass = "";

$con = mysql_connect($host, $user, $pass);

if($con) {
    echo "Connection success";
}

else {
    echo "Connection failed.";
}

?>