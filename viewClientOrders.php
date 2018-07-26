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
	if(isset($_POST['client'])){
		$client = getUserInfo($_POST['client']);
		$orders = getOrdersByClient($_POST['client']);
	}else header('Location: index.php');
	
	echo '<fieldset id="addOrderFieldset">';
	if($isAdmin)
		echo '<legend>CLIENT</legend>';
	else echo '<legend>MY ORDERS</legend>';
			echo '<br/>';			
			
			echo '<table id="viewOrderTable">';
				echo '<tr>';
					echo '<td class="leftClick">';
						
					echo '</td>';
					echo '<td class="leftClick">';
						echo '<span id="closeWindow" onclick="closeThis()">Close (ESC)</span>';
					echo '</td>';
				echo '</tr>';
				echo '<tr ><td style="border:none;height:5px;"></td><td style="border:none;height:5px;"></td></tr>';
				
				//horizontal line
				echo '<tr><td><hr/></td><td><hr/></td></tr>';
				
				if($isAdmin){
					echo '<tr>';
						echo '<td class="left">';
							echo 'Client Email: ';
						echo '</td>';
						echo '<td class="right">';
							echo $client['email'];
						echo '</td>';
					echo '</tr>';
					
					//horizontal line
					echo '<tr><td><hr/></td><td><hr/></td></tr>';
					
					echo '<tr>';
						echo '<td class="left">';
							echo 'Name: ';
						echo '</td>';
						echo '<td class="right">';
							echo $client['fname']." ".$client['lname'];
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="left">';
							echo 'Birthdate: ';
						echo '</td>';
						echo '<td class="right">';
							$timeToUse = strtotime($client['birthdate']);
							echo $timeStamp = date("F j, Y", $timeToUse);
						echo '</td>';
					echo '</tr>';
					
					//horizontal line
					echo '<tr><td><hr/></td><td><hr/></td></tr>';
				}
				
				
			echo '</table>';
			
			echo '<fieldset>';
			if($isAdmin) echo '<legend>ORDERS ('.count($orders).')</legend>';
			else echo '<legend>ORDERS LIST ('.count($orders).')</legend>';
			echo '
		
			<table id="orderListTable" >
				<tr>
					<th >Reference No.</th>
					<th >Amount</th>
					<th >Status</th>
				</tr>';
				
				for($i=0 ; $i<count($orders) ; $i++){
					echo '<tr>';
						echo '<td style="text-align:center;"><span id="prodcode" onclick="viewThisOrder('.$orders[$i]["ordernum"].')")">'.$orders[$i]["refnum"].'</span></td>';
						echo '<td style="text-align:left;text-indent:1%">Php '.$orders[$i]["total_amount"].'.00</td>';
						echo '<td style="padding-left:3%;">'.$orders[$i]["status"].'</td>';
					echo '</tr>';
				}
			echo '</fieldset>';
				
		echo '</fieldset>';
?>