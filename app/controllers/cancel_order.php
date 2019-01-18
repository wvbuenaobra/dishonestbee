<?php
require_once './connect.php';

$id = $_GET['id'];

$sql = "UPDATE orders SET status_id = '3' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if(!$result) {
	echo mysqli_error($conn);
}

header("Location: ../views/orders.php");
?>