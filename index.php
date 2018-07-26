<?php
	include("functions.php");
	//session_unset();
	
	echo "<script>var showLogInSuccess = false;</script>";
	echo "<script>var isAdmin = false;</script>";
	
	//variable to check whethr the user is an admin or not
	$isAdmin = false;
	$isClient = false;
	
	if(isset($_SESSION['userid'])){
		$justLoggedIn = $_SESSION['justLoggedIn'];
		if($justLoggedIn){
			$_SESSION['justLoggedIn'] = false;
			//echo "blank";
			echo "<script>showLogInSuccess = true;</script>";
		}
		$userid = $_SESSION['userid'];
		$user  = getUserInfo($userid);
		
		//checking if admin or client
		if($_SESSION['usertype'] == "admin"){
			echo "<script>isAdmin = true;</script>";
			$isAdmin = true;
		}else $isClient = true;
		
		echo "<script> var isSessionSet = true;</script>";
	}else{
		echo "<script> var isSessionSet = false;</script>";
	}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/page.css" />
		<link rel="stylesheet" type="text/css" href="css/title.css" />
		<link rel="stylesheet" type="text/css" href="css/options.css" />
		<link rel="stylesheet" type="text/css" href="css/sidemenu.css" />
		<link rel="stylesheet" type="text/css" href="css/content.css" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" />
		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/jquery-ui.js"></script>
		<script src="js/script.js"></script>
		<script src="js/loadPage.js"></script>
		<script src="js/optionsPane.js"></script>
		<script src="js/sideMenu.js"></script>
		<script src="js/content.js"></script>
		<script src="js/viewProduct.js"></script>
		<title>.:CROS:.</title>
	</head>

	<body>
		<div id="main">
			<div id="optionPane">

				<div id="loginSuccess" >Login Successfully!</div>
				<div id="viewProduct">
					<div id="viewProductHolder">
					<fieldset id="viewProductFieldset">
					<legend>PRODUCT</legend>
						<?php
							echo '	
								<br/>
								<table id="viewProductTable" style="border: none;">
									
								</table>';
							
						?>
					</fieldset>
					</div>
				</div>
				<div id="viewOrder">
					<div id="viewOrderHolder">
					<fieldset id="viewOrderFieldset">
					<legend>ORDER</legend>
						<?php
							echo '	
								<br/>
								<table id="viewOrderTable" style="border: none;">
									
								</table>';
							
						?>
					</fieldset>
					</div>
					
				</div>
							
				<div id="logOutClick">Log Out</div>
				<div id="loginClick">Log In</div>
				<div id="login">
					<fieldset>
					<legend>LOG IN</legend>
						<form name="loginForm" id="loginForm" action="" method="post" onsubmit="return checkLogin()">
							
							<table id="loginTable">
								<tr>
									<td >Username: </td>
									<td ><input type="text" name="uname" id="email" placeholder="Enter your email address.."/></td>
								</tr>
								<tr>
									<td >Password: </td>
									<td ><input type="password" name="pword" id="pword"/></td>
								</tr>
								<tr>
									<td ></td>
									<td ><input type="submit" name="loginButton" id="loginButton" value="LOG IN"/></td>
								</tr>
							</table>
						</form>
					</fieldset>
				</div>
				<div id="profileHover"><?php if(isset($_SESSION['userid'])) echo $user['fname']; ?></div>
				<div id="signUpClick">Sign Up</div>
				<div id="signUp">
					<fieldset>
					<?php
						if(isset($_SESSION['userid'])){
							echo '<legend >PROFILE</legend>';
						}else echo '<legend >SIGN UP</legend>';
				
						if(!isset($_SESSION['userid']))
							echo '<form name = "signUpForm" id = "signUpForm" action="" method="post" onsubmit="return addUser()">';
						else echo '<form name = "signUpForm" id = "signUpForm" action="" method="post" onsubmit="return updateUser()">';
					?>
							<div id="signUpError"></div>
							<table id="signUpTable">
								
								<tr>
									<td class="paddedTdLabel">E-mail: </td>
									<?php
										if(!isset($_SESSION['userid'])){
											echo '<td class="paddedTd">';
											echo '<input type="text" id="eadd" name="email" pattern=".{5,}" required title="Please provide your email address." placeholder="example@server.com"/>';
										}else{
											echo '<td class="paddedTd" style="text-decoration: underline;">';
											echo $user['email']."<br/>";
											echo '<input type="text" id="userEmail"  hidden="true" value="'.$user['email'].'"/>';
										}
									?>
									</td>
								</tr>
								<tr>
									<td ></td>
									<td style="font-size:0.7em;">Your email address serves<br/>as your Username.</td>
								</tr>
								<tr>
									<td class="paddedTd">Password: </td>
									<td class="paddedTd">
										<input type="password" id="npword" name="npword" pattern=".{6,}" required title="6 characters minimum" maxlength="10"/>
									</td>
								</tr>
								<tr>
									<td ></td>
									<td style="font-size:0.7em;">Must contain 6-10 characters.</td>
								</tr>
								<tr>
									<td class="paddedTd">Confirm Password: </td>
									<td class="paddedTd">
										<input type="password" id="cnpword" name="cnpword"/>
									</td>
								</tr>
							</table>
					</fieldset><br/>
					<fieldset>
					<legend >PERSONAL INFO</legend>
							<table id="signUpTable">
								<tr>
									<td class="paddedTdLabel">First Name: </td>
									<td class="paddedTd">
										<?php
											if(!isset($_SESSION['userid']))
												echo '<input type="text" id="fname" required name="fname"/>';
											else echo '<input type="text" id="fname" required name="fname" value="'.$user['fname'].'"/>';
										?>
									</td>
								</tr>
								<tr>
									<td class="paddedTd">Last Name: </td>
									<td class="paddedTd">
										<?php
											if(!isset($_SESSION['userid']))
												echo '<input type="text" id="lname" required name="lname"/>';
											else echo '<input type="text" id="lname" required name="lname" value="'.$user['lname'].'"/>';
										?>
										
									</td>
								</tr>
								
								<tr>
									<td class="paddedTd">Birthdate: </td>
									<td class="paddedTd">
										<?php
											if(!isset($_SESSION['userid']))
												echo '<input class="textBox" type="date" required name="bdate" id="bdate" />';
											else echo '<input class="textBox" type="date" required name="bdate" id="bdate" value="'.$user['birthdate'].'" />';
										?>
										
									</td>
								</tr>
								<tr>
									<td class="paddedTd"></td>
									<td class="paddedTd">
										<?php
											if(!isset($_SESSION['userid']))
												echo '<input type="submit" name="signUpButton" value="SUBMIT"/>';
											else echo '<input type="submit" name="updateButton" value="SAVE"/>';
										?>
									</td>
								</tr>
							</table>
						</form>
					</fieldset><br/>
					<?php
						echo '<div id="ordersFieldset">';
						if($isAdmin){
							echo '
							
							
							<fieldset>
							<legend >ORDERS</legend>
								<table id="ordersTable">
									<tr>
										<td class="paddedTdLabel" style="font-weight:bold">Pending: </td>
										<td class="paddedTd">';
											
												echo count(getOrdersByStatus("Pending"));
										echo '
										</td>
									</tr>
									<tr>
										<td class="paddedTd" style="font-weight:bold">Confirmed: </td>
										<td class="paddedTd">';
											
												echo count(getOrdersByStatus("Confirmed"));
											
										echo '
										</td>
									</tr>
									
									<tr>
										<td class="paddedTd" style="font-weight:bold">Total: </td>
										<td class="paddedTd">';
											
												echo count(getOrdersByStatus("Pending")) + count(getOrdersByStatus("Confirmed"));
											
											
										echo '
										</td>
									</tr>
								</table>
							</fieldset>';
						}else if($isClient){
							$clientOrders = getOrdersByClient($userid);
							$ordersCount = count($clientOrders);
							echo '
							<br/>
							<fieldset>
							<legend >MY ORDERS</legend>
								<table id="ordersTable">
									<tr>
										<td class="paddedTdOrders" style="font-weight:bold">Reference no.</td>
										<td class="paddedTd" style="font-weight:bold">
											Items
										</td>
										<td class="paddedTd" style="font-weight:bold">
											Total Amount
										</td>
									</tr>
									';
									echo '<tr><td><hr/></td><td><hr/></td><td><hr/></td></tr>';//horizontal line
								for($i = 0 ; $i < $ordersCount ; $i++){
									if($i==3)
										break;
									echo '
									<tr>
										<td class="paddedTd"><span id="orderclicks" onclick="viewThisOrder('.$clientOrders[$i]['ordernum'].')">'.$clientOrders[$i]['refnum'].'</span></td>
										<td class="paddedTd">';
											$orderno = $clientOrders[$i]['ordernum'];
											$productsOrdered = getProductsOrdered($orderno);
											for($j = 0 ; $j<count($productsOrdered) ; $j++){
												if($j==(count($productsOrdered)-1))
													echo '<span id="orderclicks" onclick="showThisProduct('.$productsOrdered[$j]['productid'].')">'.$productsOrdered[$j]['name'].'</span>';
												else echo '<span id="orderclicks" onclick="showThisProduct('.$productsOrdered[$j]['productid'].')">'.$productsOrdered[$j]['name']."</span><br/>";
											}
										echo '
										<td>Php '.$clientOrders[$i]['total_amount'].'.00</td>
										</td>
									</tr>
									';
									echo '<tr><td><hr/></td><td><hr/></td><td><hr/></td></tr>';
								}
									
									echo '
									<tr>
										<td ><div id="seeAll" onclick="showAllClientOrders('.$userid.')">
												See All
											</div>
										</td>
										<td>
										</td>
									</tr>
								</table>
							</fieldset>';
						}
						echo '</div>';
					?>
				</div>
				<?php
					if($isClient){
						$cart = getCart();
						echo '<div id="cartClick">Cart(<span id="cartCount">'.countCart().'</span>)</div>';
						echo '<div id="cart">';
							echo '<div id="cartFieldset">';
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
											
											echo '<tr >';
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
													onclick="removeProductFromCart('.$cartedProduct['productid'].')">
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
								echo '</div>';
							echo '</div>';
					}
				?>
				
			</div>
			<div id="titleHead">
				<div id="mainTitleHead">
				
				</div>
			</div>
			<br/>
			<div id="mainContainer">
				
				<div id="leftMenu">
					<?php
						
						if(!$isAdmin){	
							echo '<div id="barongs">';
								echo '<div class="sideMenu1">BARONGS</div>';
							echo '</div>';
							
							echo '<div id="americanas">';
								echo '<div class="sideMenu2">AMERICANAS</div>';
							echo '</div>';
							
							echo '<div id="gowns">';
								echo '<div class="sideMenu3">GOWNS</div>';
							echo '</div>';
							
							echo '<div id="sagalas">';
								echo '<div class="sideMenu4">SAGALAS</div>';
							echo '</div>';
							
							echo '<div id="prom">';
								echo '<div class="sideMenu5">PROM DRESS</div>';
							echo '</div>';
						}else{
							echo '<div id="addSide">';
								echo '<div class="sideMenu1"> ';
									echo 'ADD A PRODUCT';
								echo '</div>';
								
							echo '</div>';
							
							//add div
							echo '<div id="addProductDiv">';
								echo '<div class="sideAdd"> ';
									echo '<fieldset id="functionsFieldset">';
									echo '
										<form name="addForm" id="addForm" enctype="multipart/form-data" >							
											<br/>
											
											<table id="addProductTable">
												<tr>
													<td class="left">Category: </td>
													<td>
														<select name="category" id="category" onchange="hideOthers(this);">
															<option>--- Category ---</option>
															<option>Barongs</option>
															<option>Americanas</option>
															<option>Gowns</option>
															<option>Sagalas</option>
															<option>Prom Dress</option>
														</select>
													</td>
												</tr>
												<tr>
													<td class="left">Photo: </td>
													<td ><input type="file" required name="photo" id="photo" /></td>
												</tr>
												<tr>
													<td class="left">Name: </td>
													<td ><input type="text" required name="prodName" id="prodName" /></td>
												</tr>
												<tr>
													<td class="left">Cloth Type: </td>
													<td ><input type="text" required name="ctype" id="ctype" /></td>
												</tr>
												<tr>
													<td class="left">Quantity: </td>
													<td class="rightNumber"><input type="number" min="1" max="20" name="quantity" id="quantity" value="1" />&nbsp;pc/s.</td>
												</tr>
												<tr>
													<td class="left">Size: </td>
													<td>
														<select name="bodysize" id="bodysize" onchange="setDefaultSizes(this);" >
															<option>--- Size ---</option>
															<option>Extra Small</option>
															<option>Small</option>
															<option>Medium</option>
															<option>Large</option>
															<option>Extra Large</option>
															<option>XXL</option>
														</select>
													</td>
												</tr>
												<tr id="chest">
													<td class="left">Chest: </td>
													<td class="rightNumber">
														<input type="number" min="25" max="100" name="minchest" id="minchest" value="29" />
														&nbsp;&nbsp;-&nbsp;&nbsp;
														<input type="number" min="25" max="100" name="maxchest" id="maxchest" value="38" />
														&nbsp;inches
													</td>
												</tr>
												<tr id="waist">
													<td class="left">Waist: </td>
													<td class="rightNumber">
														<input type="number" min="25" max="100" name="minwaist" id="minwaist" value="25" />
														&nbsp;&nbsp;-&nbsp;&nbsp;
														<input type="number" min="25" max="100" name="maxwaist" id="maxwaist" value="40" />
														&nbsp;inches
													</td>
												</tr>
												<tr id="oalength">
													<td class="left">Length: </td>
													<td class="rightNumber"><input type="number" min="30" max="500" name="overalllen" id="overalllen" value="50" />&nbsp;inches</td>
												</tr>
												<tr>
													<td class="left">Price: </td>
													<td class="rightNumber"><input type="number" min="100" max="100000" name="price" id="price" value="500" />&nbsp;PHP</td>
												</tr>
												<tr>
													<td class="left">Description: </td>
													<td ><textarea name="description" id="description" placeholder="Enter description here.." style="height: 80px;width: 180px"/></textarea>
													</td>
												</tr>
												<tr>
													<td ></td>
													<td ><input type="submit" name="addButton" id="addButton" value="GO"/></td>
												</tr>
											</table>
										</form>
									';
									echo '</fieldset>';
								echo '</div>';
							echo '</div>';
							//end
							
							echo '<div id="selectSide">';
							
								echo '<div class="sideMenu2">SELECT A PRODUCT</div>';

							echo '</div>';
							
							//select div
							echo '<div id="selectProductDiv">';
								echo '<div class="sideSelect"> ';
									echo '<fieldset id="functionsFieldset">';
									echo '
									
										<table id="selectProductTable">
											<tr>
												<td class="left">Product code: </td>
												<td ><input type="text" name="prodcode" id="prodcode" placeholder="Enter product code.."/></td>
											</tr>
											
											<tr>
												<td ></td>
												<td ><input type="button" name="selectButton" id="selectButton" value="GO" onclick="showThisCodeProduct()"/></td>
											</tr>
										</table>
									';
									echo '</fieldset><br/>';
									echo '<div id="barongsHolder">';
										
									echo '</div><br/>';
									echo '<div id="americanasHolder">';
										
									echo '</div><br/>';
									echo '<div id="gownsHolder">';
										
									echo '</div><br/>';
									echo '<div id="sagalasHolder">';
										
									echo '</div><br/>';
									echo '<div id="promHolder">';
										
									echo '</div><br/>';
								echo '</div>';
							echo '</div>';
							//end
							
							echo '<div id="ordersSide">';
								echo '<div class="sideMenu3">ORDERS</div>';
								
							echo '</div>';
							//orders div
							echo '<div id="ordersDiv">';
								echo '<div class="sideOrder"> ';
									echo '<fieldset id="functionsFieldset">';
									echo '									
										<table id="orderTable">
											<tr>
												<td class="left">Reference number: </td>
												<td ><input type="text" name="findrefnum" id="findrefnum" placeholder="Enter reference number.."/></td>
											</tr>
											
											<tr>
												<td ></td>
												<td ><input type="button" name="orderFindButton" id="orderFindButton" value="GO" onclick="viewThisOrderNo()"/></td>
											</tr>
										</table>
										
										<div id="pendingHolder">
										
										</div><br/>
										<div id="confirmedHolder">
										
										</div>
									';
									echo '</fieldset>';
								echo '</div>';
							echo '</div>';
							//end
						}
					?>
				</div>
				<div id="mainContentContainer">
					<div id="mainContent">
						<?php
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
					</div>
				</div>
			</div>
			<br/>
			<div id="footer">
				<div id="mainFooter">
				</div>
			</div>
		</div>
	</body>
</html>
