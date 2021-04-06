  $("#usuario, #respuesta").on("keyup change", function() {
      value=$(this).val()
      value=value.replace(/[^a-zA-Z0-9]+/, "");
      value=value.toUpperCase()
      $(this).val(value)  
  })
  $("#crear_nuevo").click(function() {
      $("#crear").slideDown( "slow" )
      $("#respuesta").addClass("required")
      $("#entrar").addClass("oculto")
      $("#crear_boton").removeClass("oculto")
      $("#crear_nuevo").addClass("oculto")
      $("#cancelar").removeClass("oculto")
      $("#crear").removeClass("oculto")
      $("title, legend").text("Crear Nuevo")
  })
  $("#ver_mas").click(function() {
      $("#ver_mas").addClass("oculto")
      $("#mas_info").removeClass("oculto")
  })
  $("#ver_menos").click(function() {
      $("#ver_mas").removeClass("oculto")
      $("#mas_info").addClass("oculto")
  })
  $("#cancelar").click(function() {
      $('#logginform').trigger("reset");
      $("label.error").text("")
      $("#crear").slideUp( "slow", function(){ 
          $("#crear").addClass("oculto")
          $("#entrar").removeClass("oculto")
          $("#crear_boton").addClass("oculto")
          $("#crear_nuevo").removeClass("oculto")
          $("#cancelar").addClass("oculto")
          $("#respuesta").removeClass("required")
      })  
      $("title, legend").text("Inicia sesión")
  })
	$.validator.messages.required = 'Llene este campo.';
	function continuar(){
        $(".error").text("")
        hay_error=false
        nuevo=0
        if(! $("#crear").hasClass("oculto")){
            nuevo=1
            if($("#again").val()!=$('#password').val()){
                $("#error1").text("Las contraseña no concuerdan")            
                hay_error=true
            }
            if(! $("#again").val()){
                $("#error1").text("Re-escriba su contraseña")
                hay_error=true
            }
            if(! $("#entiendo").prop("checked")){
                $("#error2").text("Por favor indique que ha entendido")
                hay_error=true
            }
    }
		if($("#logginform").validate().form() && !hay_error){
      $('body').loadingModal({
        text: 'Espere...',
        animation: 'threeBounce'
      });
			minusculas=$('#usuario').val();
			minusculas=minusculas.toLowerCase();
			$.ajax({
	      type: "POST",
        url: 'php/entrar.php',
        data: $.param({ nombre: minusculas, password: $('#password').val(), respuesta_env: $('#respuesta').val(), nuevo_env: nuevo }), 
        timeout: 5000,
        success: function(data) {
				    if(data=="correcto"){
					    if(! $('#data').length || nuevo){
    						    window.location.href = lugar_actual;
					    }else{
						    document.forms["data"].submit();
					    }
				    }else{
              $('body').loadingModal('hide');
              if(data=="1"){
                  $("label.error").text("")
    					    $('#error4').text("La respuesta es incorrecta. Rectifica o si lo prefieres, vuelve a cargar esta pagina hasta obtener una pregunta que sepas contestar, hay tres diferentes ;)");
              }else{
                  if(data=="Error"){
                      $('#error3').text("Lo siento es necesario refrescar la pagina. Por favor inténtelo de nuevo.");
                      setTimeout(function(){ location.reload(); },2500);
                  }else{
                              switch (data) {
                                case '2':
                                    texto="Ya existe una cuenta con ese nombre de usuario. Por favor intente con otro."
                                    break;
                                case '3':
                                    texto="La contraseña proporcionada es incorrecta por favor inténtelo de nuevo."
                                    break;
                                case '4':
                                    texto="No Tiene permisos suficiente para entrar a esta sección."
                                    break;
                                case '5':
                                    texto="El usuario no existe. Por favor revise. ¿Quizá desea registrarse?"
                                    break;
                                default:
                                    var results = data.split('|');
                                    alert(results[0])
                                    azar=results[1]
                                    if(Number.isInteger(azar)){
                                          location.href = 'error_php.php?azar='+azar
                                    }else{
                                          location.href = 'error_php.php'
                                    }
                                    return;
                                    break;
                              }                          
       					      $('#error3').text(texto);
                  }
                  window.scrollTo(0,0);
              }
				    }
			  },
        error: function(){
            $("#error3").text("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.")
            $('body').loadingModal('hide');
            window.scrollTo(0,0);
        }
      });
		}else{
          $(".error").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
    }
		return false;
	}
