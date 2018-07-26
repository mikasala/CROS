<?php

	include("functions.php");
	
	if(isset($_SESSION['cart'])){
		
		if(isset($_POST['prodid'])){
			// getting Values from URL.
			$productid = $_POST['prodid']; 
			if(removeFromCart($productid))
				echo countCart();
			else echo "Item is not in the cart";
		}else header('Location: index.php');
	}else header('Location: index.php');
?>