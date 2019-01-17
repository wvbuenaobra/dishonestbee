<?php
	$pageTitle = "Checkout";
	$cart_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content() {

	//redirect to error page if ADMIN
	if(isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 1){
		header("Location: ./error.php");
	}

	global $conn;

	//if user is not logged in, will proceed to login page, else will continue to checkout page
	if(!isset($_SESSION['user'])) {
		//**lagyan ng you must login to continue notice**
		header("Location: ./login.php");
	}
?>

	<form method="POST" action="../controllers/placeorder.php">
		<div class="container mt-4">

			<div class="row">
				<div class="col-12">
					<h1>Checkout</h1>
				</div>
			</div>

			<hr>

			<div class="row">
				<div class="col-8 mt-2">
					<h4>Shipping Address:</h4>
					<div class="form-group">
						<input type="text" class="form-control" name="addressLine1" value="<?php echo $_SESSION['user']['address'] ?>" readonly>
					</div>
				</div>
			</div>

			<h4>Order Summary:</h4>

			<div class="row">
				<div class="col-sm-6">
					<h5>Total</h5>
				</div>
				<div class="col-sm-6" id="total_price">
					<?php
					$cart_total = 0;

					foreach($_SESSION['cart'] as $id => $qty) {
						$sql = "SELECT * FROM items WHERE id = '$id'";
						$result = mysqli_query($conn, $sql);
						$item = mysqli_fetch_assoc($result);

						$subTotal = $_SESSION['cart'][$id] * $item['price'];

						$cart_total += $subTotal;
					}

					echo "<p class='font-weight-bold'>Php " . number_format($cart_total, 2, ".", "") . "</p>";
					?>
				</div>
				<input type="hidden" name="orderTotal" value="<?php echo $cart_total ?>">
			</div>

			<hr>

			<div class="row cart-items mt-4">
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="cart-items">

						<thead>
							<tr class="text-center">
								<th colspan="2">Item Name</th>
								<th>Item Price</th>
								<th>Item Quantity</th>
								<th>Item Subtotal</th>
							</tr>
						</thead>

						<tbody>
							<?php
							foreach($_SESSION['cart'] as $id => $qty) {
								$sql2 = "SELECT * FROM items WHERE id ='$id'";
								$result2 = mysqli_query($conn, $sql2);
								$item2 = mysqli_fetch_assoc($result2); ?>
								<tr class="text-center">
									<td colspan="2"><?php echo $item2['name'] ?></td>
									<td><?php echo $item2['price'] ?></td>
									<td><?php echo $qty ?></td>
									<td><?php echo number_format($qty * $item2['price'], 2, ".", "") ?></td>
								</tr>
							<?php } ?>
						</tbody>
						
					</table>
				</div>
			</div>

			<button type="submit" class="btn btn-primary btn-block">Place Order Now</button>

		</div> <!-- end of container -->
	</form>

<?php } ?>