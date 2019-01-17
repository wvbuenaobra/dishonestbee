<?php
session_start();
require_once './connect.php';

$id = $_POST['user_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$address = $_POST['address'];

$sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email', address = '$address' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

//reassign the user session into the newly-edited data from db
$sql2 = "SELECT * FROM users WHERE id = '$id'";
$result2 = mysqli_query($conn, $sql2);
$_SESSION['user'] = mysqli_fetch_assoc($result2);

header("Location: ../views/profile.php");
?>