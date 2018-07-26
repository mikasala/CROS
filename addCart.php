<?php

	include("functions.php");
	
	if(isset($_SESSION['cart'])){
		
		if(isset($_POST['prodid'])){
			// getting Values from URL.
			$productid = $_POST['prodid']; 
			if(addToCart($productid))
				echo countCart();
			else echo "Item already in the cart";
		}else header('Location: index.php');
	}else header('Location: index.php');
?>