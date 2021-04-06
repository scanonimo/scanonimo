    $('#error_form').trigger("reset");
    $("#email").trigger("keyup")
    $("#boton4").click(function(){
          $("#coment2").text("Escriba su información y conteste la pregunta al final.")
          location.hash="#coment2";
          setTimeout(function(){ $("#personal").slideDown( "slow" ); },100)
          $("#boton4").addClass("oculto")
    })
    $('body').loadingModal({
      text: 'Espere...',
      animation: 'threeBounce'
    });
    $('body').loadingModal('hide');
    $("#respuesta").on("keyup change", function() {
        value=$(this).val()
        value=value.replace(/[^a-zA-Z0-9]+/, "");
        value=value.toUpperCase()
        $(this).val(value)  
    })
    $("#boton1").click(function(){
            $(".error").text("")
            validado=true
            if (typeof reporte_de_error !== 'undefined') {            
                      if($("#expectativa").val()=="" || $("#expectativa").hasClass("sin_def")){
                              $("#error7").text("Por favor llene este campo primero.")
                              location.hash="#expectativa";
                              validado=false              
                      }
                      if($("#cuando_ocurrio").val()=="" || $("#cuando_ocurrio").hasClass("sin_def")){
                              $("#error6").text("Por favor llene este campo primero.")
                              location.hash="#cuando_ocurrio";
                              validado=false              
                      }
            }
            if (typeof mensaje_de_contacto !== 'undefined') {            
                      if($("#mensaje").val()=="" || $("#mensaje").hasClass("sin_def")){
                              $("#error7").text("Por favor llene este campo primero.")
                              location.hash="#mensaje";
                              validado=false              
                      }
                      if($("#asunto").val()=="" || $("#asunto").hasClass("sin_def")){
                              $("#error6").text("Por favor llene este campo primero.")
                              location.hash="#asunto";
                              validado=false              
                      }
            }
            if($("#respuesta").hasClass("sin_def") || !$("#respuesta").val()){
                  $("#error4").text("Por favor conteste la pregunta.")
                  validado=false
            }else{
                  if($("#respuesta").val().length < 3){
                        $("#error4").text("La respuesta debe ser de 3 letras.")
                        validado=false
                  }
            }
            if(!$("#telef").hasClass("sin_def")){
                valor=$("#telef").val().replace(/[^0-9]+/g, "")
                if(valor.length != 10){
                    $("#telef").focus()
                    $("#error2").text("Proporcione su telefono a 10 dígitos o más, de lo contrario deje vació el campo.")
                    validado=false
                }
            }
            if(!$("#email").hasClass("sin_def")){
                $("#email").addClass("email")
                if(!$("#error_form").validate().form()){
                    $("#email").focus()
                    validado=false
                }
            }else{
                $("#email").removeClass("email")
            }
            if(validado){
                  $('body').loadingModal('show');
                  obtener_para_enviar()
                  $.ajax({
                        type: "POST",
                        url: 'php/email_error2.php',
                        data: $.param(para_enviar),
                        timeout: 5000,
                        success: function(data) {
                              $('body').loadingModal('hide');
                              var results = data.split('|');
                              switch (results[0]) {
                                case '1':
                                    $("#exitoso").removeClass("oculto");
                                    $("#primero").addClass("oculto");
                                    $("#preguntar").addClass("oculto");
                                    break;
                                case '2':
                                    $("#coment1").addClass("oculto")
                                    $("#error5").text("El tiempo para responder la pregunta se agoto. Por favor intente contestar esta pregunta en su lugar.")
                                    $("#pregunta").text(results[1]);
                                    break;
                                case '3':
                                    $("#respuesta").val("")
                                    $("#respuesta").focus()
                                    $("#error4").text("Respuesta incorrecta. Intente de nuevo o cambie de pregunta.")
                                    break;
                                case '4':
                                    $("#coment1").addClass("oculto")
                                    $("#primero").addClass("oculto")
                                    $("#preguntar").addClass("oculto")
                                    $("#error6").removeClass("oculto")
                                    break;
                                default:
                                    $("#error3").text(data)
                                    setTimeout(function(){ window.scrollTo(0,0) }, 200);
                                    break;
                              }

                        },
                        error: function(){
                              $('body').loadingModal('hide');
                              toastr.options.timeOut = 5000;
                              toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
                        }
                  })
            }
    })
    $("#boton2").click(function(){
            $('body').loadingModal('show');
            $.ajax({
                  type: "POST",
                  url: 'php/cambiar_pregunta.php',
                  timeout: 5000,
                  success: function(data) {
                        $('body').loadingModal('hide');
                        var results = data.split(';');
                        switch (results[0]) {
                          case '1':
                              $("#pregunta").text(results[1]);
                              break;
                          default:
                              $("#error3").text(data)
                              setTimeout(function(){ window.scrollTo(0,0) }, 200);
                              break;
                        }

                  },
                  error: function(){
                        $('body').loadingModal('hide');
                        toastr.options.timeOut = 5000;
                        toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
                  }
            })          
    })
    valores={}
    $("input, textarea").focusin(function() {
        if($(this).hasClass("sin_def")) {
            my_id=$(this).attr('id')
            valores[my_id]=$(this).val()
            if(do_it){
                if(my_id=="email" && $("#telef").hasClass("sin_def")){
                    $("#telef").val("Numero de Celular"+" (Opcional)")
                }else{
                    if(my_id=="telef" && $("#email").hasClass("sin_def")){
                        $("#email").val("Correo Electrónico"+" (Opcional)")
                    }
                }
            }
            $(this).removeClass("sin_def")
            $(this).val("")
        }
    })
    $("input, textarea").focusout(function() {
        valor=$(this).val().replace(/ /g, '')
        if(!valor){
              my_id=$(this).attr('id')
              $("#email").removeClass("email")
              $(this).val(valores[my_id])
              $(this).addClass("sin_def")
              if(do_it){
                    if($("#email").hasClass("sin_def") && $("#telef").hasClass("sin_def")){
                        $("#email").val("Correo Electrónico")
                        $("#telef").val("Numero de Celular")
                    }
              }
        }
    })
    $("input, textarea").on("keyup change", function() {
        my_id=$(this).attr('id')
        if(my_id=="telef"){
            valor=$(this).val().replace(/[^0-9() \-]+/g, "")
            $(this).val(valor)
        }else{
            if(my_id=="email"){
                valor=$(this).val().replace(/ /g, '')
                $(this).val(valor)
            }else{
                valor=$(this).val().replace(/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\,\:\¡\!\¿\?\-\.\ \\\n]+/g, "");
                $(this).val(valor)
            }
        }
        if(do_it){
              if(my_id=="telef" || my_id=="email"){
                    if(($("#email").val()=="" || $("#email").hasClass("sin_def")) && ($("#telef").val()=="" || $("#telef").hasClass("sin_def"))){
                          $("#enviar").prop('disabled', true);
                    }else{
                          $("#enviar").prop('disabled', false);        
                    }
              }
        }
        if (typeof reporte_de_error !== 'undefined') {
              if(($("#cuando_ocurrio").val()=="" || $("#cuando_ocurrio").hasClass("sin_def")) || ($("#expectativa").val()=="" || $("#expectativa").hasClass("sin_def"))){
                    $("#enviar").prop('disabled', true);
              }else{
                    $("#enviar").prop('disabled', false);        
              }
        }
    })
    $.validator.messages.email = 'Correo invalido, asegúrese de que esta correcto, de lo contrario deje vació el campo.';
    para_enviar={}
    function obtener_para_enviar(){
          $('input, textarea').each(function(){
                my_id=$(this).attr('id')
                if(!$(this).hasClass("sin_def")){
                      para_enviar[my_id]=$(this).val()
                }
          })
    }
    function continuar(){
        $(".error").text("")
        validado=true
        if(!$("#telef").hasClass("sin_def")){
            valor=$("#telef").val().replace(/[^0-9]+/g, "")
            if(valor.length != 10){
                $("#telef").focus()
                $("#error2").text("Proporcione su telefono a 10 dígitos o más.")
                validado=false
            }
        }
        if(!$("#email").hasClass("sin_def")){
            $("#email").addClass("email")
            if(!$("#error_form").validate().form()){
                $("#email").focus()
                validado=false
            }
        }else{
            $("#email").removeClass("email")
        }
        if(validado){
            $('body').loadingModal('show');
            obtener_para_enviar()
            $.ajax({
                  type: "POST",
                  url: 'php/email_error.php',
                  data: $.param(para_enviar),
                  timeout: 5000,
                  success: function(data) {
                        switch (data) {
                          case '1':
                              $("#exitoso").removeClass("oculto");
                              $("#preguntar").addClass("oculto");
                              $("#primero").addClass("oculto");
                              break;
                          case '2':
                              $("#preguntar").removeClass("oculto");
                              $("#primero").addClass("oculto");
                              break;
                          case '4':
                              $("#coment1").addClass("oculto")
                              $("#primero").addClass("oculto")
                              $("#preguntar").addClass("oculto")
                              $("#error6").removeClass("oculto")
                              break;
                          default:
                              $("#error3").text(data)
                              setTimeout(function(){ window.scrollTo(0,0) }, 200);
                              break;
                        }
                        $('body').loadingModal('hide');

                  },
                  error: function(){
                        $('body').loadingModal('hide');
                        toastr.options.timeOut = 5000;
                        toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
                  }
            })
        }
        return false;
    }
