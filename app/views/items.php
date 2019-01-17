<?php
	$pageTitle = "Items";
	$items_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content(){

	//redirect to error page if NOT ADMIN
	if(!(isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 1)){
		header("Location: ./error.php");
	}

	global $conn;
?>

	<div class="container my-4">

		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-md-8"><h1>Items</h1></div>
					<div class="col-md-4 text-right my-auto"><a href="./new_item.php" class="btn btn-primary">Add New Item</a></div>
				</div>
			</div>
		</div>

		<hr>

		<?php 
		$sql = "SELECT * FROM items";
		$items = mysqli_query($conn, $sql);
		
		echo "<div class='row'>";
		foreach ($items as $item) { ?>

			<div class="col-sm-3 py-2">
				<div class="card h-100">
					<img src="<?php echo $item['image_path']; ?>" class="card-img-top catalog-img">
					<div class="card-body">
						<h4 class="card-title"> <?php echo $item['name']; ?></h4>
						<p class="card-text"><?php echo $item['description']; ?></p>
						<p class="card-text"> Price: <?php echo $item['price']; ?></p>

						<input type="hidden" value="<?php echo $item['id']; ?>">
					</div> <!-- end card body -->

					<div class="card-footer text-center">
						<a href="./edit_item.php?id=<?php echo $item['id']; ?>" class="btn btn-primary"> Edit Item</a>
						<a href="../controllers/delete_item.php?id=<?php echo $item['id']; ?>" class="btn btn-danger"> Delete Item</a>
					</div>
				</div>
			</div> <!-- end of cols -->

		<?php }; ?>
		</div> <!-- end of row -->

	</div><!--  end container -->

<?php } ?>