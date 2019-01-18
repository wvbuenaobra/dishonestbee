<?php

// local
// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "ecom_db";

//live
$host = "db4free.net";
$username = "dishonestbee";
$password = "dishonestpw";
$dbname = "ecom_db_wb";

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn) {
	die("Connection failed: " . mysqli_error($conn));
}