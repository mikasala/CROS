<?php

	include("functions.php");
	
	if(isset($_POST['uname'])){
		// getting Values from URL.
		$email = $_POST['uname']; 
		$password = sha1(md5($_POST['pword']));
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$bdate = $_POST['bdate'];
		// check if e-mail address syntax is valid or not
		$email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo "Invalid Email";
		}else{
			if(checkUser($email)){
				echo "Email already registered.";
			}else{
				if(addUser($email,$password,$fname,$lname,$bdate))
					echo "Registered Successfully.";
				else echo "Registration Failed.";
			}
		}
	}else header('Location: index.php');
?>