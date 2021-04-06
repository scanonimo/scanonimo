    var currentDate = new Date();
    $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '&#x3c;Ant',
            nextText: 'Sig&#x3e;',
            currentText: 'Hoy',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
            'Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
            dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $("#fecha").datepicker();
    $("#fecha").datepicker( "option", "dateFormat", "yy-mm-dd" );
    $("#fecha").datepicker("setDate",currentDate);
    $("#fecha").datepicker( "option", "maxDate", currentDate);
    $.validator.messages.email = 'No es un correo valido.';
    $.validator.messages.required = 'Llene este campo.';
    $('body').loadingModal({
      text: 'Espere...',
      animation: 'threeBounce'
    });
    $(".email").on("keyup change", function() {
        email=$(this).val().replace(/ /g, '')
        $(this).val(email)
    })
    $("input").focusin(function() {
          $("#error2").addClass("oculto")
          $("#error3").text("")
          $("#error4").text("")
          $("#error5").text("")
          $("#error6").text("")
    })
    $("#ver_mas1").click(function() {
          $("#info").removeClass("oculto")
          $("#ver_mas1").addClass("oculto")
    })
    $("#ver_mas2").click(function() {
          $("#info2").removeClass("oculto")
          $("#ver_mas2").addClass("oculto")
    })
    $('body').loadingModal('hide');
    $("#nombre, #respuesta").on("keyup change", function() {
        cadena=$(this).val()
        cadena=cadena.replace(/[^a-zA-Z0-9]+/, "");
        $(this).val(cadena)  
    })
    $(document).ready(function() {
      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });
    });
    $("#boton4").click(function() {
        if(!$("#respuesta").val()) {
            $("#error5").text("Por favor conteste la pregunta.")
        }else{
            nombre_input=$("#nombre").val()
            fecha_input=$("#fecha").val()
            respuesta_input=$("#respuesta").val()
            $('body').loadingModal('show');
            $.ajax({
                  type: "POST",
                  url: 'php/recuperar_con_fecha.php',
                  data: $.param({ nombre: nombre_input, fecha: fecha_input, respuesta_env: respuesta_input }),
                  timeout: 5000,
                  success: function(data) {
                        var results = data.split(';');
                        switch (results[0]) {
                          case '1':
                              $("#error6").text("La fecha no concuerda con nuestros registros. Inténtelo con otra fecha.")
                              $("#pregunta").text(results[1])
                              $("#respuesta").val("")
                              break;
                          case '2':
                              window.location=results[1];
                              break;
                          case '3':
                              $("#error5").text("La respuesta es incorrecta intente con esta otra.")
                              $("#pregunta").text(results[1])
                              $("#respuesta").val("")
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
                              break;
                        }

                  },
                  error: function(){
                        toastr.options.timeOut = 5000;
                        toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
                  }
            })
            $('body').loadingModal('hide');
        }
    })
    $("#boton1").click(function() {
            nombre_input=$("#nombre").val()
            if(nombre_input) {
                  $('body').loadingModal('show');
                  $.ajax({
                        type: "POST",
                        url: 'php/recuperar_con_usuario.php',
                        data: $.param({ nombre: nombre_input }),
                        timeout: 5000,
                        success: function(data) {
                              var results = data.split(',');
                              switch (results[0]) {
                                case '1':
                                  $("#error3").text("El usuario proporcionado no existe. Por favor cerciórese que esta utilizando el nombre correcto de su usuario.")
                                  setTimeout(function(){ window.scrollTo(0,0) }, 200);
                                  limpiar()
                                  break;
                                case '2':
                                  $("#exito").text("Le hemos enviado un correo electrónico de recuperación a "+results[1])
                                  setTimeout(function(){ window.scrollTo(0,0) }, 200);
                                  break;
                                case '3':
                                  $("#exito").text("Le hemos enviado un correo electrónico de recuperación a "+results[1]+"\nSin embargo también es posible que recupere su accesos utilizando la fecha de creación de su cuenta siguiendo las instrucciones más abajo si así lo desea.")
                                  setTimeout(function(){ window.scrollTo(0,0) }, 200);
                                  por_fecha()
                                  break;
                                case '4':
                                  por_fecha()
                                  break;
                                case '5':
                                  $("#inicial").addClass("oculto")
                                  $("#cifrado").removeClass("oculto")                                  
                                  break;
                                case '6':
                                  $(".cifrado_fecha").removeClass("oculto")
                                  $("#cifrado").removeClass("oculto")
                                  por_fecha()
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
                                  break;
                              }
                        },
                        error: function(){
                              toastr.options.timeOut = 5000;
                              toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
                        }
                  })
            }else{
                  $("#error4").text("Proporcione un nombre primero.")
            }
            $('body').loadingModal('hide');
    })
    function por_fecha() {
        $("#inicial").addClass("oculto")
        $("#segundo").removeClass("oculto")
    }
    $("#boton5").click(function() {
          if($("#recuperar").validate().form()){
            $('body').loadingModal('show');
            email_input=$("#email2").val()
            nombre_input=$("#nombre").val()
            $.ajax({
                  type: "POST",
                  url: 'php/email_recuperar.php',
                  data: $.param({ email: email_input, nombre: nombre_input }),
                  timeout: 5000,
                  success: function(data) {
                      if(data=="1"){
                            $(".error").addClass("oculto")
                            $("#error7").removeClass("oculto")
                            setTimeout(function(){ window.scrollTo(0,0) }, 200);
                            limpiar()
                      }else{
                            if(data=="2"){
                                  $("#exito").text("Le hemos enviado un correo electrónico a la dirección proporcionada con instrucciones para restablecer su contraseña. No olvide revisar su carpeta de ‘Correo no deseado’ en caso de que tenga dificultades para encontrarlo.")
                                  $(".error").addClass("oculto")
                                  setTimeout(function(){ window.scrollTo(0,0) }, 200);
                                  limpiar()
                            }else{
                                    if(data=="3"){
                                          $(".error").addClass("oculto")
                                          $("#error8").removeClass("oculto")
                                          setTimeout(function(){ window.scrollTo(0,0) }, 200);
                                          limpiar()
                                    }else{
                                          var results = data.split('|');
                                          alert(results[0])
                                          azar=results[1]
                                          if(Number.isInteger(azar)){
                                                location.href = 'error_php.php?azar='+azar
                                          }else{
                                                location.href = 'error_php.php'
                                          }
                                    }
                            }
                      }
                  },
                  error: function(){
                        toastr.options.timeOut = 5000;
                        toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
                  }
            })   
          }
        $('body').loadingModal('hide');
    })
    function continuar() {
        if($("#recuperar").validate().form()){
            $('body').loadingModal('show');
            email_input=$("#email").val()
            $.ajax({
                  type: "POST",
                  url: 'php/email_recuperar.php',
                  data: $.param({ email: email_input }),
                  timeout: 5000,
                  success: function(data) {
                      if(data=="1"){
                            $("#error2").removeClass("oculto")
                            setTimeout(function(){ window.scrollTo(0,0) }, 200);
                            limpiar()
                      }else{
                            if(data=="2"){
                                  $("#exito").text("Le hemos enviado un correo electrónico a la dirección proporcionada con instrucciones para restablecer su contraseña. No olvide revisar su carpeta de ‘Correo no deseado’ en caso de que tenga dificultades para encontrarlo.")
                                  setTimeout(function(){ window.scrollTo(0,0) }, 200);
                                  $(".error").addClass("oculto")
                                  limpiar()
                            }else{
                                    if(data=="3"){
                                          $("#error8").removeClass("oculto")
                                          setTimeout(function(){ window.scrollTo(0,0) }, 200);
                                          limpiar()
                                    }else{
                                          var results = data.split('|');
                                          alert(results[0])
                                          azar=results[1]
                                          if(Number.isInteger(azar)){
                                                location.href = 'error_php.php?azar='+azar
                                          }else{
                                                location.href = 'error_php.php'
                                          }
                                    }
                            }
                      }
                  },
                  error: function(){
                        toastr.options.timeOut = 5000;
                        toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
                  }
            })   
        }
        $('body').loadingModal('hide');
        return false;
    }
    function limpiar() {
        $("#email2").val("")
        $("#email").val("")
        $("#nombre").val("")
    }
