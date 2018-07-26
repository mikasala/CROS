<script>
	$(document).ready(function(){
		var category = $("#ucategory").val();

		if(category=="Barongs" || category=="Americanas"){
			$("#uchest").hide();
			$("#uwaist").hide();
			$("#uoalength").hide();
		}
	});
	
	$(function(){
		//AJAX! ORAAYT!
		$('#updateForm').submit( function( e ) {
		
			var category = $("#ucategory").val();
			var photo = $('#uphoto').val();
			var productName = $("#uprodName").val();
			var productid = $("#productIdHolder").val();
			var clothType = $("#uctype").val();
			var quantity = $("#uquantity").val();
			var bodySize = $("#ubodysize").val();
			var minChest = $("#uminchest").val();
			var maxChest = $("#umaxchest").val();
			var minWaist = $("#uminwaist").val();
			var maxWaist = $("#umaxwaist").val();
			var length = $("#uoveralllen").val();
			var price = $("#uprice").val();
			var details = $("#udescription").val();
			
			if(category=="--- Category ---"){
				alert("Please choose a category.");
				$("#ucategory").focus();
			}else if(!productName){
				alert("Please fill in product name.");
				$("#uprodName").focus();
			}else if(!clothType){
				alert("Please fill in cloth type.");
				$("#uctype").focus();
			}else if(!quantity){
				alert("Please fill in quantity.");
				$("#uquantity").focus();
			}else if(bodySize=="--- Size ---"){
				alert("Please choose a size.");
				$("#ubodysize").focus();
			}else if(maxChest<minChest){
				alert("Please provide appropriate chest measurements.");
				$("#umaxchest").focus();
			}else if(maxWaist<minWaist){
				alert("Please provide appropriate waist measurements.");
				$("#umaxwaist").focus();
			}else{
				//$('#addProductDiv',this).html('<img src="pics/loading.gif" />');
				$.ajax({
					url: 'updateProduct.php',
					type: 'POST',
					data: new FormData( this ),
					processData: false,
					contentType: false,
					
					success: function (data) {
						if(data=="Updated Sucessfully."){
							//alert(data);
							if($('#selectProductDiv').is(':visible')){
								$("#selectProductDiv").hide('slide', { direction: 'up' }, 350);
								loadSelectList();
								$("#selectProductDiv").show('slide', { direction: 'up' }, 350);
							}
							$("#viewProductHolder").fadeOut(300);
							$("#mainContent").fadeOut(300);
							$("#viewProductHolder").load('viewProduct.php',{productid: productid});
							$("#mainContent").load('products.php');
							$("#mainContent").fadeIn(300);
							$("#viewProductHolder").fadeIn(300);
							
						}else alert(data);
					}
				});
				
				e.preventDefault();
			}
			e.preventDefault();
			
		});		
	});
	
