 //*******************************************************************
 //javascripts
 //*******************************************************************
 
 function checkall(){
	var target=document.getElementsByTagName('input');
	for(i=0; i<target.length; i++)
	{
		if(target[i].type=='checkbox')
			target[i].checked='checked';
	}
}
//uncheck all checkboxes
function uncheckall(){
	var target=document.getElementsByTagName('input');
	for(i=0; i<target.length; i++)
	{
		if(target[i].type=='checkbox')
				target[i].checked='';
	}
}


function areYouSureDelete(){
	var confirmDelete = confirm("Continue Delete?");
	
	return confirmDelete;
}

function areYouSureLogOut(){
	var confirmLogOut = false;
	
	$(document).ready(function(){
		var count = $("#cartCount").text();
		
		
		if(count>0)
			confirmLogOut = confirm("There are "+count+" product/s in your cart.\n\nAre you sure you want to log out?");
		else confirmLogOut = confirm("Are you sure you want to log out?");
		
		
	});
	return confirmLogOut;
	
}
function areYouSureOrder(){

	var confirmOrder = confirm("Are you sure you with your order? You won't be able edit the order details.");
	
	return confirmOrder;
	
}


function areYouSureConfirm(){

	var confirmAsk = confirm("Are you sure you want to approve this order?");
	
	return confirmAsk;
	
}

function doYouWantToLogin(){
	var confirmLogin = confirm("Registration successful!\n\nDo you want to log in this account?");
	
	return confirmLogin;
}

//*******************************************************************
//jqueries
//*******************************************************************

