<?php
session_start();
require_once './connect.php';

$id = $_GET['id'];
$roles_id = $_GET['role'];

if($roles_id == 1) {
	$roles_id = 2;
} else if($roles_id == 2) {
	$roles_id = 1;
}

$sql = "UPDATE users SET roles_id = '$roles_id' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if(!$result) {
	echo mysqli_error($conn);
}

header("Location: ../views/users.php");
?>