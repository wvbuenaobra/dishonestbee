<?php
	$pageTitle = "Home";
	$home_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content() { ?>

	<div class="container-fluid">
		<div class="w-75 mx-auto pt-5">

			<?php if(isset($_SESSION['user'])) { ?>
				<h3 class="text-center">Hey <?php echo $_SESSION['user']['firstname'] ?>, how can we help you today?</h3>
			<?php } ?>

			<div class="jumbotron bg-dark mt-3 text-center text-white">
				<h1>Dishonest Bee</h1>
				<p>The country's fastest-growing food service</p>
			</div>

			<div class="container p-0">
				<div class="row">
					<div class="col-md-4 banner-img mb-3">
						<img src="../assets/images/pancake.jpeg" class="img-fluid rounded h-100 w-100">
					</div>
					<div class="col-md-4 banner-img mb-3">
						<img src="../assets/images/burrito.jpeg" class="img-fluid rounded h-100 w-100">
					</div>
					<div class="col-md-4 banner-img mb-3">
						<img src="../assets/images/steak.jpeg" class="img-fluid rounded h-100 w-100">
					</div>
				</div>
			</div>

		</div>
	</div>

<?php } ?>