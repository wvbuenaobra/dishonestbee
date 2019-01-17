<?php
	require './connect.php';

	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$address = $_POST['address'];

	//validate if username is non-existing
	$sql = "SELECT id FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) > 0) {
		die("failed");
	} else {
		$sql_insert = "INSERT INTO users (firstname, lastname, username, password, email, address, roles_id) VALUES ('$firstname', '$lastname', '$username', '$password', '$email', '$address', '2')";
		$result_insert = mysqli_query($conn, $sql_insert);
	}

	mysqli_close($conn);
?>