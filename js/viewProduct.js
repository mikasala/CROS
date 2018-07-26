//****************************************************************
//view product jqueries

//category in updating product onchange function
function updateHideOthers(sel){
	$(document).ready(function(){
		if(sel.value=="Barongs" || sel.value=="Americanas"){
			
			$("#uchest").fadeOut(250);
			$("#uwaist").fadeOut(250);
			$("#uoalength").fadeOut(250);
		}else{
			$("#uchest").fadeIn(250);
			$("#uwaist").fadeIn(250);
			$("#uoalength").fadeIn(250);
		}
	});
}

function updateSetDefaultSizes(sel){
	$(document).ready(function(){
		
		if(sel.value=="Extra Small"){
			
			$("#uminchest").val(29);
			$("#umaxchest").val(31);
			$("#uminwaist").val(27);
			$("#umaxwaist").val(28);
		}
		if(sel.value=="Small"){
			
			$("#uminchest").val(32);
			$("#umaxchest").val(34);
			$("#uminwaist").val(29);
			$("#umaxwaist").val(31);
		}
		if(sel.value=="Medium"){
			
			$("#uminchest").val(35);
			$("#umaxchest").val(37);
			$("#uminwaist").val(32);
			$("#umaxwaist").val(34);
		}
		if(sel.value=="Large"){
			
			$("#uminchest").val(38);
			$("#umaxchest").val(40);
			$("#uminwaist").val(35);
			$("#umaxwaist").val(36);
		}
		if(sel.value=="Extra Large"){
			
			$("#uminchest").val(41);
			$("#umaxchest").val(43);
			$("#uminwaist").val(37);
			$("#umaxwaist").val(39);
		}
		if(sel.value=="XXL"){
			
			$("#uminchest").val(44);
			$("#umaxchest").val(46);
			$("#uminwaist").val(40);
			$("#umaxwaist").val(42);
		}
	});
}



