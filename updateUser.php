<?php

	include("functions.php");
	
	if(isset($_SESSION['userid'])){
		// getting Values from URL.
		if(isset($_POST['uname'])){
			$email = $_POST['uname']; 
			$password = sha1(md5($_POST['pword']));
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$bdate = date($_POST['bdate']);
			
			if(updateUser($email,$password,$fname,$lname,$bdate))
				echo "Updated Successfully.";
			else echo "Update Failed.";
		}else header('Location: index.php');
	}else header('Location: index.php');
?>