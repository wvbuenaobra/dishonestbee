<?php
	$pageTitle = "Home";
	$home_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content() { ?>

	<div class="container-fluid">
		<div class="w-75 mx-auto pt-5">
			<div class="jumbotron bg-dark mt-3 text-center text-white">
				<h1>Dishonest Bee</h1>
				<p>Asia's fastest-growing food and grocery service</p>
			</div>
		</div>

		<?php if(isset($_SESSION['user'])) { ?>
			<h3 class="text-center">Hey <?php echo $_SESSION['user']['firstname'] ?>, how can we help you today?</h3>
		<?php } ?>

	</div>

<?php } ?>