<?php
	include "functions.php";
	
	$isAdmin = false;
	$isClient = false;
	
	if(isset($_POST["category"])){
		$category = $_POST["category"];
	}else header('Location: index.php');
	
	if(isset($_SESSION['userid'])){
		
		//checking if admin or client
		if($_SESSION['usertype'] == "admin"){
			$isAdmin = true;
		}else $isClient = true;
	}
	
	$products = getProductByCategory($category);
	echo '<fieldset id="listFieldset">';
	echo '<legend>';
		if($category=="Barongs")
			echo "BARONGS";
		else if($category=="Gowns")
			echo "GOWNS";
		else if($category=="Americanas")
			echo "AMERICANAS";
		else if($category=="Sagalas")
			echo "SAGALAS";
		else if($category=="Prom Dress")
			echo "PROM DRESS";
	echo ' ('.count($products).')</legend>';
	
	if(count($products)!=0){
		echo '
		
			<table id="selectListTable" >
				<tr>
					<th >Product Code</th>
					<th >Name</th>
					<th >Quantity</th>
					<th >Price</th>
				</tr>';
				
				for($i=0 ; $i<count($products) ; $i++){
					echo '<tr>';
						echo '<td><span id="prodcode" onclick="showThisProduct('.$products[$i]["productid"].')">'.$products[$i]["productcode"].'</span></td>';
						echo '<td>'.$products[$i]["name"].'</td>';
						echo '<td>'.$products[$i]["quantity"].'</td>';
						echo '<td style="text-align:left;text-indent:1%">Php '.$products[$i]["amount"].'.00</td>';
					echo '</tr>';
				}
				
		echo '</table>';
	}else echo "No product/s found.";
	echo '</fieldset>';
?>