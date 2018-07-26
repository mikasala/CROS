<?php
	include("functions.php");
	
	if(isset($_FILES["photo"])) {
		//post variables
		$category = $_POST['category'];
		$name = $_POST['prodName'];
		$ctype = $_POST['ctype'];
		$quantity = $_POST['quantity'];
		$size = $_POST['bodysize'];
		$minchest = $_POST['minchest'];
		$maxchest = $_POST['maxchest'];
		$minwaist = $_POST['minwaist'];
		$maxwaist = $_POST['maxwaist'];
		$length = $_POST['overalllen'];
		$price = $_POST['price'];
		$desc = $_POST['description'];
	
		//image details
		$originalName = basename($_FILES["photo"]["name"]);
		$ext = pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION);
		
		//uploading details
		$target_dir = "uploads/";
		$filename = md5(basename($_FILES["photo"]["name"])). "." . $ext;
		$target_file = $target_dir . $filename;
		
		//creating product code based on time stamp
		$timeToUse = strtotime(getDateTime());
		$timeStamp = date("Hismdy", $timeToUse);
		$categ = "";
		switch($category){
			case "Barongs":
				$categ = "B";
				break;
			case "Americanas":
				$categ = "A";
				break;
			case "Gowns":
				$categ = "G";
				break;
			case "Sagalas":
				$categ = "S";
				break;
			case "Prom Dress":
				$categ = "P";
				break;
			default:
				break;
		}
		$prodcode = $categ.$timeStamp;
		
		$uploadOk = true;
		
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
	
		$check = getimagesize($_FILES["photo"]["tmp_name"]);
		if($check !== false) {
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = true;
		} else {
			echo "File is not an image. ";
			$uploadOk = false;
		}
	
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "File already exists. ";
			$uploadOk = false;
		}
		// Check file size
		if ($_FILES["photo"]["size"] > 3000000) {
			echo "File is too large. It must be 3MB and below. ";
			$uploadOk = false;
		}
		// Allow certain file formats
		if($imageFileType != "JPEG" &&
			$imageFileType != "JPG" &&
			$imageFileType != "GIF" &&
			$imageFileType != "PNG" &&
			$imageFileType != "jpg"	&& 
			$imageFileType != "png" && 
			$imageFileType != "jpeg" && 
			$imageFileType != "gif" ) {
			
			echo "Only JPG, JPEG, PNG & GIF files are allowed. ";
			$uploadOk = false;
		}
		// Check if $uploadOk is set to 0 by an error
		if (!$uploadOk) {
			echo "Your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if(addProduct($prodcode,$category,$originalName,$target_file,$name,$ctype,$quantity,$size,$minchest,$maxchest,$minwaist,$maxwaist,$length,$price,$desc)){
				if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file))
					echo "Your product has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your product.";
			}
		}
	}else header('Location: index.php');
?>