<?php
	$pageTitle = "Register";
	$register_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content() { ?>

	<div class="container">
		<div class="row mt-4">

			<div class="col-md-12">
				<h3 class="text-center p-4 bg-dark text-light">Register</h3>
			</div>

			<div class="col-md-6 mt-4">
				<form>
					<div class="form-group">
						<label for="firstname">First Name:</label>
						<input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter your first name">
						<small class="text-danger"></small>
					</div>
					<div class="form-group">
						<label for="lastname">Last Name:</label>
						<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter your last name">
						<small class="text-danger"></small>
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
						<small class="text-danger"></small>
					</div>
					<div class="form-group">
						<label for="address">Address:</label>
						<input type="text" name="address" id="address" class="form-control" placeholder="Enter your address">
						<small class="text-danger"></small>
					</div>
				<!-- </form> -->
			</div>

			<div class="col-md-6 mt-4">
				<!-- <form> -->
					<div class="form-group">
				    	<label for="username">Username:</label>
				    	<input type="text" class="form-control" name="username" id="username" placeholder="Username should be at least 10 chars">
				 		<small class="text-danger"></small>
				 	</div>
				  	<div class="form-group">
				    	<label for="password">Password:</label>
				    	<input type="password" class="form-control" name="password" id="password" placeholder="Enter a password (minimum of 8 chars)">
				    	<small class="text-danger"></small>
				  	</div>
				  	<div class="form-group">
				    	<label for="confpassword">Confirm Password:</label>
				    	<input type="password" class="form-control" id="confpassword" placeholder="Confirm your password">
				    	<small class="text-danger"></small>
				  	</div>
				  	<div class="form-group">
				  		<button type="button" id="registerBtn" class="btn w-100">Submit</button>
				  		<p class="text-right"><small>Already have an account? <a href="./login.php">Login</a></small></p>
				  	</div>
				</form>
			</div>

		</div>
	</div>

<?php } ?>