</script>
<?php
	include "functions.php";
	
	$isAdmin = false;
	$isClient = false;

	if(isset($_POST["productid"])){
		$prodid = $_POST["productid"];
		$product = getProductInfo($prodid);
	}else header('Location: index.php');
	
	if(isset($_SESSION['userid'])){
		
		//checking if admin or client
		if($_SESSION['usertype'] == "admin"){
			$isAdmin = true;
		}else $isClient = true;
	}
	
	echo '<fieldset id="viewProductFieldset">';
	echo '<legend>PRODUCT DETAILS</legend>';
			echo '<input type="hidden" id="productIdHolder" value="'.$prodid.'">';
			
			echo '<br/>';
			echo '<div id="picHolder">';
				echo '<img src="'.$product["image_url"].'" alt="'.$product["name"].'" class="viewProd"/>';
			echo '</div>';
				if($isAdmin){
					echo '<form name="updateForm" id="updateForm" enctype="multipart/form-data">';
					echo '<table id="viewProductTable">';
						echo '<input type="hidden" name="prodid" id="prodid" value="'.$prodid.'">';
						echo '<input type="hidden" name="prodcode" id="prodcode" value="'.$product["productcode"].'">';
						echo '<tr>';
							echo '<td class="leftClick">';
							echo '</td>';
							echo '<td class="leftClick">';
								echo '<span id="closeWindow" onclick="closeThis()">Close (ESC)</span>';
							echo '</td>';
						echo '</tr>';
						echo '<tr ><td style="border:none;height:5px;"></td><td style="height:5px;border:none"></td></tr>';
					echo 
						'
						<tr>
							<td class="left">Product Code: </td>
							<td class="right">'.$product["productcode"].'</td>
						</tr>
						<tr>
							<td class="left">Category: </td>
							<td class="right">';
							$category = $product["category"];
							echo	'<select name="category" id="ucategory" onchange="updateHideOthers(this);">';
									echo '<option>--- Category ---</option>';
									if($category=="Barongs")
										echo '<option selected="true">Barongs</option>';
									else echo '<option>Barongs</option>';
									if($category=="Americanas")
										echo '<option selected="true">Americanas</option>';
									else echo '<option>Americanas</option>';
									if($category=="Gowns")
										echo '<option selected="true">Gowns</option>';
									else echo '<option>Gowns</option>';
									if($category=="Sagalas")
										echo '<option selected="true">Sagalas</option>';
									else echo '<option>Sagalas</option>';
									if($category=="Prom Dress")
										echo '<option selected="true">Prom Dress</option>';
									else echo '<option>Prom Dress</option>';
								echo '</select>';
							echo '</td>';
						echo
						'
						</tr>
						<tr>
							<td class="left">Photo: </td>
							<td class="right"><input type="file" name="photo" id="uphoto" /></td>
						</tr>
						<tr>
							<td class="left">Name: </td>
							<td class="right"><input type="text" required name="prodName" id="uprodName" value="'.$product["name"].'"/></td>
						</tr>
						<tr>
							<td class="left">Cloth Type: </td>
							<td class="right"><input type="text" required name="ctype" id="uctype" value="'.$product["clothtype"].'"/></td>
						</tr>
						<tr>
							<td class="left">Quantity: </td>
							<td class="right"><input type="number" min="0" max="20" name="quantity" 
							id="uquantity" value="'.$product["quantity"].'" />&nbsp;pc/s.</td>
						</tr>
						<tr>
							<td class="left">Size: </td>
							<td class="right">';
								$bodysize = $product["size_fit"];
								echo '<select name="bodysize" id="ubodysize" onchange="updateSetDefaultSizes(this);" >';
									echo '<option>--- Size ---</option>';
									if($bodysize=="Extra Small")
										echo '<option selected="true">Extra Small</option>';
									else echo '<option>Extra Small</option>';
									if($bodysize=="Small")
										echo '<option selected="true">Small</option>';
									else echo '<option>Small</option>';
									if($bodysize=="Medium")
										echo '<option selected="true">Medium</option>';
									else echo '<option>Medium</option>';
									if($bodysize=="Large")
										echo '<option selected="true">Large</option>';
									else echo '<option>Large</option>';
									if($bodysize=="Extra Large")
										echo '<option selected="true">Extra Large</option>';
									else echo '<option>Extra Large</option>';
									if($bodysize=="XXL")
										echo '<option selected="true">XXL/option>';
									else echo '<option>XXL</option>';
								echo '</select>';
							echo '</td>';
						
							echo '
							</tr>
							<tr id="uchest">
								<td class="left">Chest: </td>
								<td class="right">
									<input type="number" min="25" max="100" value="'.$product["min_chest"].'" name="minchest" id="uminchest" value="29" />
									&nbsp;&nbsp;-&nbsp;&nbsp;
									<input type="number" min="25" max="100" value="'.$product["max_chest"].'" name="maxchest" id="umaxchest" value="38" />
									&nbsp;inches
								</td>
							</tr>
							<tr id="uwaist">
								<td class="left">Waist: </td>
								<td class="right">
									<input type="number" min="25" max="100" value="'.$product["min_waist"].'" name="minwaist" id="uminwaist" value="25" />
									&nbsp;&nbsp;-&nbsp;&nbsp;
									<input type="number" min="25" max="100" value="'.$product["max_waist"].'" name="maxwaist" id="umaxwaist" value="40" />
									&nbsp;inches
								</td>
							</tr>
							<tr id="uoalength">
								<td class="left">Length: </td>
								<td class="right"><input type="number" min="30" max="500" value="'.$product["overall_length"].'"name="overalllen" id="uoveralllen" value="50" />&nbsp;inches</td>
							</tr>
							';
						echo '
						
							<tr>
								<td class="left">Price: </td>
								<td class="right"><input type="number" min="100" max="100000" value="'.$product["amount"].'" name="price" id="uprice" value="500" />&nbsp;PHP</td>
							</tr>
							<tr>
								<td class="left">Description: </td>
								<td class="right"><textarea name="description" id="udescription"  placeholder="Enter description here.." style="height: 80px;width: 180px">'.$product["description"].'</textarea>
								</td>
							</tr>
							<tr>
								<td class="leftClick" ></td>';
							//echo '<td class="rightClick"><input type="button" name="updateProdButton" id="updateProdButton" value="GO"/></td>';
							echo '<td class="rightClick"><input type="submit" name="updateProdButton" id="updateProdButton" value="GO"/></td>';
						echo '	</tr>
						</form>';
						
						echo'</table>';
						
						echo '<fieldset>';
						echo '<legend>ORDERS INCLUDED IN ('.count(getOrdersByProduct($product["productid"])).')</legend>';
							if(count(getOrdersByProduct($product["productid"]))!=0){
								echo '<table id="selectListTable">';
									echo '<tr>';
										echo '<th style="width: 20%">Reference No.</th>';
										echo '<th style="width: 20%">Delivery Date</th>';
										echo '<th style="width: 20%">Order Date</th>';
										echo '<th style="width: 20%">Client</th>';
										echo '<th style="width: 20%">Status</th>';
									echo '</tr>';
									$orders = getOrdersByProduct($product["productid"]);
									for($i=0 ; $i<count($orders) ; $i++){
										echo '<tr>';
											echo '<td style="width: 20%"><span id="prodcode" onclick="viewThisOrder('.$orders[$i]["ordernum"].')">'.$orders[$i]["refnum"].'</span></td>';
											$timeToUse = strtotime($orders[$i]["delivery_date"]);
											$timeStamp = date("F j, Y", $timeToUse);
											echo '<td style="width: 20%">'.$timeStamp.'</td>';
											$timeToUse = strtotime($orders[$i]["date_created"]);
											$timeStamp = date("F j, Y", $timeToUse);
											echo '<td style="width: 20%">'.$timeStamp.'</td>';
											echo '<td style="width: 20%"><span id="prodcode" onclick="showAllClientOrders('.$orders[$i]["userid"].')">'.getUserInfo($orders[$i]["userid"])["email"].'</span></td>';
											echo '<td style="width: 20%;text-align:left;text-indent:1%">'.$orders[$i]["status"].'</td>';
										echo '</tr>';
									}
								echo '</table>';
							}
						echo '</fieldset>';
						
						
				}else{
					echo '<table id="viewProductTable">';
					echo '<tr>';
						echo '<td class="leftClick">';
							if($isClient){
								if(isIncart($product['productid']))
									echo '<span id="removeProd" onclick="addRemoveProductCart(this,'.$product['productid'].')">Remove from Cart</span>';
								else echo '<span id="addProd" onclick="addRemoveProductCart(this,'.$product['productid'].')">Add to Cart</span>';
							}
						echo '</td>';
						echo '<td class="rightClick">';
							echo '<span id="closeWindow" onclick="closeThis()">Close (ESC)</span>';
						echo '</td>';
					echo '</tr>';
					echo '<tr ><td style="border:none;height:10px;"></td><td style="height:10px;border:none"></td></tr>';
					echo '<tr>';
						echo '<td class="left">';
							echo 'Category: ';
						echo '</td>';
						echo '<td class="right">';
							echo $product["category"];
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="left">';
							echo 'Product Code: ';
						echo '</td>';
						echo '<td class="right">';
							echo $product["productcode"];
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="left">';
							echo 'Product Name: ';
						echo '</td>';
						echo '<td class="right">';
							echo $product["name"];
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="left">';
								echo 'Cloth Type: ';
						echo '</td>';
						echo '<td class="right">';
							echo $product["clothtype"];
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="left">';
							echo 'Size: ';
						echo '</td>';
						echo '<td class="right">';
							echo $product["size_fit"];
						echo '</td>';
					echo '</tr>';
					if($product["category"]=="Gowns" || $product["category"]=="Sagalas" || $product["category"]=="Prom Dress"){
						echo '<tr>';
							echo '<td class="left">';
								echo 'Chest: ';
							echo '</td>';
							echo '<td class="right">';
								echo $product["min_chest"]." - ".$product["max_chest"]." inches";
							echo '</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class="left">';
								echo 'Waist: ';
							echo '</td>';
							echo '<td class="right">';
								echo $product["min_waist"]." - ".$product["max_waist"]." inches";
							echo '</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td class="left">';
								echo 'Length: ';
							echo '</td>';
							echo '<td class="right">';
								echo $product["overall_length"]." inches";
							echo '</td>';
						echo '</tr>';
					}
					
					echo '<tr>';
						echo '<td class="left">';
							echo 'Description: ';
						echo '</td>';
						echo '<td class="right">';
							if($product["description"]=="")
								echo "Available";
							else echo $product["description"];
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="left">';
							echo 'Price: ';
						echo '</td>';
						echo '<td class="right">';
							echo "Php ".$product["amount"].".00";
						echo '</td>';
					echo '</tr>';
					echo '<tr ><td style="border:none"></td><td style="border:none"></td></tr>';
					echo'</table>';
				}
				
		echo '</fieldset>';
?>