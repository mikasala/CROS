<?php
	include "functions.php";
	
	$isAdmin = false;
	$isClient = false;
	
	if(isset($_POST["status"])){
		$status = $_POST["status"];
	}else header('Location: index.php');
	
	if(isset($_SESSION['userid'])){
		
		//checking if admin or client
		if($_SESSION['usertype'] == "admin"){
			$isAdmin = true;
		}else $isClient = true;
	}
	
	$orders = getOrdersByStatus($status);
	echo '<fieldset id="listFieldset">';
	echo '<legend>';
		if($status=="Pending")
			echo "PENDING";
		else if($status=="Confirmed")
			echo "CONFIRMED";
	echo ' ('.count($orders).')</legend>';
	
	if(count($orders)!=0){
		echo '
		
			<table id="selectListTable" >
				<tr>
					<th >Reference No.</th>
					<th >Delivery Date</th>
					<th >Client</th>
					<th >Amount</th>
				</tr>';
				
				for($i=0 ; $i<count($orders) ; $i++){
					echo '<tr>';
						echo '<td><span id="prodcode" onclick="viewThisOrder('.$orders[$i]["ordernum"].')">'.$orders[$i]["refnum"].'</span></td>';
						$timeToUse = strtotime($orders[$i]["delivery_date"]);
						$timeStamp = date("F j, Y", $timeToUse);
						echo '<td>'.$timeStamp.'</td>';
						echo '<td><span id="prodcode" onclick="showAllClientOrders('.$orders[$i]["userid"].')">'.getUserInfo($orders[$i]["userid"])["email"].'</span></td>';
						echo '<td style="text-align:left;text-indent:1%">Php '.$orders[$i]["total_amount"].'.00</td>';
					echo '</tr>';
				}
				
		echo '</table>';
	}else echo "No order/s found.";
	echo '</fieldset>';
?>