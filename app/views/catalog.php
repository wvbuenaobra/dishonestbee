<?php
	$pageTitle = "Catalog";
	$catalog_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content() { 

	require_once '../controllers/connect.php';
	global $conn;

	$sql1 = "SELECT * FROM categories";
	$categories = mysqli_query($conn, $sql1);

	$condition = " WHERE 1=1";
	if(isset($_GET['category_id'])){
		$condition .= " AND category_id = ".$_GET['category_id'];
	}

	$order = "";
	if(isset($_SESSION['sort'])){
		$order = " ORDER BY price ".$_SESSION['sort'];
	}
	
	$sql2 = "SELECT * FROM items".$condition.$order;
	$items = mysqli_query($conn, $sql2);
?>

	<div class="container">
		<div class="row pt-3">

			<!-- categories -->
			<div class="col-sm-2">
				<h3>Categories</h3>
				<ul class="list-group">
					<a href="catalog.php">
						<li class="list-group-item mb-1">All</li>
					</a>
					<?php foreach ($categories as $category) { ?>
						<a href="catalog.php?category_id=<?php echo $category['id'] ?>">
							<li class="list-group-item mb-1"><?php echo $category['name'] ?></li>
						</a>
					<?php } ?>
				</ul>

				<h3 class="pt-2">Sort</h3>
				<ul class="list-group">
					<a href="../controllers/sort.php?sort=ASC">
						<li class="list-group-item mb-1">Price (Lowest to Highest)</li>
					</a>
					<a href="../controllers/sort.php?sort=DESC">
						<li class="list-group-item mb-1">Price (Highest to Lowest)</li>
					</a>
				</ul>
			</div>
			<!-- end categories -->

			<!-- items -->
			<div class="col-sm-10">
				<div class="container">
					<div class="row">
						<?php foreach ($items as $item) { ?>
							
							<div class="col-sm-3 mt-2">
								<div class="card h-100">
									<img class="card-img-top catalog-img" src="<?php echo $item['image_path'] ?>">
									<div class="card-body">
										<h4 class="card-title"><?php echo $item['name'] ?></h4>
										<p class="card-text">
											<?php echo $item['description'] ?>
											<br>
											<strong>Php <?php echo $item['price'] ?></strong>
										</p>
									</div>

									<!-- add to cart -->
									<div class="card-footer">
										<input type="number" class="form-control mb-1" name="cartnum" id="cartnum" value="1">
										<button type="submit" class="btn btn-block btn-outline-primary add-to-cart btn-sm" data-id="<?php echo $item['id'] ?>">Add to Cart</button>
									</div>

								</div>
							</div>

						<?php } ?>
					</div>
				</div> <!-- end items' container -->
			</div>
			<!-- end items -->

		</div> <!-- end row -->
	</div> <!-- end container -->

<?php } ?>