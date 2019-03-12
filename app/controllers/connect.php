<?php

// local
// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "ecom_db";

//live - b4
// $host = "db4free.net";
// $username = "dishonestbee";
// $password = "dishonestpw";
// $dbname = "ecom_db_wb";

//live
$host = "sql12.freemysqlhosting.net";
$username = "sql12282907";
$password = "tyIRlMbma1";
$dbname = "sql12282907";

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn) {
	die("Connection failed: " . mysqli_error($conn));
}