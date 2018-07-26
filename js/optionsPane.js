$(document).ready(function(){
	//sign up validations
	$("#npword,#cnpword,#fname,#lname,#bdate").click(function(){
		//initializes error to be hidden
		$("#signUpError").hide('slide', { direction: 'right' }, 500);
		checkSignUpInputs();
	});
	
	//logout confirmation
	$("#logOutClick").click(function(){
		if(areYouSureLogOut())
			window.location.href = "logout.php";
	});
});