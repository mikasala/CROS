<script>
	$(function(){
		//AJAX! ORAAYT!
		$('#orderForm').submit( function( e ) {
			if(areYouSureOrder()){
				$.ajax({
					url: 'addOrder.php',
					type: 'POST',
					data: new FormData( this ),
					processData: false,
					contentType: false,
					
					success: function (data) {
						if(data=="Order Sent."){
							alert(data+" Please wait for confirmation. Thank you.");
							window.location.href = "";
						}else if(data=="Failed to process your order."){
							alert(data+" Please try again.");
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
	}else header('Location: index.php');
	
	echo '<fieldset id="addOrderFieldset">';
	echo '<legend>ORDER DETAILS</legend>';
			echo '<br/>';		
			echo '<form name="orderForm" id="orderForm">';
			echo '<table id="addOrderTable">';
				echo '<tr>';
					echo '<td class="leftClick">';
					echo '</td>';
					echo '<td class="leftClick">';
						echo '<span id="closeWindow" onclick="closeThis()">Close (ESC)</span>';
					echo '</td>';
				echo '</tr>';
				echo '<tr ><td style="border:none;height:5px;"></td><td style="border:none;height:5px;"></td></tr>';
				echo '<tr>';
					echo '<td class="left">';
						echo "Date: ";
					echo '</td>';
					echo '<td class="right">';
						echo '<input type="hidden" id="userid" name="userid" value="'.$userid.'"/>';
						$timeToUse = strtotime(getDateTime());
						echo $timeStamp = date("F j, Y", $timeToUse);
					echo '</td>';	
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Delivery date: ";
					echo '</td>';
					echo '<td class="right">';
						echo '<input type="date" name="dateofdeliver" required id="dateofdeliver">';
					echo '</td>';	
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Address: ";
					echo '</td>';
					echo '<td class="right">';
						echo '<textarea id="deliveryaddress" required name="deliveryaddress" placeholder="Enter your FULL address here.." style="height: 60px;width: 95%"></textarea>';
					echo '</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Contact No.: ";
					echo '</td>';
					echo '<td class="right">';
						echo '<input type="text" required name="contactno" id="contactno"/>';
					echo '</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Email.: ";
					echo '</td>';
					echo '<td class="right">';
						echo getUserInfo($userid)["email"];
					echo '</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Total Amount: ";
					echo '</td>';
					echo '<td class="right">';
						echo '<input type="hidden" name="amounttopay" id="amounttopay" value="'.cartAmount().'"/>';
						echo "Php ".cartAmount().".00";
					echo '</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td class="left">';
						echo "Mode of payment: ";
					echo '</td>';
					echo '<td class="right">';
						echo '<input type="radio" required name="mop" id="mop" value="Cash on Delivery"/>Cash On Delivery<br/>';
						echo '<input type="radio" required name="mop" id="mop" value="Paypal"/>Paypal';
					echo '</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td ></td>';
					echo '<td ><input type="submit" name="addOrderButton" id="addOrderButton" value="GO"/></td>';
				echo '</tr>';
				
			echo '</table>';
			echo '</form>';
		echo '</fieldset>';
?>