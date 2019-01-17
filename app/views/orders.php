<?php
	$pageTitle = "Orders";
	$orders_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content() {

	//redirect to error page if NOT ADMIN
	if(!(isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 1)){
		header("Location: ./error.php");
	}

	global $conn;
?>

CONTENT

<?php } ?>