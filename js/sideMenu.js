function loadSelectList(){
	$(document).ready(function(){
		$("#barongsHolder").load('viewList.php',{category: "Barongs"});
		$("#americanasHolder").load('viewList.php',{category: "Americanas"});
		$("#gownsHolder").load('viewList.php',{category: "Gowns"});
		$("#sagalasHolder").load('viewList.php',{category: "Sagalas"});
		$("#promHolder").load('viewList.php',{category: "Prom Dress"});
		
	});
}

function loadOrderList(){
	$(document).ready(function(){
		$("#pendingHolder").load('viewOrderList.php',{status : "Pending"});
		$("#confirmedHolder").load('viewOrderList.php',{status : "Confirmed"});
	});
}


$(document).ready(function(){
	
	if(isAdmin){
		//********side menus click functions for admin***********/
		$("#addSide").click(function(){
			if($("#selectSide").css("top")!="110px"){
				$("#selectProductDiv").fadeOut(350);
				$("#selectSide").animate({ top: "110px" }, 400);
				$("#selectSide").animate({ width: '90%' }, 300);
				$("#selectSide").queue(function() {
					$(".sideMenu2").css("transform","skewX(40deg)").dequeue();
					$(this).css("transform","skewX(-40deg)").dequeue();
				});
				$("#selectSide").animate({left: "0"}, 300);
			}
			if($("#ordersSide").css("top")!="180px"){
				$("#ordersDiv").fadeOut(350);
				$("#ordersSide").animate({ top: "180px" }, 400);
				$("#ordersSide").animate({ width: '90%' }, 300);
				$("#ordersSide").queue(function() {
					$(".sideMenu3").css("transform","skewX(40deg)").dequeue();
					$(this).css("transform","skewX(-40deg)").dequeue();
				});
				$("#ordersSide").animate({left: "0"}, 300);
			}
				
			if($("#addSide").css("top")=="40px"){
				$("#addSide").animate({left: "110%"}, 400);
				$("#addSide").queue(function() {
					$(this).css("transform","skewX(0deg)").dequeue();
					$(".sideMenu1").css("transform","skewX(0deg)").dequeue();
				});
				$("#addSide").animate({ width: "400%" }, 400);
				$("#addSide").animate({ top: "11px" }, 500);
				$("#addProductDiv").delay(1000).show('slide', { direction: 'up' }, 350);
				//$("#addProduct").delay(900).slideToggle(700, "easeOutBounce");
			}else{
				$("#addProductDiv").fadeOut(350);
				$("#addSide").animate({ top: "40px" }, 400);
				$("#addSide").animate({ width: '90%' }, 300);
				$("#addSide").queue(function() {
					$(".sideMenu1").css("transform","skewX(40deg)").dequeue();
					$(this).css("transform","skewX(-40deg)").dequeue();
				});
				$("#addSide").animate({left: "0"}, 300);
			}
			
		});
		
		$("#selectSide").click(function(){
			if($("#addSide").css("top")!="40px"){
				$("#addProductDiv").fadeOut(350);
				$("#addSide").animate({ top: "40px" }, 500);
				$("#addSide").animate({ width: '90%' }, 400);
				$("#addSide").queue(function() {
					$(".sideMenu1").css("transform","skewX(40deg)").dequeue();
					$(this).css("transform","skewX(-40deg)").dequeue();
				});
				$("#addSide").animate({left: "0"}, 400);
			}
			if($("#ordersSide").css("top")!="180px"){
				$("#ordersDiv").fadeOut(350);
				$("#ordersSide").animate({ top: "180px" }, 400);
				$("#ordersSide").animate({ width: '90%' }, 300);
				$("#ordersSide").queue(function() {
					$(".sideMenu3").css("transform","skewX(40deg)").dequeue();
					$(this).css("transform","skewX(-40deg)").dequeue();
				});
				$("#ordersSide").animate({left: "0"}, 300);
			}
			
			if($("#selectSide").css("top")=="110px"){
				$("#selectSide").animate({left: "110%"}, 400);
				$("#selectSide").queue(function() {
					$(this).css("transform","skewX(0deg)").dequeue();
					$(".sideMenu2").css("transform","skewX(0deg)").dequeue();
				});
				$("#selectSide").animate({ width: "400%" }, 400);
				$("#selectSide").animate({ top: "11px" }, 500);
				loadSelectList();
				$("#selectProductDiv").delay(1000).show('slide', { direction: 'up' }, 350);
				
			}else{
				$("#selectProductDiv").fadeOut(350);
				$("#selectSide").animate({ top: "110px" }, 400);
				$("#selectSide").animate({ width: '90%' }, 300);
				$("#selectSide").queue(function() {
					$(".sideMenu2").css("transform","skewX(40deg)").dequeue();
					$(this).css("transform","skewX(-40deg)").dequeue();
				});
				$("#selectSide").animate({left: "0"}, 300);
			}
		});
		
		$("#ordersSide").click(function(){
			if($("#addSide").css("top")!="40px"){
				$("#addProductDiv").fadeOut(350);
				$("#addSide").animate({ top: "40px" }, 500);
				$("#addSide").animate({ width: '90%' }, 400);
				$("#addSide").queue(function() {
					$(".sideMenu1").css("transform","skewX(40deg)").dequeue();
					$(this).css("transform","skewX(-40deg)").dequeue();
				});
				$("#addSide").animate({left: "0"}, 400);
			}
			if($("#selectSide").css("top")!="110px"){
				$("#selectProductDiv").fadeOut(350);
				$("#selectSide").animate({ top: "110px" }, 400);
				$("#selectSide").animate({ width: '90%' }, 300);
				$("#selectSide").queue(function() {
					$(".sideMenu2").css("transform","skewX(40deg)").dequeue();
					$(this).css("transform","skewX(-40deg)").dequeue();
				});
				$("#selectSide").animate({left: "0"}, 300);
			}
			if($("#ordersSide").css("top")=="180px"){
				$("#ordersSide").animate({left: "110%"}, 400);
				$("#ordersSide").queue(function() {
					$(this).css("transform","skewX(0deg)").dequeue();
					$(".sideMenu3").css("transform","skewX(0deg)").dequeue();
				});
				$("#ordersSide").animate({ width: "400%" }, 400);
				$("#ordersSide").animate({ top: "11px" }, 500);
				loadOrderList();
				$("#ordersDiv").delay(1150).show('slide', { direction: 'up' }, 350);
			}else{
				$("#ordersDiv").fadeOut(350);
				$("#ordersSide").animate({ top: "180px" }, 400);
				$("#ordersSide").animate({ width: '90%' }, 300);
				$("#ordersSide").queue(function() {
					$(".sideMenu3").css("transform","skewX(40deg)").dequeue();
					$(this).css("transform","skewX(-40deg)").dequeue();
				});
				$("#ordersSide").animate({left: "0"}, 300);
			}
		});
		
		//***************************************************************/
		
		//***************************************************************/
		//AJAX! ORAAYT!
		$('#addForm').submit( function( e ) {
			
			var proceedNew = false;
			var category = $("#category").val();
			var photo = $('#photo').val();
			var productName = $("#prodName").val();
			var clothType = $("#ctype").val();
			var quantity = $("#quantity").val();
			var bodySize = $("#bodysize").val();
			var minChest = $("#minchest").val();
			var maxChest = $("#maxchest").val();
			var minWaist = $("#minwaist").val();
			var maxWaist = $("#maxwaist").val();
			var length = $("#overalllen").val();
			var price = $("#price").val();
			var details = $("#description").val();
			
			if(category=="--- Category ---"){
				alert("Please choose a category.");
				$("#category").focus();
			}else if(!photo){
				alert("Please choose a photo.");
				$('#photo').focus();
			}else if(!productName){
				alert("Please fill in product name.");
				$("#prodName").focus();
			}else if(!clothType){
				alert("Please fill in cloth type.");
				$("#ctype").focus();
			}else if(!quantity){
				alert("Please fill in quantity.");
				$("#quantity").focus();
			}else if(bodySize=="--- Size ---"){
				alert("Please choose a size.");
				$("#bodysize").focus();
			}else if(maxChest<minChest){
				alert("Please provide appropriate chest measurements.");
				$("#maxchest").focus();
			}else if(maxWaist<minWaist){
				alert("Please provide appropriate waist measurements.");
				$("#maxwaist").focus();
			}else{
				//$('#addProductDiv',this).html('<img src="pics/loading.gif" />');
				$.ajax({
					url: 'upload.php',
					type: 'POST',
					data: new FormData( this ),
					processData: false,
					contentType: false,
					
					success: function (data) {
						if(data=="Your product has been uploaded."){
							if(confirm(data+"\n\nDo you want to add a new product?")){
								$("#addForm")[0].reset();
								$("#chest").fadeIn(250);
								$("#waist").fadeIn(250);
								$("#oalength").fadeIn(250);
							}else{
								/*$("#addForm")[0].reset();
								$("#addProductDiv").delay(300).fadeOut(350);
								$("#addSide").delay(300).animate({ top: "40px" }, 400);
								$("#addSide").animate({ width: '90%' }, 300);
								$("#addSide").queue(function() {
									$(".sideMenu1").css("transform","skewX(40deg)").dequeue();
									$(this).css("transform","skewX(-40deg)").dequeue();
								});
								$("#addSide").animate({left: "0"}, 300);
								*/
								window.location.href = "";
							}
						}else alert(data);
					}
				});
				
				e.preventDefault();
			}
			e.preventDefault();
		});
		
	}else{
		$("#barongs").click(function(){
			//reset all other buttons
			$(".sideMenu2").css({transform: "skewX(40deg)"});
			$(".sideMenu2").text("AMERICANAS");
			$("#americanas").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu3").css({transform: "skewX(40deg)"});
			$(".sideMenu3").text("GOWNS");
			$("#gowns").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu4").css({transform: "skewX(40deg)"});
			$(".sideMenu4").text("SAGALAS");
			$("#sagalas").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu5").css({transform: "skewX(40deg)"});
			$(".sideMenu5").text("PROM DRESS");
			$("#prom").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			//main
			if($(".sideMenu1").text()=="ALL PRODUCTS"){
				$(".sideMenu1").css({transform: "skewX(40deg)"});
				$(".sideMenu1").text("BARONGS");
				$(this).css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
				$("#mainContent").fadeOut(400);
				$("#mainContent").load('products.php');
				$("#mainContent").fadeIn(400);
			}else{
				$(this).css({transform: "rotateY(180deg)",transform: "skewX(40deg)"});
				$(".sideMenu1").text("ALL PRODUCTS");
				$(".sideMenu1").css({transform: "skewX(-40deg)"});
				$("#mainContent").fadeOut(400);
				$("#mainContent").load('category.php',{category: "Barongs"});
				$("#mainContent").fadeIn(400);
			}
		});
		$("#americanas").click(function(){
			//reset all other buttons
			$(".sideMenu1").css({transform: "skewX(40deg)"});
			$(".sideMenu1").text("BARONGS");
			$("#barongs").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu3").css({transform: "skewX(40deg)"});
			$(".sideMenu3").text("GOWNS");
			$("#gowns").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu4").css({transform: "skewX(40deg)"});
			$(".sideMenu4").text("SAGALAS");
			$("#sagalas").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu5").css({transform: "skewX(40deg)"});
			$(".sideMenu5").text("PROM DRESS");
			$("#prom").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			//main
			if($(".sideMenu2").text()=="ALL PRODUCTS"){
				$(".sideMenu2").css({transform: "skewX(40deg)"});
				$(".sideMenu2").text("AMERICANAS");
				$(this).css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
				$("#mainContent").fadeOut(400);
				$("#mainContent").load('products.php');
				$("#mainContent").fadeIn(400);
			}else{
				$(this).css({transform: "rotateY(180deg)",transform: "skewX(40deg)"});
				$(".sideMenu2").text("ALL PRODUCTS");
				$(".sideMenu2").css({transform: "skewX(-40deg)"});
				$("#mainContent").fadeOut(400);
				$("#mainContent").load('category.php',{category: "Americanas"});
				$("#mainContent").fadeIn(400);
			}
		});
		$("#gowns").click(function(){
			//reset all other buttons
			$(".sideMenu1").css({transform: "skewX(40deg)"});
			$(".sideMenu1").text("BARONGS");
			$("#barongs").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu2").css({transform: "skewX(40deg)"});
			$(".sideMenu2").text("AMERICANAS");
			$("#americanas").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu4").css({transform: "skewX(40deg)"});
			$(".sideMenu4").text("SAGALAS");
			$("#sagalas").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu5").css({transform: "skewX(40deg)"});
			$(".sideMenu5").text("PROM DRESS");
			$("#prom").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			//main
			if($(".sideMenu3").text()=="ALL PRODUCTS"){
				$(".sideMenu3").css({transform: "skewX(40deg)"});
				$(".sideMenu3").text("GOWNS");
				$(this).css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
				$("#mainContent").fadeOut(400);
				$("#mainContent").load('products.php');
				$("#mainContent").fadeIn(400);
			}else{
				$(this).css({transform: "rotateY(180deg)",transform: "skewX(40deg)"});
				$(".sideMenu3").text("ALL PRODUCTS");
				$(".sideMenu3").css({transform: "skewX(-40deg)"});
				$("#mainContent").fadeOut(400);
				$("#mainContent").load('category.php',{category: "Gowns"});
				$("#mainContent").fadeIn(400);
			}
		});
		$("#sagalas").click(function(){
			//reset all other buttons
			$(".sideMenu1").css({transform: "skewX(40deg)"});
			$(".sideMenu1").text("BARONGS");
			$("#barongs").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu2").css({transform: "skewX(40deg)"});
			$(".sideMenu2").text("AMERICANAS");
			$("#americanas").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu3").css({transform: "skewX(40deg)"});
			$(".sideMenu3").text("GOWNS");
			$("#gowns").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu5").css({transform: "skewX(40deg)"});
			$(".sideMenu5").text("PROM DRESS");
			$("#prom").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			//main
			if($(".sideMenu4").text()=="ALL PRODUCTS"){
				$(".sideMenu4").css({transform: "skewX(40deg)"});
				$(".sideMenu4").text("SAGALAS");
				$(this).css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
				$("#mainContent").fadeOut(400);
				$("#mainContent").load('products.php');
				$("#mainContent").fadeIn(400);
			}else{
				$(this).css({transform: "rotateY(180deg)",transform: "skewX(40deg)"});
				$(".sideMenu4").text("ALL PRODUCTS");
				$(".sideMenu4").css({transform: "skewX(-40deg)"});
				$("#mainContent").fadeOut(400);
				$("#mainContent").load('category.php',{category: "Sagalas"});
				$("#mainContent").fadeIn(400);
			}
		});
		$("#prom").click(function(){
			//reset all other buttons
			$(".sideMenu1").css({transform: "skewX(40deg)"});
			$(".sideMenu1").text("BARONGS");
			$("#barongs").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu2").css({transform: "skewX(40deg)"});
			$(".sideMenu2").text("AMERICANAS");
			$("#americanas").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu3").css({transform: "skewX(40deg)"});
			$(".sideMenu3").text("GOWNS");
			$("#gowns").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			$(".sideMenu4").css({transform: "skewX(40deg)"});
			$(".sideMenu4").text("SAGALAS");
			$("#sagalas").css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
			
			//main
			if($(".sideMenu5").text()=="ALL PRODUCTS"){
				$(".sideMenu5").css({transform: "skewX(40deg)"});
				$(".sideMenu5").text("PROM DRESS");
				$(this).css({transform: "rotateY(180deg)",transform: "skewX(-40deg)"});
				$("#mainContent").fadeOut(400);
				$("#mainContent").load('products.php');
				$("#mainContent").fadeIn(400);
			}else{
				$(this).css({transform: "rotateY(180deg)",transform: "skewX(40deg)"});
				$(".sideMenu5").text("ALL PRODUCTS");
				$(".sideMenu5").css({transform: "skewX(-40deg)"});
				$("#mainContent").fadeOut(400);
				$("#mainContent").load('category.php',{category: "Prom Dress"});
				$("#mainContent").fadeIn(400);
			}
		});
	}
	
	
});

