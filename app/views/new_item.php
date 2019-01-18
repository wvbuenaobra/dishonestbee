<?php
	$pageTitle = "New Item";
	$items_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content(){

	//redirect to error page if NOT ADMIN
	if(!(isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 1)){
		header("Location: ./error.php");
	}

	global $conn;

	//**add form validation!!**
?>

	<div class="container">
		<div class="row">

			<div class="col-sm-8 offset-sm-2">
				<form action="../controllers/process_add_item.php" method="POST" enctype="multipart/form-data" id="addItemForm">
					
					<div class="pt-4">
						<h1>Add New Item</h1>
					</div>

					<hr>

					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" class="form-control" id="name" name="name" required>
					</div>

					<div class="form-group">
						<label for="price">Price:</label>
						<input type="number" class="form-control" id="price" name="price" min="1" step="0.01" required>
					</div>

					<div class="form-group">
						<label for="description">Description:</label>
						<textarea class="form-control col-8" rows="5" id="description" name="description"></textarea>
					</div>

					<div class="form-group">
						<label for="categories">Category:</label>
						<select class="form-control col-8" name="category_id" id="categories" required>
							<?php
							$sql = "SELECT * FROM categories";
							$categories = mysqli_query($conn, $sql);
							foreach ($categories as $category) {
								//extract() is another way of getting data. it transforms the columns into variables
								extract($category);
								echo "<option value='$id'>$name</option>";
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="image">Image:</label>
						<input type="file" name="image" id="image" class="form-control" required>
					</div>

					<button type="button" id="btnAddItem" class="btn btn-primary">Add New Item</button>
					<a href="./items.php"><button type="button" class="btn btn-danger">Cancel</button></a>

				</form> <!-- end of form -->
			</div> <!-- end of 8 cols -->

		</div> <!-- end of row -->
	</div> <!-- end of container -->

<?php } ?>