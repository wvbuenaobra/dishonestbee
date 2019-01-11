<?php
	session_start();

	function getCartCount() {
		return array_sum($_SESSION['cart']);
	}

	$item_id = $_POST['item_id'];
	$item_qty = $_POST['item_qty'];

	if($item_qty == 0) {
		unset($_SESSION['cart'][$item_id]);
	} else {
		if(isset($_SESSION['cart'][$item_id])) {
			//add item_qty to the prev value
			$_SESSION['cart'][$item_id] += $item_qty;
		} else {
			//set new session
			$_SESSION['cart'][$item_id] = $item_qty;
		}
	}

	echo getCartCount();
?>