<?php
	$pageTitle = "Cart";
	$cart_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content() {

	//redirect to error page if ADMIN
	if(isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 1){
		header("Location: ./error.php");
	}

	global $conn;
?>
	<div class="container my-4">
		
		<div class="row">
			<div class="col-12">
				<h1>My Cart</h1>
			</div>
		</div>

		<hr>

		<div class="table-responsive pt-2">
			<table class="table table-striped table-bordered">
				
				<thead>
					<tr class="text-center">
						<th>Item Name</th>
						<th>Item Price</th>
						<th>Item Quantity</th>
						<th>Item Subtotal</th>
						<th>Actions</th>
					</tr>
				</thead>
				
				<?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) { ?>

					<tbody>

						<?php
						$cart_total = 0;

						foreach($_SESSION['cart'] as $id => $qty) {
							$sql = "SELECT * FROM items WHERE id ='$id'";
							$result = mysqli_query($conn, $sql);
							$item = mysqli_fetch_assoc($result);

							$subTotal = $_SESSION['cart'][$id] * $item['price'];
							$cart_total += $subTotal; ?>
							
							<tr>
								<td class="item_name text-center"><?php echo $item['name'] ?></td>
								<td class="item_price text-center"><?php echo $item['price'] ?></td>
								<td class="item_quantity">
									<input type="number" class="form-control" value="<?php echo $qty; ?>" data-id="<?php echo $id; ?>" min="1">
								</td>
								<td class="item_subtotal text-center"><?php echo number_format($subTotal, 2, ".", ""); ?></td>
								<td class="item_action text-center">
									<button class="btn btn-sm btn-danger item-remove" data-id="<?php echo $id; ?>">Remove from cart</button>
								</td>
							</tr>
						<?php } ?>

					</tbody>
					<tfoot>
						<tr>
							<td class="text-right font-weight-bold" colspan="3">Total: Php</td>
							<td class="text-center font-weight-bold" id="total_price"><?php echo number_format($cart_total, 2, ".", ""); ?></td>
							<td class="text-center">
								<a href="./checkout.php" class="btn btn-primary">Proceed to Checkout</a>
							</td>
						</tr>
					</tfoot>
						
				<?php } else { ?>

					<tbody>
						<tr>
							<td class="text-center" colspan="6"> No items in the cart </td>
						</tr>
					</tbody>

				<?php } ?>

			</table>
		</div>

	</div> <!-- end container -->

<?php } ?>