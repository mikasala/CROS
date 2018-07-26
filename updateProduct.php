<?php
	include("functions.php");
	
	if(isset($_POST['prodid'])){
		//post variables
		$productid = $_POST['prodid'];
		$productcode = $_POST['prodcode'];
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
		
		$newprodcode = $categ;
		for($i=1 ; $i<13 ; $i++){
			$newprodcode = $newprodcode.$productcode[$i];
		}
		
		$goUpdateWoImage = true;
	
		if(!empty($_FILES["photo"]["name"])) {

			//image details
			$originalName = basename($_FILES["photo"]["name"]);
			$ext = pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION);
			
			//uploading details
			$target_dir = "uploads/";
			$filename = md5(basename($_FILES["photo"]["name"])). "." . $ext;
			$target_file = $target_dir . $filename;
			
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			$uploadOk = true;
			
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
			
			// if everything is ok, try to upload file
			if($uploadOk) {
				unlink(getImageUrl($productid));
				if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)){
					if(updateProductWithImage($productid,$newprodcode,$category,$originalName,$target_file,$name,$ctype,$quantity,$size,$minchest,$maxchest,$minwaist,$maxwaist,$length,$price,$desc))
						echo "Updated Sucessfully.";
				}else echo "Product Update Failed.";
				
			}else echo "Updating your product failed.";
			
			$goUpdateWoImage = false;
		}
		
		if($goUpdateWoImage){
			if(updateProduct($productid,$newprodcode,$category,$name,$ctype,$quantity,$size,$minchest,$maxchest,$minwaist,$maxwaist,$length,$price,$desc))
				echo "Updated Sucessfully.";
			else echo "Product Update Failed.";
		}
		
	}else header('Location: index.php');
?>