//*******************************************************************
//for USER ACCOUNTS
//*******************************************************************
//check for login success
function checkLogin(){
	$(document).ready(function(){
		var proceed = true;
		var email = $("#email").val();
		var password = $("#pword").val();
		// Checking for blank fields.
		
		if(email ==''){
			$('input[name="uname"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
			$('input[name="uname"]').focus();
			$('input[name="pword"]').css({"border":"1px solid lightgray","box-shadow":"none"});
			alert("Please enter username.");
			proceed = false;
		}else if(password ==''){
			$('input[name="pword"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
			$('input[name="pword"]').focus();
			$('input[name="uname"]').css({"border":"1px solid lightgray","box-shadow":"none"});
			alert("Please enter password.");
			proceed = false;
		}
		
		if(proceed){
			$.post("login.php",{ uname: email, pword: password},function(data) {
				if(data=='Invalid Email') {
					$('input[name="uname"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
					$('input[name="uname"]').focus();
					$('input[name="pword"]').css({"border":"1px solid lightgray","box-shadow":"none"});
					alert(data);
				}else if(data=='Username not found'){
					$('input[name="uname"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
					$('input[name="uname"]').focus();
					$('input[name="pword"]').css({"border":"1px solid lightgray","box-shadow":"none"});
					alert(data);
				} else if(data=='Incorrect Password'){
					$('input[name="uname"]').css({"border":"1px solid lightgray","box-shadow":"none"});
					$('input[name="pword"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
					$('input[name="pword"]').focus();
					alert(data);
				} else if(data=='Successfully Log In.'){
					window.location.href = "";
				}
			});
		}
	});
	return false;
}

//check inputs
function checkSignUpInputs(){
	
	$(document).ready(function(){
		
		var password = $("#npword").val();
		var confirmPassword = $("#cnpword").val();
		var firstName = $("#fname").val();
		var lastName = $("#lname").val();
		var birthdate = $("#bdate").val();
		
		
		//checks whether updating or signing up
		if($('#eadd').is(':visible')){
			var email = $("#eadd").val();
			//checking email availability while filling up sign up form
			if(!email){
				$("#signUpError").text("(!) Please provide your email address first.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#eadd").focus();
			}else{
				if(email){
					$.post("checkEmail.php",{ uname: email},function(data) {
						if(data=='Invalid Email' || data=='Email already registered.') {
							$("#eadd").focus();
							$("#signUpError").text("(!) "+data);
							$("#signUpError").show('slide', { direction: 'right' }, 500);
						}else if(data=='Email Available.'){
							
						}
						
					});
				}
			}
		}
		
		//input by input validation
		if($("#cnpword").is(":focus")){
			//password validation
			if(!password){
				$("#signUpError").text("(!) Please provide your password.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#npword").focus();
			}else if(password.length<6 || password.length>10){
				$("#signUpError").text("(!) Please input 6-10 characters in password.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#npword").focus();
			}
		}
		if($("#fname").is(":focus")){
			//password validation
			if(!password){
				$("#signUpError").text("(!) Please provide your password.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#npword").focus();
			}else if(password.length<6 || password.length>10){
				$("#signUpError").text("(!) Please input 6-10 characters in password.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#npword").focus();
			}else if(confirmPassword!=password){//confrim password validation
				$("#signUpError").text("(!) Please confirm your password.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#cnpword").focus();
			}
		}
		if($("#lname").is(":focus")){
			//password validation
			if(!password){
				$("#signUpError").text("(!) Please provide your password.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#npword").focus();
			}else if(password.length<6 || password.length>10){
				$("#signUpError").text("(!) Please input 6-10 characters in password.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#npword").focus();
			}else if(confirmPassword!=password){//confrim password validation
				$("#signUpError").text("(!) Please confirm your password.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#cnpword").focus();
			}else if(!firstName){//first name if blank
				$("#signUpError").text("(!) Please fill in your first name.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#fname").focus();
			}
		}
		if($("#bdate").is(":focus")){
			//password validation
			if(!password){
				$("#signUpError").text("(!) Please provide your password.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#npword").focus();
			}else if(password.length<6 || password.length>10){
				$("#signUpError").text("(!) Please input 6-10 characters in password.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#npword").focus();
			}else if(confirmPassword!=password){//confirm password validation
				$("#signUpError").text("(!) Please confirm your password.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#cnpword").focus();
			}else if(!firstName){//first name if blank
				$("#signUpError").text("(!) Please fill in your first name.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#fname").focus();
			}else if(!lastName){//last name if blank
				$("#signUpError").text("(!) Please fill in your last name.");
				$("#signUpError").show('slide', { direction: 'right' }, 500);
				$("#lname").focus();
			}
		}
		
	});
}

function addUser(){

	$(document).ready(function(){
		var proceed = false, doneWithBlanks = true,doneWithEmail = true;
		var email = $("#eadd").val();
		var password = $("#npword").val();
		var confirmPassword = $("#cnpword").val();
		var firstName = $("#fname").val();
		var lastName = $("#lname").val();
		var birthdate = $("#bdate").val();
		
		// Checking for blank fields.
		if(!email){
			alert("Please provide your email address.");
			$("#eadd").focus();
			doneWithBlanks = false;
		}else if(!password){
			alert("Please provide your password.");
			$("#npword").focus();
			doneWithBlanks = false;
		}else if(!confirmPassword){
			alert("Please confirm your password.");
			$("#cnpword").focus();
			doneWithBlanks = false;
		}else if(!firstName){
			alert("Please fill in first name.");
			$("#fname").focus();
			doneWithBlanks = false;
		}else if(!lastName){
			alert("Please fill in last name.");
			$("#lname").focus();
			doneWithBlanks = false;
		}else if(!birthdate){
			alert("Please fill in birthdate.");
			$("#bdate").focus();
			doneWithBlanks = false;
		}
		//end for checking blank fields
		
		//password and age validations
		if(doneWithBlanks){
			if(password.length<6 || password.length>10){
				alert("Please input 6-10 characters in password.");
				$("#npword").focus();
			}else if(confirmPassword!=password){
				alert("Please confirm your password.");
				$("#cnpword").focus();
			}else {
				//age validation
				var bdate = new Date(birthdate);
				var today = new Date();
				var age = Math.floor((today-bdate) / (365.25 * 24 * 60 * 60 * 1000));
				if(age >= 18)
					proceed = true;
				else{
					alert("You must be at least 18 years old.");
					$("#bdate").focus();
				}
			}
		}//end of password and age validation
		
		if(proceed){
			$.post("addUser.php",{ uname: email, pword: password, fname: firstName, lname: lastName, bdate: birthdate},function(data) {
				if(data=='Invalid Email' || data=='Email already registered.') {
					$("#eadd").focus();
					alert(data);
					//$("#signUpError").text("(!) "+data);
					//$("#signUpError").show('slide', { direction: 'right' }, 500);
				}else if(data=='Registered Successfully.'){
					if(doYouWantToLogin()){
						$.post("login.php",{ uname: email, pword: password},function(data) {
							if(data=='Invalid Email') {
								$('input[name="uname"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
								$('input[name="uname"]').focus();
								$('input[name="pword"]').css({"border":"1px solid lightgray","box-shadow":"none"});
								alert(data);
							}else if(data=='Username not found'){
								$('input[name="uname"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
								$('input[name="uname"]').focus();
								$('input[name="pword"]').css({"border":"1px solid lightgray","box-shadow":"none"});
								alert(data);
							} else if(data=='Incorrect Password'){
								$('input[name="uname"]').css({"border":"1px solid lightgray","box-shadow":"none"});
								$('input[name="pword"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
								$('input[name="pword"]').focus();
								alert(data);
							} else if(data=='Successfully Log In.'){
								
							}
						});
					}
					window.location.href = "";
				}else alert(data);
			});
		}
	});
	return false;
}

function updateUser(){

	$(document).ready(function(){
		var proceed = false, doneWithBlanks = true;
		var email = $("#userEmail").val();
		var password = $("#npword").val();
		var confirmPassword = $("#cnpword").val();
		var firstName = $("#fname").val();
		var lastName = $("#lname").val();
		var birthdate = $("#bdate").val();
		
		// Checking for blank fields.
		if(!password){
			alert("Please provide your password.");
			$("#npword").focus();
			doneWithBlanks = false;
		}else if(!confirmPassword){
			alert("Please confirm your password.");
			$("#cnpword").focus();
			doneWithBlanks = false;
		}else if(!firstName){
			alert("Please fill in first name.");
			$("#fname").focus();
			doneWithBlanks = false;
		}else if(!lastName){
			alert("Please fill in last name.");
			$("#lname").focus();
			doneWithBlanks = false;
		}else if(!birthdate){
			alert("Please fill in birthdate.");
			$("#bdate").focus();
			doneWithBlanks = false;
		}
		//end for checking blank fields
		
		//password and age validations
		if(doneWithBlanks){
			if(password.length<6 || password.length>10){
				alert("Please input 6-10 characters in password.");
				$("#npword").focus();
			}else if(confirmPassword!=password){
				alert("Please confirm your password.");
				$("#cnpword").focus();
			}else {
				//age validation
				var bdate = new Date(birthdate);
				var today = new Date();
				var age = Math.floor((today-bdate) / (365.25 * 24 * 60 * 60 * 1000));
				if(age >= 18)
					proceed = true;
				else{
					alert("You must be at least 18 years old.");
					$("#bdate").focus();
				}
			}
		}//end of password and age validation
		
		if(proceed){
			
			$.post("updateUser.php",{ uname: email, pword: password, fname: firstName, lname: lastName, bdate: birthdate},function(data) {
				if(data=='Updated Successfully.'){
					alert(data);
					window.location.href = "";
				}else alert(data);
			});
		}
	});
	return false;
}

//*******************************************************************
//for PRODUCTS
//*******************************************************************
//category in adding product onchange function
function hideOthers(sel){
	$(document).ready(function(){
		if(sel.value=="Barongs" || sel.value=="Americanas"){
			
			$("#chest").fadeOut(250);
			$("#waist").fadeOut(250);
			$("#oalength").fadeOut(250);
		}else{
			$("#chest").fadeIn(250);
			$("#waist").fadeIn(250);
			$("#oalength").fadeIn(250);
		}
	});
}



function closeThis(){
	$(document).ready(function(){
		$("#viewProduct").fadeOut(400);
		if(!$('#viewProduct').is(':visible')){
			$("#viewOrder").fadeOut(400);
		}
	});
}

function showThisProduct(prodid){
	$(document).ready(function(){
		$("#viewProductHolder").load('viewProduct.php',{productid: prodid});
		$("#viewProduct").fadeIn(400);
	});
}



function showThisCodeProduct(){
	$(document).ready(function(){
		var prodCode = $("#prodcode").val();
		if(!prodCode){
			alert("Please enter product code.");
			$("#prodcode").focus();
		}else{
			$.post("getProdId.php",{ prodcode: prodCode},function(data) {
				if(data!="Product code not found"){
					var prodid = data;
					showThisProduct(prodid);
				}else alert(data);
			});
		}
	});
}

//adding and removing product to cart
function addRemoveCart(button,productid){
	$(document).ready(function(){
		var toDo = button.value;
		
		if(toDo=="Add to Cart"){
			$.post("addCart.php",{ prodid: productid},function(data) {
				if(data!="Item already in the cart"){
					//updates cart count from options pane
					$("#cartCount").text(data);
					
					$('#cartFieldset').slideUp(300);
					//updates the button
					button.value = "Remove from Cart";
					//updates cart info if visible
					$('#cartFieldset').load('cart.php');
					$('#cartFieldset').slideDown(400);
					//updates product cart function if visible
					if($('#viewProduct').is(':visible')){
						$("#viewProductHolder").fadeOut(300);
						$("#viewProductHolder").load('viewProduct.php',{productid: productid});
						$("#viewProductHolder").fadeIn(300);
					}
				}else if(data=="Item already in the cart"){
					alert(data);
				}else alert("Failed to add.");
			});
		}else if(toDo=="Remove from Cart"){
			$.post("removeCart.php",{ prodid: productid},function(data) {
				if(data!="Item is not in the cart"){
					
					$("#cartCount").text(data);
					
					$('#cartFieldset').slideUp(300);
					button.value = "Add to Cart";
					$('#cartFieldset').load('cart.php');
					$('#cartFieldset').slideDown(400);
					if($('#viewProduct').is(':visible')){
						$("#viewProductHolder").fadeOut(300);
						$("#viewProductHolder").load('viewProduct.php',{productid: productid});
						$("#viewProductHolder").fadeIn(300);
					}
				}else if(data=="Item is not in the cart"){
					alert(data);
				}else alert("Failed to remove.");
			});
		}else alert(toDo+" Failed to process your request");
	});
}


//adding and removing product to cart while viewing product
function addRemoveProductCart(span,productid){
	$(document).ready(function(){
		var toDo = span.id;
		var buttonToToggle = "#"+productid+"buttonForCart";
		
		if(toDo=="addProd"){
			$.post("addCart.php",{ prodid: productid},function(data) {
				if(data!="Item already in the cart"){
					
					$("#cartCount").text(data);
					
					$('#cartFieldset').slideUp(300);
					//update the corresponding button in general view
					$(buttonToToggle).val("Remove from Cart");
					$('#cartFieldset').load('cart.php');
					$('#cartFieldset').slideDown(400);
					if($('#viewProduct').is(':visible')){
						$("#viewProductHolder").fadeOut(300);
						$("#viewProductHolder").load('viewProduct.php',{productid: productid});
						$("#viewProductHolder").fadeIn(300);
					}
				}else if(data=="Item already in the cart"){
					alert(data);
				}else alert("Failed to add.");
			});
		}else if(toDo=="removeProd"){
			$.post("removeCart.php",{ prodid: productid},function(data) {
				if(data!="Item is not in the cart"){
					
					$("#cartCount").text(data);
					
					$('#cartFieldset').slideUp(300);
					$(buttonToToggle).val("Add to Cart");
					$('#cartFieldset').load('cart.php');
					$('#cartFieldset').slideDown(400);
					if($('#viewProduct').is(':visible')){
						$("#viewProductHolder").fadeOut(300);
						$("#viewProductHolder").load('viewProduct.php',{productid: productid});
						$("#viewProductHolder").fadeIn(300);
					}
				}else if(data=="Item is not in the cart"){
					alert(data);
				}else alert("Failed to remove.");
			});
		}else alert(toDo+" Failed to process your request");
	});
}



//removing product from cart in option pane
function removeProductFromCartNoRefresh(productid){
	
	$(document).ready(function(){
		var buttonToToggle = "#"+productid+"buttonForCart";
		
		$.post("removeCart.php",{ prodid: productid},function(data) {
			if(data!="Item is not in the cart"){
				
				$("#cartCount").text(data);
				
				$('#cartFieldset').slideUp(300);
				//updates the corresponding button
				$(buttonToToggle).val("Add to Cart");
				$('#cartFieldset').load('cart.php');
				$('#cartFieldset').slideDown(400);
				if($('#viewProduct').is(':visible')){
					if($("#productIdHolder").val()==productid){
						$("#viewProductHolder").fadeOut(300);
						$("#viewProductHolder").load('viewProduct.php',{productid: productid});
						$("#viewProductHolder").fadeIn(300);
					}
				}
			}else if(data=="Item is not in the cart"){
				alert(data);
			}else alert("Failed to remove.");
		});
	});
}

function setDefaultSizes(sel){
	$(document).ready(function(){
		
		if(sel.value=="Extra Small"){
			
			$("#minchest").val(29);
			$("#maxchest").val(31);
			$("#minwaist").val(27);
			$("#maxwaist").val(28);
		}
		if(sel.value=="Small"){
			
			$("#minchest").val(32);
			$("#maxchest").val(34);
			$("#minwaist").val(29);
			$("#maxwaist").val(31);
		}
		if(sel.value=="Medium"){
			
			$("#minchest").val(35);
			$("#maxchest").val(37);
			$("#minwaist").val(32);
			$("#maxwaist").val(34);
		}
		if(sel.value=="Large"){
			
			$("#minchest").val(38);
			$("#maxchest").val(40);
			$("#minwaist").val(35);
			$("#maxwaist").val(36);
		}
		if(sel.value=="Extra Large"){
			
			$("#minchest").val(41);
			$("#maxchest").val(43);
			$("#minwaist").val(37);
			$("#maxwaist").val(39);
		}
		if(sel.value=="XXL"){
			
			$("#minchest").val(44);
			$("#maxchest").val(46);
			$("#minwaist").val(40);
			$("#maxwaist").val(42);
		}
	});
}

//*******************************************************************
//for ORDERS
//*******************************************************************
function addOrder(){
	$(document).ready(function(){
		$("#viewOrderHolder").load('newOrder.php');
		$("#viewOrder").fadeIn(400);
		$("#viewOrderHolder").show();
	});
}

function viewThisOrder(orderno){
	$(document).ready(function(){
		$("#viewOrderHolder").hide('slide', { direction: "left" }, 400);
		$("#viewOrderHolder").load('viewOrder.php',{ordernum : orderno});
		$("#viewOrder").fadeIn(400);
		$("#viewOrderHolder").show('slide', { direction: "right" }, 400);
	});
}

function showAllClientOrders(client){
	$(document).ready(function(){
		$("#viewOrderHolder").hide('slide', { direction: "right" }, 400);
		$("#viewOrderHolder").load('viewClientOrders.php',{client : client});
		$("#viewOrder").fadeIn(400);
		$("#viewOrderHolder").show('slide', { direction: "left" }, 400);
	});
}
function viewThisOrderNo(){
	$(document).ready(function(){
		var refnum = $("#findrefnum").val();
		if(!refnum){
			alert("Please enter reference number.");
			$("#findrefnum").focus();
		}else{
			$.post("getOrderNo.php",{ refnum: refnum},function(data) {
				if(data!="Reference number not found"){
					var orderno = data;
					viewThisOrder(orderno);
				}else alert(data);
			});
		}
	});
}


//*******************************************************************
//jquery for animations
//*******************************************************************
function toggleDiv(toClick,toToggle,fromWhatDirection){
	$(document).ready(function(){
		
		$(toClick).click(function(){
			
			$(toToggle).toggle('slide', { direction: fromWhatDirection }, 500);
			
			if(toClick=='#loginClick'){
				$('#email').focus();
				$('#signUpError').hide('slide', { direction: fromWhatDirection }, 250);
				if($('#signUp').is(':visible')){
					$('#signUp').hide('slide', { direction: fromWhatDirection }, 250);
					$("#signUpError").hide('slide', { direction: 'right' }, 500);
				}
			}
			if(toClick=='#signUpClick'){
				$('#eadd').focus();				
				$("#signUpError").hide('slide', { direction: 'right' }, 500);
				if($('#login').is(':visible'))
					$('#login').hide('slide', { direction: fromWhatDirection }, 250);
			}
			if(toClick=='#profileHover'){
				$('#npword').focus();				
				$("#signUpError").hide('slide', { direction: 'right' }, 500);
				if($('#cart').is(':visible'))
					$('#cart').hide('slide', { direction: fromWhatDirection }, 250);
			}
			if(toClick=='#cartClick'){		
				$("#signUpError").hide('slide', { direction: 'right' }, 500);
				if($('#signUp').is(':visible'))
					$('#signUp').hide('slide', { direction: fromWhatDirection }, 250);
				$('#cartFieldset').slideUp(300);
				$('#cartFieldset').load('cart.php');
				$('#cartFieldset').slideDown(400);
			}
		});
	});
}

//slides a div behaving from given parameters
function slideDiv(toSlide,delayTime,fromWhatDirection,duration){
	$( window ).load(function() {
		
		$(toSlide).delay(delayTime).show('slide', { direction: fromWhatDirection }, duration);
		
	});
}

//show a div on hover
function mouseEnterLeave(toMouse,toToggle){
	$(document).ready(function(){
		$(toMouse).mouseenter( function() {
			$(toToggle).show();
		});

		$(toMouse).mouseleave( function() {
			$(toToggle).hide();
		});
	});
}

//hides a div
function hideDiv(toHide){
	$(window).load(function(){
		$(toHide).hide('slide', { direction: 'up' }, 0);
	});
}

//show toast message
function showToast(toToast,delayTime){
	$(document).ready(function(){
		$(toToast).fadeIn(400).delay(delayTime).fadeOut(400);
	});
}
//**************************************************************














