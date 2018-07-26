<script>
	$(function(){
		//AJAX! ORAAYT!
		$('#confirmForm').submit( function( e ) {
			var orderno = $("#ordernum").val();
			if(areYouSureConfirm()){
				$.ajax({
					url: 'approveOrder.php',
					type: 'POST',
					data: new FormData( this ),
					processData: false,
					contentType: false,
					
					success: function (data) {
						if(data=="Order Approved."){
							if($('#ordersDiv').is(':visible')){
								$("#ordersDiv").hide('slide', { direction: 'up' }, 350);
								loadOrderList();
								$("#ordersDiv").show('slide', { direction: 'up' }, 350);
							}
							$("#viewOrder").fadeOut(300);
							$("#viewOrderHolder").load('viewOrder.php',{ordernum : orderno});
							$("#viewOrder").fadeIn(300);
						}else alert(data);
					}
				});
			}
			e.preventDefault();
		});		
	});
	
</script>
<?php
	include "functions.php";
	
	$isAdmin = false;
	$isClient = false;
	
	if(isset($_SESSION['userid'])){
		$userid = $_SESSION['userid'];
		//checking if admin or client
		if($_SESSION['usertype'] == "admin"){
			$isAdmin = true;
		}else $isClient = true;
	}
	if(isset($_POST['ordernum'])){
		$orderno = $_POST['ordernum'];
		$order = getOrderInfo($orderno);
	}else header('Location: index.php');
	
	echo '<fieldset id="addOrderFieldset">';
	echo '<legend>ORDER DETAILS</legend>';
			echo '<br/>';			
			if($isAdmin){
				echo '<form name="confirmForm" id="confirmForm">';
				echo '<input type="hidden" id="ordernum" name="ordernum" value="'.$orderno.'">';
			}
			echo '<table id="viewOrderTable">';
				echo '<tr>';
					echo '<td class="leftClick" style="text-align: left;">';
						if($isAdmin) echo '<span id="prodcode" onclick="showAllClientOrders('.$order['userid'].')"><< ALL CLIENT ORDERS</span>';
						else if($isClient) echo '<span id="prodcode" onclick="showAllClientOrders('.$order['userid'].')"><< ALL ORDERS</span>';
					echo '</td>';
					echo '<td class="leftClick">';
						echo '<span id="closeWindow" onclick="closeThis()">Close (ESC)</span>';
					echo '</td>';
				echo '</tr>';
				echo '<tr ><td style="border:none;height:5px;"></td><td style="border:none;height:5px;"></td></tr>';
				
				//horizontal line
				echo '<tr><td><hr/></td><td><hr/></td></tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Reference Number: ";
					echo '</td>';
					echo '<td class="right">';
						echo $order["refnum"];
					echo '</td>';	
				echo '</tr>';
				
				//horizontal line
				echo '<tr><td><hr/></td><td><hr/></td></tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Date Ordered: ";
					echo '</td>';
					echo '<td class="right">';
						$timeToUse = strtotime($order['date_created']);
						echo $timeStamp = date("F j, Y", $timeToUse);
					echo '</td>';	
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Delivery date: ";
					echo '</td>';
					echo '<td class="right">';
						$timeToUse = strtotime($order['delivery_date']);
						echo $timeStamp = date("F j, Y", $timeToUse);
					echo '</td>';	
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Address: ";
					echo '</td>';
					echo '<td class="right">';
							echo $order['address'];
					echo '</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Contact No.: ";
					echo '</td>';
					echo '<td class="right">';
						echo $order['contactno'];
					echo '</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Email.: ";
					echo '</td>';
					echo '<td class="right">';
						echo getUserInfo($order['userid'])["email"];
					echo '</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Total Amount: ";
					echo '</td>';
					echo '<td class="right">';
						echo 'Php '.$order['total_amount'].'.00';
					echo '</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Mode of payment: ";
					echo '</td>';					
					echo '<td class="right">';
						echo $order['mode_of_pay'];
					echo '</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Status: ";
					echo '</td>';					
					echo '<td class="right">';
						echo $order['status'];
					echo '</td>';
				echo '</tr>';
				
				//horizontal line
				echo '<tr><td><hr/></td><td><hr/></td></tr>';
				
				if($isAdmin){
					if($order['status']=="Pending"){
						echo '<tr>';
							echo '<td ></td>';
							echo '<td class="right"><input type="submit" name="confirmButton" id="confirmButton" value="CONFIRM"/></td>';
						echo '</tr>';
					}
				}
				
			echo '</table>';
			if($isAdmin) echo '</form>';
			
			echo '<fieldset>';
			echo '<legend>ITEMS</legend>';
			echo '
		
			<table id="orderListTable" >
				<tr>
					<th >Product Code</th>
					<th >Name</th>
					<th >Amount</th>
				</tr>';
				$products = getProductsOrdered($orderno);
				$sum = 0;
				for($i=0 ; $i<count($products) ; $i++){
					echo '<tr>';
						echo '<td style="text-align:center;"><span id="prodcode" onclick="showThisProduct('.$products[$i]["productid"].')")">'.$products[$i]["productcode"].'</span></td>';
						echo '<td style="padding-left:3%;">'.$products[$i]["name"].'</td>';
						echo '<td style="text-align:left;text-indent:1%">Php '.$products[$i]["amount"].'.00</td>';
						$sum += $products[$i]["amount"];
					echo '</tr>';
				}
			echo '</fieldset>';
				echo'
				<tr>
					<th ></th>
					<th >Total: </th>
					<th style="text-align:left;text-indent:1%">Php '.$sum.'.00</th>
				</tr>
				';
		echo '</fieldset>';
?>