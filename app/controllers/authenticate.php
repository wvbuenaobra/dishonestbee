<?php
	session_start();
	require_once './connect.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);
	$user_info = mysqli_fetch_assoc($result);

	//password_verify(password, hash) -> compares a non-hashed pword to a hashed pword stored in the db

	if(!password_verify($password, $user_info['password'])){
		die("failed");
	} else {
		$_SESSION['user'] = $user_info;
	}

	echo "success";

	mysqli_close($conn);
?>