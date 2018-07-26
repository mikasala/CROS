<html>
<head>
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script>			
		$(document).ready(function(){
			
			$("#tryMe").click(function(){
				
				var trryText = $("#tryText").val();
				
				
				$.ajax({
					url: 'tryShow2.php',
					type: 'POST',
					data: new FormData( "#tryform" ),
					processData: false,
					contentType: false,
					success: function (data) {
						$('#tryform').fadeOut(800, function(){
                            $('#tryform').html(data).fadeIn().delay(2000);

                        });
					}
				});
				
				e.preventDefault();
			});
		});
</script>

</head>
<body>
<?php
	
	
	echo "ilove you";
	
	echo '

		<form id="tryform" method="post" >
			<input type="text" id="tryText" name="textT" />
			<input type="submit" name="tryButton" value="TRY ME!"/>
		</form><br/><br/>
		<div id="tryMe" style="cursor: pointer; width: 40px;padding: 1px; background: yellow">Click Me</div>
	
		<iframe id="mainContent"  src="tryShow2.php" style="height: 200px;width:200px;border: 1px solid black;">';
		//include "tryShow2.php";
	echo '</iframe>';
	
	
?>

</body>
</html>
