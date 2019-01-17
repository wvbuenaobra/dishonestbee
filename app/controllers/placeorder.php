<?php
session_start();
require_once './connect.php';

function generate_new_transaction_number(){
	$ref_number = "";
	$source = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F');

	for($i = 0; $i < 16; $i++) {
		$index = rand(0, 15); //generates a random number from 0-15

		//append random character
		$ref_number .= $source[$index];
	}

	$today = getdate();
	return $ref_number.'-'.$today[0]; //seconds since Unix Epoch
}

//get all the details of the order
$user_id = $_SESSION['user']['id'];
$purchase_date = date("Y-m-d G:i:s"); //G is for 12-hour format, i minutes with leading zeros, s seconds with leading zeros
$status_id = 1;
$payment_mode_id = 1;
$address = $_POST['addressLine1'];
$cart_total = $_POST['orderTotal'];
$transaction_number = generate_new_transaction_number();

//create a new order
$sql = "INSERT INTO orders (user_id, transaction_code, total, status_id, payment_mode_id) VALUES ('$user_id', '$transaction_number', '$cart_total', '$status_id', '$payment_mode_id')";
//purchase_date, '$purchase_date',
$result = mysqli_query($conn, $sql);

//get the latest order id to associate items for order_items table
$new_order_id = mysqli_insert_id($conn);

//if order was created
if($result) {
	//loop through the items inside the session cart
	foreach($_SESSION['cart'] as $item_id => $qty) {
		//get the price of the current item
		$sql = "SELECT price FROM items WHERE id = '$item_id'";
		$result = mysqli_query($conn, $sql);

		//fetch the data from the query
		$item = mysqli_fetch_assoc($result);

		//create a new order item
		$sql = "INSERT INTO order_items (order_id, item_id, quantity, price) VALUES ('$new_order_id', '$item_id', '$qty', '".$item['price']."')";
		//execute the order item query
		$result = mysqli_query($conn, $sql);
	}
}

//clear items from the cart
$_SESSION['cart'] = [];

// Send email notification to customer
// ==============================================================================
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

$mail = new PHPMailer(true); 
// Passing `true` enables exceptions

//**more editing on the body of the email**

$staff_email = 'dishonestbeeph@gmail.com';
$customer_email = $_SESSION['user']['email'];
$subject = 'Dishonest Bee - Order Confirmation';
$body = "
<div style='background-color:#ffc107;text-align:center;padding:10px;font-family: helvetica;'>
	<h1>Dishonest Bee</h1>
	<p>Asia's fastest-growing food and grocery service</p>
</div>
<br>
<div style='font-family: helvetica;'>Good day! Your order from Dishonest Bee is now being processed.<br>Here are your order details:</div>
<div style='text-transform:uppercase;font-family: helvetica;'>
	<h3>Reference No.: ".$transaction_number."</h3>
	<h4>Total: Php ".number_format($cart_total, 2, ".", ",")."</h4>
</div>
<div style='font-family: helvetica;'>Items will be shiped to $address within 1-2 days.<br><br></div>
<div style='font-family: helvetica;'>Thank you,</div>
<div style='font-family: helvetica;'>Alexa of Dishonest Bee<br><br></div>
<small style='font-family: helvetica;'>This is an auto-generated email. Please do not reply. For inquiries, you may contact us at email@email.com or 09179178978.</small>
";

try {
    //Server settings
    $mail->SMTPDebug = 4;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $staff_email;                       // SMTP username
    $mail->Password = 'disdis00!';                     // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($staff_email, 'Dishonest Bee');
    $mail->addAddress($customer_email);  // Name is optional
    $mail->addCC('dishonestbeeph@gmail.com');

    //Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $body;

    // Route user to confirmation page
    $_SESSION['new_txn_number'] = $transaction_number;
    header('location: ../views/confirmation.php');

    $mail->send();
    // echo 'Message has been sent';

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

mysqli_close();
?>