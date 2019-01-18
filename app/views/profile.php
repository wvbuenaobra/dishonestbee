<?php
	$pageTitle = "Profile";
	$profile_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content(){
	
	//if user is not logged in, will proceed to login page, as to safeguard from entering this address on the address bar
	if(!isset($_SESSION['user'])) {
		//**lagyan ng you must login to continue notice**
		header("Location: ./login.php");
	}

	global $conn;
	$user = $_SESSION['user'];
?>

	<div class="container">
		<div class="row">

			<div class="col-lg-3 pt-4">
				<div class="list-group" id="list-tab" role="tablist">
					<a class="list-group-item" href="#profile" data-toggle="list" role="tab">
						User Information
					</a>
					<a class="list-group-item" href="#passwordtab" data-toggle="list" role="tab">
						Change Password
					</a>
					<?php 
					//ORDER HISTORY will only be accessible to USER
					if(isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 2){ ?>
						<a class="list-group-item" href="#history" data-toggle="list" role="tab">
							Order History
						</a>
					<?php } ?>
				</div>
			</div>

			<div class="col-lg-8 pt-4">
				<div class="tab-content">
					
					<div class="tab-pane" id="profile" role="tabpanel">
						<form id="update_user_details" action="../controllers/update_profile.php" method="POST">
							<div class="container">

								<h3>User Information</h3>
								<input type="text" class="form-control" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>" hidden>

								<label for="username">Username:</label>
								<input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username'] ?>" disabled>
								<br>

								<label for="firstname">First Name:</label>
								<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname'] ?>">
								<small class="text-danger"></small><br>

								<label for="lastname">Last Name:</label>
								<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname'] ?>">
								<small class="text-danger"></small><br>

								<label for="email">E-mail:</label>
								<input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?>">
								<small class="text-danger"></small><br>

								<label for="address">Address:</label>
								<input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address'] ?>">
								<small class="text-danger"></small><br>

								<button type="button" class="btn btn-primary mb-3" id="update_info">Update Info</button>
							</div>
						</form>
					</div>

					<div class="tab-pane" id="passwordtab" role="tabpanel">
						<form id="update_password_form" action="../controllers/update_password.php" method="POST">
							<div class="container">

								<h3>Change Password</h3>
								<input type="text" class="form-control" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>" hidden>

								<label for="password">New Password:</label>
								<input type="password" class="form-control" name="password" id="password" placeholder="Enter your new password (minimum of 8 chars)">
								<small class="text-danger"></small><br>

								<label for="confpassword">Confirm New Password:</label>
								<input type="password" class="form-control" id="confpassword" placeholder="Confirm your new password">
								<small class="text-danger"></small><br>

								<button type="button" class="btn btn-primary mb-3" id="update_password">Submit New Password</button>
							</div>
						</form>
					</div>

					<div class="tab-pane" id="history" role="tabpanel">
						<div class="row">
							<div class="col-md-6">
								<h3>Order History</h3>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr class="text-center">
										<th>Transaction Number</th>
										<th>Purchase Date</th>
										<th>Total (Php)</th>
										<th>Status</th>
										<th>Payment Mode</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT o.transaction_code, DATE_FORMAT(o.purchase_date, '%b %e, %Y %h:%i %p') AS purchase_date, o.total, s.name AS status, p.name AS payment_mode FROM orders o JOIN statuses s ON (o.status_id = s.id) JOIN payment_modes p ON (o.payment_mode_id = p.id) WHERE user_id = '".$user['id']."'";
									$transactions = mysqli_query($conn, $sql);
									foreach ($transactions as $transaction) { ?>
                                      	<tr>
                                      		<td class="text-center"><?php echo $transaction['transaction_code'] ?></td>
                                      		<td class="text-center"><?php echo $transaction['purchase_date'] ?></td>
                                      		<td class="text-center"><?php echo number_format($transaction['total'], 2, ".", ",") ?></td>
                                      		<td class="text-center"><?php echo $transaction['status'] ?></td>
                                      		<td class="text-center"><?php echo $transaction['payment_mode'] ?></td>
                                      	</tr>
                                    <?php  }  ?>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>

		</div> <!-- end of row -->
	</div> <!-- end of container -->
<?php } ?>
