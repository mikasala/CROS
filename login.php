<?php

	include("functions.php");
	if(isset($_POST['uname'])){
		// getting Values from URL.
		$email = $_POST['uname'];
		$password = sha1(md5($_POST['pword']));
		// check if e-mail address syntax is valid or not
		$email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo "Invalid Email";
		}else{
			if(checkUser($email)){
				if($password==getPassword($email)){
					//echo '<script>alert("'.$email.$password.'");</script>';
					$userid = getUserID($email);
					$user  = getUserInfo($userid);
					$usertype = $user['usertype'];
					$_SESSION['userid'] = $userid;
					$_SESSION['usertype'] = $usertype;
					$_SESSION['justLoggedIn'] = true;
					
					//intializing cart
					$_SESSION['cart'] = array();
					$_SESSION['cartIndex'] = 0;
					
					echo "Successfully Log In.";
					
				}else{
					echo "Incorrect Password";
				}
			}else{
				echo "Username not found";
			}
		}
	}else header('Location: index.php');
?>