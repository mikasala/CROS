<?php

	include("functions.php");
	
	if(isset($_SESSION['userid'])){
		
		if(isset($_POST['prodcode'])){
			// getting Values from URL.
			$productcode = $_POST['prodcode']; 
			if(getProductId($productcode)!="")
				echo getProductId($productcode);
			else echo "Product code not found";
		}else header('Location: index.php');
	}else header('Location: index.php');
?>