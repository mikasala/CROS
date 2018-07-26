<?php
	$textValue = "hoho";
	if(isset($_POST['textT'])){
		echo $_POST['textT'];
		$textValue = $_POST['textT'];
	}
	
?>
<div><?php echo $textValue;?>
</div>