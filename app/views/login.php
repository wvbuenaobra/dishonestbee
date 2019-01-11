<?php
	$pageTitle = "Login";
	$login_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content() { ?>

	<div class="container">

		<div class="my-4">
			<h3 class="text-center p-4 bg-dark text-light">Login</h3>
		</div>

		<form>
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
				<small class="text-danger"></small>
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
				<small class="text-danger"></small>
			</div>
			<div class="text-center py-4">
				<button type="button" class="btn btn-secondary w-100" id="loginBtn">Login</button>
				<p><small>Don't have an account? <a href="./register.php">Register</a></small></p>
			</div>
		</form>
	</div>

<?php } ?>