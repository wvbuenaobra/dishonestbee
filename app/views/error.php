<?php
	$pageTitle = "Error";
	require_once '../partials/template.php';
?>

<?php function get_page_content() { ?>

	<div class="container mt-5">
		<p class="text-center"><i class="fas fa-ban fa-7x"></i></p>
		<h4 class="text-center">You don't have access to view this page.</h4>
		<div class="text-center"><a href="./home.php">Return to Home</a></div>
	</div>

<?php } ?>