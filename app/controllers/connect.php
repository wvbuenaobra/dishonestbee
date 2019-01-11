<?php

// local
$host = "localhost";
$username = "root";
$password = "";
$dbname = "ecom_db";

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn) {
	die("Connection failed: " . mysqli_error($conn));
}