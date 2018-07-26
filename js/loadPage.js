//===================required scripts=========================

$(document).ready(function(){
	
	//setting the height and width of the page based 
	//on screen resolution of the client
	
	var trueWidth = screen.width;
	var trueHeight = screen.height;
	
	var height = trueHeight - (0.18131515 * trueHeight);
	var width = trueWidth - (0.017 * trueWidth);
	
	//alert("Width is : " + width + "\nHeight is : " + height);
	$('html').css("height",height);
	$('html').css("width",width);
	//1355 x 652
	
	//home or refresh page
	$("#titleHead").click(function(){
		window.location.href = "";
	});
	
});

//hides shown (if any) divs using Escape button
$( document ).on( 'keydown', function ( e ) {
	if ( e.keyCode === 27 ) { // ESC
		//hides login form
		$('#login').hide('slide', { direction: 'up' }, 500);
		
		//hides sign up form
		$('#signUp').hide('slide', { direction: 'up' }, 500);
		$("#signUpError").hide('slide', { direction: 'right' }, 500);
		
		if(!$('#signUp').is(':visible') && !$('#login').is(':visible') ){
			//hides product view
			$("#viewProduct").fadeOut(350);

			if(!$('#viewProduct').is(':visible')){
				//hides order view
				$("#viewOrder").fadeOut(350);
			}			
		}
		
		//hides view product first
		if(!$('#viewProduct').is(':visible') && !$('#viewOrder').is(':visible')){
			//hides cart
			$("#cart").hide('slide', { direction: 'up' }, 500);
		
			//hides admin functions forms
			//ADD PRODUCT
			$("#addProductDiv").fadeOut(350);
			$("#addSide").animate({ top: "40px" }, 400);
			$("#addSide").animate({ width: '90%' }, 300);
			$("#addSide").queue(function() {
				$(".sideMenu1").css("transform","skewX(40deg)").dequeue();
				$(this).css("transform","skewX(-40deg)").dequeue();
			});
			$("#addSide").animate({left: "0"}, 300);
		
			//SELECT PRODUCT
			$("#selectProductDiv").fadeOut(350);
			$("#selectSide").animate({ top: "110px" }, 400);
			$("#selectSide").animate({ width: '90%' }, 300);
			$("#selectSide").queue(function() {
				$(".sideMenu2").css("transform","skewX(40deg)").dequeue();
				$(this).css("transform","skewX(-40deg)").dequeue();
			});
			$("#selectSide").animate({left: "0"}, 300);
		
			//ORDERS
			$("#ordersDiv").fadeOut(350);
			$("#ordersSide").animate({ top: "180px" }, 400);
			$("#ordersSide").animate({ width: '90%' }, 300);
			$("#ordersSide").queue(function() {
				$(".sideMenu3").css("transform","skewX(40deg)").dequeue();
				$(this).css("transform","skewX(-40deg)").dequeue();
			});
			$("#ordersSide").animate({left: "0"}, 300);
		}
	}
});


//=============================================================

//===============function calls for animations=================

//show login succcess
if(showLogInSuccess){
	showToast('#loginSuccess',2000);
}


//toggles divs for sign up, login, cart, profile when clicked
toggleDiv('#signUpClick','#signUp','up');
toggleDiv('#loginClick','#login','up');
toggleDiv('#profileHover','#signUp','up');
toggleDiv('#cartClick','#cart','up');

//when the page is loaded, shows the div animations
if(!isSessionSet){
	slideDiv('#signUpClick',700,'up',500);
	slideDiv('#loginClick',700,'up',500);
}else{
	slideDiv('#logOutClick',700,'left',500);
	slideDiv('#profileHover',700,'left',500);
	slideDiv('#cartClick',700,'left',500);
}
slideDiv('#mainTitleHead',700,'up',500);

if(isAdmin){
	slideDiv('#addSide',800,'left',500);
	slideDiv('#selectSide',1000,'left',500);
	slideDiv('#ordersSide',1200,'left',500);
}else{
	slideDiv('#barongs',800,'left',500);
	slideDiv('#americanas',1000,'left',500);
	slideDiv('#gowns',1200,'left',500);
	slideDiv('#sagalas',1400,'left',500);
	slideDiv('#prom',1600,'left',500);
}
slideDiv('#mainContainer',0,'right',700);
slideDiv('#mainFooter',700,'down',500);

//===========================================================
