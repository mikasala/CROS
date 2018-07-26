<?php

	include("functions.php");
	if(isset($_POST['uname'])){
		 // getting Values from URL.
		$email = $_POST['uname'];
		// check if e-mail address syntax is valid or not
		$email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo "Invalid Email";
		}else{
			if(checkUser($email)){
				echo "Email already registered.";
			}else{
				echo "Email Available.";
			}
		}
	}else header('Location: index.php');
?>