$(document).ready( () => {

	function validate_reg_form() {
		let errors = 0;
		let username = $('#username').val();
		let password = $('#password').val();
		let confpassword = $('#confpassword').val();
		let firstname = $('#firstname').val();
		let lastname = $('#lastname').val();
		let email = $('#email').val();
		let address = $('#address').val();

		//validate if username is 10 chars or more
		if(username.length < 10){
			$("#username").next().html("Username should be at least 10 characters.");
			errors++;
		} else {
			$("#username").next().html("");
		}

		//password should be at least 8 chars
		if(password.length < 8){
			$("#password").next().html("Please provide a strong password.");
			errors++;
		} else {
			$("#password").next().html("");
		}

		//email should include the @ symbol
		if(!email.includes("@")){
			$("#email").next().html("Please provide a valid email address.");
			errors++;
		} else {
			$("#email").next().html("");
		}

		//address
		if(address == ""){
			$("#address").next().html("Please provide your address.");
			errors++;
		} else {
			$("#address").next().html("");
		}

		// first name
		if(firstname == ""){
			$("#firstname").next().html("Please provide your first name.");
			errors++;
		} else {
			$("#firstname").next().html("");
		}

		//last name
		if(lastname == ""){
			$("#lastname").next().html("Please provide your last name.");
			errors++;
		} else {
			$("#lastname").next().html("");
		}

		//confirm password
		if(password != confpassword) {
			$("#confpassword").next().html("Passwords should match.");
			errors++;
		} else {
			$("#confpassword").next().html("");
		}

		if(errors > 0) {
			return false;
		} else {
			return true;
		}
	}

	$('#registerBtn').click( (e) => {
		if(validate_reg_form()){

			let username = $('#username').val();
			let password = $('#password').val();
			let firstname = $('#firstname').val();
			let lastname = $('#lastname').val();
			let email = $('#email').val();
			let address = $('#address').val();

			$.ajax({
				url: "../controllers/create_user.php",
				method: "POST",
				data: {
					username: username,
					password: password,
					firstname: firstname,
					lastname: lastname,
					email: email,
					address: address
				},
				success: (data) => {
					console.log(data);
					if(data == "failed") {
						$("#username").next().html("Username already exists.");
					} else {
						alert("User data created successfully. You may now login.");
						///redirect browser
						window.location.replace('../../index.php');
					}
				}
			});
		}
	});

	$('#loginBtn').click( (e) => {
		let username = $('#username').val();
		let password = $('#password').val();

		$.ajax({
			url: "../controllers/authenticate.php",
			method: "POST",
			data: {
				username: username,
				password: password
			},
			success: (data) => {
				if(data == "failed") {
					$('#password').next().html("Please provide correct credentials.");
				} else {
					window.location.replace("../views/home.php");
				}
			}
		});
	});

	//prep for add to cart
	$(document).on('click', '.add-to-cart', (e) => {
		//to prevent default behavior and to override it with our own
		e.preventDefault();

		//prevent parent elements to be triggered
		e.stopPropagation();

		//target is the one who triggered the event
		let item_id = $(e.target).attr("data-id");
		let item_qty = parseInt($(e.target).prev().val());

		$.ajax({
			url: "../controllers/update_cart.php",
			method: "POST",
			data: {
				item_id: item_id,
				item_qty: item_qty
			},
			success: (data) => {
				$('#cart-count').html(data);
			}
		});
	});

});