<?php
session_start();
require_once './connect.php';

$id = $_POST['user_id'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$sql = "UPDATE users SET password = '$password' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

header("Location: ../views/profile.php");
?>