<?php

	include("functions.php");
	
	if(isset($_POST['mop'])){
		// getting Values from URL.
		$userid = $_POST['userid'];
		$mop = $_POST['mop'];
		$address = $_POST['deliveryaddress'];
		$dateofdeliver = $_POST['dateofdeliver'];
		$contactno = $_POST['contactno'];
		$total = $_POST['amounttopay'];
		$proceed = true;
		
		/*if(date($dateofdeliver)-date(getDateTime())<=0){
			echo "Please enter valid date of delivery.";
		}else $proceed = true;
		*/
		//creating reference number based on time stamp
		$timeToUse = strtotime(getDateTime());
		$timeStamp = date("Hismdy", $timeToUse);
		if($mop=="Paypal")
			$refnum = "P".$userid."-".$timeStamp;
		else $refnum = "C".$userid."-".$timeStamp;
		
		if($proceed){
			if(addOrder($refnum,$userid,$dateofdeliver,$address,$contactno,$mop,$total)){
				$cart = getCart();
				for($i=0 ; $i<count($cart) ; $i++){
					addOrderedProducts(getOrderNoByRefno($refnum),$cart[$i]);
				}
				resetCart();
				echo "Order Sent.";
			}else echo "Failed to process your order.";
		}
	}else header('Location: index.php');
?>