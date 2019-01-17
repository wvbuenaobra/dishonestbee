<?php
	$pageTitle = "Edit Item";
	$items_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content(){
	
	//redirect to error page if NOT ADMIN
	if(!(isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 1)){
		header("Location: ./error.php");
	}

	global $conn;

	$item_id = $_GET['id'];

	$sql = "SELECT * FROM items WHERE id = '$item_id'";
	$result = mysqli_query($conn, $sql);
	$item = mysqli_fetch_assoc($result);
?>

	<div class="container">
		<div class="row">

			<div class="col-sm-8 offset-sm-2">
				<form action="../controllers/process_edit_item.php" method="POST">
					
					<div class="pt-4">
						<h1>Edit Item</h1>
					</div>

					<hr>

					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" class="form-control" name="name" id="name" value="<?php echo $item['name'] ?>" required>
					</div>

					<div class="form-group">
						<label for="price">Price:</label>
						<input type="number" class="form-control" id="price" name="price" value="<?php echo $item['price'] ?>" min="1" step="0.01" required>
					</div>

					<div class="form-group">
						<label for="description">Description:</label>
						<textarea class="form-control col-8" rows="5" id="description" name="description"><?php echo $item['description'] ?></textarea>
					</div>

					<div class="form-group">
						<label for="categories">Category:</label>
						<select class="form-control col-8" name="category_id" id="categories" required>
							<?php
							$sql_cat = "SELECT * FROM categories";
							$categories = mysqli_query($conn, $sql_cat);
							foreach ($categories as $category) {
								//extract() is another way of getting data. it transforms the columns into variables
								extract($category);

								//ternary operator
								$selected = $item['category_id'] == $id ? 'selected' : '';

								echo "<option value='$id' $selected>$name</option>";
							}
							?>
						</select>
					</div>

					<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
					<button type="submit" class="btn btn-primary">Update Changes</button>
					<a href="./items.php"><button type="button" class="btn btn-danger">Cancel</button></a>
				</form>
			</div>

		</div> <!-- end row -->
	</div> <!-- end container -->

<?php } ?>