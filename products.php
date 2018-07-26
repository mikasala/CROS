<?php
	include "functions.php";
	
	$isAdmin = false;
	$isClient = false;
	
	if(isset($_SESSION['userid'])){
		
		//checking if admin or client
		if($_SESSION['usertype'] == "admin"){
			$isAdmin = true;
		}else $isClient = true;
	}
	
	echo '<input type="hidden" id="productToLoad" value="allproducts"/>';
	$products = getAllProducts();
	$toppadding = 30;
	if($isAdmin){
		for($i=0,$l=0 ; $i<count($products) ; $i++,$l++){
			if($i%6==0 && $i!=0){
				$toppadding += 200;
				$l = 0;
			}
			echo '<div class="productsHolder" style="left:'. (int)(30+(165*$l)) .'px; top: '.(int)$toppadding.'px" >';
				echo '<fieldset id="productsFieldset">';
					
					echo '<div id="prodPicHolder">';
					echo '<img class="products" src="'.$products[$i]["image_url"].'" alt="'.$products[$i]["name"].'" 
						onclick="showThisProduct('.$products[$i]['productid'].')" ><br/>';
					echo '</div>';
					echo "Php ".$products[$i]['amount'].'.00<br/>';
					
					if($isClient){
						if(isInCart($products[$i]['productid'])){
							echo '<input type="button" name="'.$products[$i]['productid'].'buttonForCart" id="'.$products[$i]['productid'].'buttonForCart"
								value="Remove from Cart" onclick="addRemoveCart(this,'.$products[$i]['productid'].')"/>';
						}else{
							echo '<input type="button" name="'.$products[$i]['productid'].'buttonForCart" id="'.$products[$i]['productid'].'buttonForCart"
								value="Add to Cart" onclick="addRemoveCart(this,'.$products[$i]['productid'].')"/>';
						}
					}
				echo '</fieldset>';
			echo '</div>';
			
			echo '<script>$(".productsHolder").delay('. (int)(700+($i*200)) .').fadeIn(700);</script>';
		}
	}else {
		for($i=0,$j=0 ; $i<count($products) ; $j++,$i++){
			if(isProductAvailable($products[$i]["productid"])){
				if($j%6==0 && $j!=0){
					$toppadding += 200;
					$j = 0;
				}
				echo '<div class="productsHolder" style="left:'. (int)(30+(165*$j)) .'px; top: '.(int)$toppadding.'px" >';
					echo '<fieldset id="productsFieldset">';
						
							echo '<div id="prodPicHolder">';
							echo '<img class="products" src="'.$products[$i]["image_url"].'" alt="'.$products[$i]["name"].'" 
								 onclick="showThisProduct('.$products[$i]["productid"].')" ><br/>';
							echo '</div>';
							echo "Php ".$products[$i]['amount'].'.00<br/>';
							
							/*if($isClient){
								if(isInCart($products[$i]['productid'])){
									echo '<input type="button" name="removeProductFromCart" id="removeProductFromCart"
										value="Remove from Cart" onclick="removeProductFromCart(this,'.$products[$i]['productid'].')"/>';
								}else{
									echo '<input type="button" name="addProductToCart" id="addProductToCart"
										value="ADD to Cart" onclick="addProductToCart(this,'.$products[$i]['productid'].')"/>';
								}
							}*/
							if($isClient){
								if(isInCart($products[$i]['productid'])){
									echo '<input type="button" name="'.$products[$i]['productid'].'buttonForCart" id="'.$products[$i]['productid'].'buttonForCart"
										value="Remove from Cart" onclick="addRemoveCart(this,'.$products[$i]['productid'].')"/>';
								}else{
									echo '<input type="button" name="'.$products[$i]['productid'].'buttonForCart" id="'.$products[$i]['productid'].'buttonForCart"
										value="Add to Cart" onclick="addRemoveCart(this,'.$products[$i]['productid'].')"/>';
								}
							}
						
					echo '</fieldset>';
				echo '</div>';
			
				echo '<script>$(".productsHolder").delay('. (int)(700+($j*200)) .').fadeIn(700);</script>';
			}else $j--;
		}
	}
	
?>