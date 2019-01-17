<?php
session_start();
require_once './connect.php';

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];

$sql = "UPDATE items SET name='$name', price='$price', description='$description', category_id='$category_id' WHERE id='$id'";
$result = mysqli_query($conn, $sql);

//**should be able to edit the picture sa assets folder!

if(!$result) {
	echo mysqli_error($conn);
}

header("Location: ../views/items.php");
?>