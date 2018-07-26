<?php
	include "functions.php";
	
	if(isset($_SESSION["usertype"])){
		if($_SESSION["usertype"]=="client"){
			$cart =  getCart();
		}else header('Location: index.php');
	}else header('Location: index.php');
	
	echo '<fieldset>';
	echo '<legend >CART</legend>';
		echo '<table id="cartTable">';
			if(countCart()==0) {
				echo '<tr>';
					echo '<td class="paddedTd colspan="2">';
						echo "Your cart is empty.";
					echo '</td>';
				echo '</tr>';
			}else{
				$totalAmount = 0;
				echo '<tr><td><hr/></td><td><hr/></td></tr>';//horizontal line
				for($i=0 ; $i<count($cart) ; $i++){
					$cartedProduct = getProductInfo($cart[$i]);
					
					echo '<tr>';
						echo '<td style="width: 120px;text-align: center">';
							echo '<div id="cartPicHolder">';
							echo '<img class="products" src="'.$cartedProduct["image_url"].'" alt="'.$cartedProduct["name"].'" 
								onclick="showThisProduct('.$cartedProduct['productid'].')" ><br/>';
							echo '</div>';
						echo '</td>';
						echo '<td >';
							echo '<span style="font-weight: bold;">'.
									$cartedProduct["name"]."<br/>Php ".
									$cartedProduct["amount"].'.00</span><br/>
									<div id="removeClick" 
									onclick="removeProductFromCartNoRefresh('.$cartedProduct['productid'].')">
									<br/>Remove</div>';
						echo '</td>';
						
					echo '</tr>';
					echo '<tr><td><hr/></td><td><hr/></td></tr>';//horizontal line
					$totalAmount += $cartedProduct["amount"];
				}
				echo '<tr>';
					echo '<td>';
						echo '<span style="font-weight: bold;color: #b70400">Total Amount: </span>';
					echo '</td>';
					echo '<td>';
						echo '<span style="font-weight: bold;text-decoration:underline;">Php '.$totalAmount.'.00</span>';
					echo '</td>';
				echo '</tr>';
				echo '<tr><td><hr/></td><td><hr/></td></tr>';//horizontal line
				echo '<tr>';
					echo '<td ></td>';
					echo '<td >';
						echo '<input type="button" id="buyOutButton" name="buyOutButton"
							value="ORDER NOW" onclick="addOrder()"/>';
					echo '</td>';
				echo '</tr>';
			}
		echo '</table>';
	echo '</fieldset>';
?>