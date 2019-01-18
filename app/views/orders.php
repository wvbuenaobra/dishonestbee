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

	$showStatus = "";
	$condition = "";
	if(isset($_POST['showStatus'])) {
		$showStatus = $_POST['showStatus'];
		if($showStatus != ""){
			$condition = "WHERE o.status_id = '$showStatus'";
		}
	}

	global $conn;

	$order_query = "SELECT o.id, o.transaction_code, o.status_id, s.name AS status, o.total, DATE_FORMAT(o.purchase_date, '%b %e, %Y') as purchase_date, p.name as payment_mode FROM orders o JOIN statuses s ON (o.status_id = s.id) JOIN payment_modes p ON (o.payment_mode_id = p.id)".$condition." ORDER BY o.purchase_date DESC";
	$orders = mysqli_query($conn, $order_query);
	$orders_num = mysqli_num_rows($orders);
?>

	<div class="container">
		<div class="row">

			<div class="col-sm-8 offset-sm-2">

				<div class="pt-4 pb-1">
					<h1>Orders</h1>
				</div>

				<div>
					<form method="POST" id="showStatusForm">
						<div class="form-group">
							<em><strong><?php echo $orders_num ?></strong> record(s) found.</em>&nbsp;
							<select class="custom-select custom-select-sm col-4" name="showStatus" id="showStatus">
								<option value="">Show All</option>
								<?php
								$sql_stat = "SELECT * FROM statuses";
								$statuses = mysqli_query($conn, $sql_stat);
								foreach ($statuses as $status) {
									//extract() is another way of getting data. it transforms the columns into variables
									extract($status);

									//ternary operator
									$selected = $showStatus == $id ? 'selected' : '';

									echo "<option value='$id' $selected>$name</option>";
								} ?>
							</select>
						</div>
					</form>
				</div>

				<table class="table table-striped table-responsive">
					
					<thead>
						<tr class="text-center">
							<th>Transaction Code</th>
							<th>Date</th>
							<th>Total</th>
							<th>Payment Mode</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						<?php
						foreach ($orders as $order) { 
							extract($order); ?>
							<tr class="text-center">
								<td><?php echo $transaction_code ?></td>
								<td><?php echo $purchase_date ?></td>
								<td><?php echo number_format($total, 2, ".", ","); ?></td>
								<td><?php echo $payment_mode ?></td>
								<td><?php echo $status ?></td>
								<td>
									<?php if($status == "Pending") { ?>
										<a href="../controllers/complete_order.php?id=<?php echo $id ?>" class="btn btn-primary">Complete</a>
										<a href="../controllers/cancel_order.php?id=<?php echo $id ?>" class="btn btn-danger">Cancel</a>
									<?php } ?>
								</td>
							</tr>
						<?php } ?>
					</tbody>

				</table>
			</div> <!-- end col -->
			
		</div> <!-- end row -->
	</div> <!-- end container -->

<?php } ?>