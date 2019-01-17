<?php
	$pageTitle = "Confirmation";
	$cart_active = "active";
	require_once '../partials/template.php';
?>

<?php function get_page_content() {

	//redirect to error page if ADMIN
	if(isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 1){
		header("Location: ./error.php");
	}

	//if user is not logged in, will proceed to login page, as to safeguard from entering this address on the address bar
	if(!isset($_SESSION['user'])) {
		//**lagyan ng you must login to continue notice**
		header("Location: ./login.php");
	}
?>

	<div class="container main-container my-4">

		<div class="row">
			<div class="col-12">
				<h1>Confirmation</h1>
			</div>
		</div>

		<hr>

        <div class="row">
            <div class="col-sm-12">
                <h3>Order Reference No.: <?php echo $_SESSION['new_txn_number']; ?></h3>
                <?php unset($_SESSION['new_txn_number']); ?>

                <p>Thank you for your purchase! Your transaction is being processed. We have also sent you an email about your order details.</p>

                <a class="btn btn-primary" href="./catalog.php">Go Back to Catalog</a>
                <a class="btn btn-primary" href="./home.php">Go Back to Home</a>
            </div>
        </div>
    </div>

<?php } ?>