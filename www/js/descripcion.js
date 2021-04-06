$(document).ready(function() {
	$("#tags").focusin(function(){
		if($("#tags").val()=="Nombre"){
			$("#tags").val("");
			$("#tags").css("color", "black");	
		};
	});
	$("#codigo").focusin(function(){
		if($("#codigo").val()=="Código"){
			$("#codigo").val("");
			$("#codigo").css("color", "black");	
		};
	});
});
