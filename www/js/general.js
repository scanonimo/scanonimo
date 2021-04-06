$(document).ready(function() {
    $("#salir_button").click(function() {
	      $.ajax({
		        type: "GET",
		        url: "php/destroy.php",
        		timeout: 5000,
        		success: function(){
                  location.reload(true)
            },
        		error: function(){
  			          toastr.options.timeOut = 5000;
  			          toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
            }
        })
    })
});
ya_no_me_completes=0
function autocomplete_now() {
  if(ya_no_me_completes){
      return
  }
  ya_no_me_completes=1
	    $( "#tags" ).autocomplete({
	      position: { collision : "flip" },
  		  select: function(event, ui) {
		        var selectedObj = ui.item;
		        anchor="#row_";
            numero_select=selectedObj.value
            numero_esp_select="_"+numero_select
            des_ocultar(numero_esp_select)
      	    anchor=anchor.concat(numero_select);
//            setTimeout(function(){ location.hash =anchor; },100);
            setTimeout(function(){ $('html,body').animate({scrollTop: $(anchor).offset().top},'slow'); },100);
            $("#no_hay_exist").addClass("oculto")
		        $(anchor).animate({backgroundColor: "yellow"}, '500');
		        $(anchor).animate({backgroundColor: "transparent"}, '500');
		        $(anchor).animate({backgroundColor: "yellow"}, 'slow');
		        $(anchor).animate({backgroundColor: "transparent"}, '500');
		        $(anchor).animate({backgroundColor: "yellow"}, 'slow');
		        $(anchor).animate({backgroundColor: "transparent"}, '500');
		        this.value = "";
		        return false;
		    },
	    });
	    $( "#codigo" ).autocomplete({
	      position: { collision : "flip" },
		    select: function(event, ui) {
		        var selectedObj = ui.item;
		        anchor="#row_";
            numero_select=selectedObj.value
            numero_esp_select="_"+numero_select
            des_ocultar(numero_esp_select)
      	    anchor=anchor.concat(numero_select);
//            setTimeout(function(){ location.hash =anchor; },100);
            setTimeout(function(){ $('html,body').animate({scrollTop: $(anchor).offset().top},'slow'); },100);
            $("#no_hay_exist").addClass("oculto")
		        $(anchor).animate({backgroundColor: "yellow"}, '500');
		        $(anchor).animate({backgroundColor: "transparent"}, '500');
		        $(anchor).animate({backgroundColor: "yellow"}, 'slow');
		        $(anchor).animate({backgroundColor: "transparent"}, '500');
		        $(anchor).animate({backgroundColor: "yellow"}, 'slow');
		        $(anchor).animate({backgroundColor: "transparent"}, '500');
		        this.value = "";
		        return false;
		    },
	    });
  }
