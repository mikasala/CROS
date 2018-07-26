<?php

	include("functions.php");
	
	if(isset($_SESSION['userid'])){
		
		if(isset($_POST['refnum'])){
			// getting Values from URL.
			$refnum = $_POST['refnum']; 
			if(getOrderNoByRefno($refnum)!=NULL)
				echo getOrderNoByRefno($refnum);
			else echo "Reference number not found";
		}else header('Location: index.php');
	}else header('Location: index.php');
?>