<?php

	include("functions.php");
	
	if(isset($_POST['ordernum'])){
		// getting Values from URL.
		$orderno = $_POST['ordernum'];
		
		$avail = false;
		$products = getProductsOrdered($orderno);
		
		for($i=0 ; $i<count($products) ; $i++){
			$avail = reduceProductQuantity($products[$i]['productid']);
			if(!$avail){
				echo  $products[$i]['name']." is out of stock. ";
				break;
			}
		}
		if($avail){			
			if(confirmOrder($orderno)){
				echo "Order Approved.";
			}else echo "Failed to process this order.";
		}else echo "Failed to process this order.";
	
	}else header('Location: index.php');
?>