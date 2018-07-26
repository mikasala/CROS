<?php
	
	include("functions.php");
	echo md5("123456");
	
	$products = getProductByCategory("a");

	for($i=0 ; $i<count($products) ; $i++){
		$pid = $products[$i]['productid'];
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("INSERT INTO prom
				(productid)
				VALUES
				(:pid);");
			$stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}

?>