<?php
session_start();
require_once './connect.php';

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];
$image = "../assets/images/".$_FILES['image']['name']; //store img path

move_uploaded_file($_FILES['image']['tmp_name'], "./".$image); //move from temp storage in the server to the target folder

$sql = "INSERT INTO items (name, description, price, image_path, category_id) VALUES ('$name', '$description', '$price', '$image', '$category_id')";
$result = mysqli_query($conn, $sql);

header("Location: ../views/items.php");
?>