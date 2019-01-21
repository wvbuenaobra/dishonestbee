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

			$("#registerBtn").attr("disabled", true);

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
						$("#registerBtn").attr("disabled", false);
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
				item_qty: item_qty,
				update_from_cart_page: 0
			},
			success: (data) => {
				$('#cart-count').html(data);
			}
		});
	});

	function getTotal() {
		let total = 0;
		$(".item_subtotal").each(function(e) {
			total += parseFloat($(this).html());
		});
		$("#total_price").html(total.toFixed(2));
	}

	//edit cart
	$(".item_quantity>input").on("input", (e) => {
		
		let item_id = $(e.target).attr('data-id');
		let quantity = parseInt($(e.target).val());
		let price = parseFloat($(e.target).parents('tr').find(".item_price").html());

		//**should validate if negative num ang inenter**

		subTotal = quantity * price;
		$(e.target).parents('tr').find('.item_subtotal').html(subTotal.toFixed(2));

		getTotal();

		$.ajax({
			"method": "POST",
			"url" : "../controllers/update_cart.php",
			"data" : {
				'item_id':item_id,
				'item_qty':quantity,
				'update_from_cart_page':1
			},
			"success": (data) => {
				$("#cart-count").html(data);
			}
		});
	});

	// remove from cart
	$(document).on("click", ".item-remove", (e) => {
		e.preventDefault();
		e.stopPropagation();

		let item_id = $(e.target).attr("data-id");
		let item = $(e.target).parents('tr').find(".item_name").html();

		$.ajax({
			"method" : "POST",
			"url" : "../controllers/update_cart.php",
			"data" : {
				item_id: item_id,
				item_qty: 0
			},
			"beforeSend": () => {
				return confirm("Are you sure you want to remove "+item+" from your cart?");
			},
			"success" : (data) => {
				//**should fadeout**
				// $(e.target).parents("tr").fadeOut();
				// $(e.target).parents("tr").fadeOut(1000,function(){$(e.target).parents("tr").remove();});

				$(e.target).parents("tr").remove();
				$("#cart-count").html(data);
				getTotal();
				window.location.replace("../views/cart.php");
			}
		});
	});

	function validate_profile() {
		let errors = 0;
		let firstname = $('#firstname').val();
		let lastname = $('#lastname').val();
		let email = $('#email').val();
		let address = $('#address').val();

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

		if(errors > 0) {
			return false;
		} else {
			return true;
		}
	}

	//submit profile form updates
	$("#update_info").click( () => {
		if(validate_profile()) {
			$("#update_user_details").submit();
		}
	});

	function validate_change_password() {
		let errors = 0;
		let password = $('#password').val();
		let confpassword = $('#confpassword').val();

		//password should be at least 8 chars
		if(password.length < 8){
			$("#password").next().html("Please provide a strong password.");
			errors++;
		} else {
			$("#password").next().html("");
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

	//submit new password
	$("#update_password").click( () => {
		if(validate_change_password()) {
			$("#update_password_form").submit();
		}
	});

	//show order status
	$("#showStatus").change( () => {
		$("#showStatusForm").submit();
	});

	function validate_item() {
		let errors = 0;
		let name = $('#name').val();
		let price = $('#price').val();
		let image = $('#image').val();

		//name
		if(name == ""){
			$("#name").next().html("Please provide the item name.");
			errors++;
		} else {
			$("#name").next().html("");
		}

		//price
		if(price == ""){
			$("#price").next().html("Please provide the item price.");
			errors++;
		} else {
			$("#price").next().html("");
		}

		//image
		if(image == ""){
			$("#image").next().html("Please provide the item image.");
			errors++;
		} else {
			$("#image").next().html("");
		}

		if(errors > 0) {
			return false;
		} else {
			return true;
		}
	}

	//add new item
	$("#btnAddItem").click( () => {
		if(validate_item()) {
			$("#btnAddItem").attr("disabled", true);
			$("#addItemForm").submit();
		}
	});

	//place order on checkout
	$("#btnPlaceOrder").click( () => {
		$("#btnPlaceOrder").attr("disabled", true);
		$("#formPlaceOrder").submit();
	});

}); //end of document ready