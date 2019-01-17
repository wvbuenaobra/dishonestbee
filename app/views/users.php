<?php
	$pageTitle = "Users";
	$users_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content() {

	//redirect to error page if NOT ADMIN
	if(!(isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 1)){
		header("Location: ./error.php");
	}

	global $conn;

	$order = "";
	$sort = "DESC";

	if(isset($_GET['col'])) {
		$col = $_GET['col'];
		$sort = $_GET['sort'];

		if($sort == "DESC") {
			$sort = "ASC";
		} else {
			$sort = "DESC";
		}

		if($col == '1') {
			$order = " ORDER BY username ".$sort;
		} else if($col == '2') {
			$order = " ORDER BY firstname ".$sort;
		} else if($col == '3') {
			$order = " ORDER BY lastname ".$sort;
		} else if($col == '4') {
			$order = " ORDER BY email ".$sort;
		} else if($col == '5') {
			$order = " ORDER BY roles_id ".$sort;
		}
	}
?>

	<div class="container">
		<div class="row">

			<div class="col-sm-10 offset-sm-1">

				<div class="pt-4 pb-3">
					<h1>Users</h1>
				</div>
				
				<table class="table table-responsive table-striped">
					<thead>
						<tr class="text-center">
							<th>Username &nbsp;
								<a href="./users.php?col=1&sort=<?php echo $sort ?>" class="text-dark"><i class="fas fa-sort"></i></a>
							</th>
							<th>First Name &nbsp;
								<a href="./users.php?col=2&sort=<?php echo $sort ?>" class="text-dark"><i class="fas fa-sort"></i></a>
							</th>
							<th>Last Name &nbsp;
								<a href="./users.php?col=3&sort=<?php echo $sort ?>" class="text-dark"><i class="fas fa-sort"></i></a>
							</th>
							<th>Email &nbsp;
								<a href="./users.php?col=4&sort=<?php echo $sort ?>" class="text-dark"><i class="fas fa-sort"></i></a>
							</th>
							<th>Role &nbsp;
								<a href="./users.php?col=5&sort=<?php echo $sort ?>" class="text-dark"><i class="fas fa-sort"></i></a>
							</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql_users = "SELECT u.id, u.username, u.firstname, u.lastname, u.email, r.name AS role, u.roles_id FROM users u JOIN roles r ON (u.roles_id = r.id)".$order;
						$result_users = mysqli_query($conn, $sql_users);
						foreach ($result_users as $indiv_user) {
							extract($indiv_user); ?>
							
							<tr class="text-center">
								<td><?php echo $username ?></td>
								<td><?php echo $firstname ?></td>
								<td><?php echo $lastname ?></td>
								<td><?php echo $email ?></td>
								<td><?php echo $role ?></td>
								<td>
									<?php if($role == 'ADMIN') { ?>
										<a href="../controllers/grant_admin.php?id=<?php echo $id ?>&role=<?php echo $roles_id ?>" class="btn btn-danger">Revoke Admin</a>
									<?php } else { ?>
										<a href="../controllers/grant_admin.php?id=<?php echo $id ?>&role=<?php echo $roles_id ?>" class="btn btn-primary">Make Admin</a>
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