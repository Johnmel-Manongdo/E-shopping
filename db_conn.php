<?php

// $sname = "localhost";
// $uname = "root";
// $password = "";
// $db_name = "db_ecommerce";

$sname = "remotemysql.com";
$uname = "USb3Z7cK0J";
$password = "Ry2dwTpFfd";
$db_name = "USb3Z7cK0J";

$conn  = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "Connection failed!";
}
