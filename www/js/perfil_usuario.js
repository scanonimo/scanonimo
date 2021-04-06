    $("#guardar2").click(function() {
        if($("#nueva").val() != $("#nueva2").val()){
            $("#error6").text("La contraseña nueva no coincide con su respectiva confirmación. Vuelva a intentarlo.");
            $("#nueva").val("")
            $("#nueva2").val("")
            $("#nueva").trigger("change")
            return false;
        }
        $('body').loadingModal('show');
        $.ajax({
              type: "POST",
              url: 'php/guardar_contra.php',
              data: $.param({ nueva: $("#nueva").val() }),
              timeout: 5000,
              success: function(data) {
                    $("label.error").text("")
                    if(data == "1"){
                          $("#error6").text("")
                          $("#error7").text("La contraseña proporcionada es incorrecta. Rectifique e intente de nuevo.")
                          $('body').loadingModal('hide');
                          return false;
                    }
                    if(data == "2"){
                          $("#exito").html("<span class='msg_exito'>La contraseña fue cambiada exitosamente.</span>")
                          desavilitar_todo();
                          setInterval(blink_text, 1000);
                          setTimeout(function(){ window.scrollTo(0,0) }, 200);
                          setTimeout(function(){ window.location='index.php'; },5000);
                    }else{
                          if(data=="Error"){
                              toastr.options.timeOut = 5000;
                              toastr["error"]("Error: Es necesario volver a iniciar sesión");
                              setTimeout(function(){ location.reload(); },2500);
                              return;
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
                    $('body').loadingModal('hide');
              },
              error: function(){
                  $("#error4").text("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.")
                  setTimeout(function(){ location.hash="#error4"; }, 200)
                  $('body').loadingModal('hide');
              }
        })
        $("#error6").text("")
        $("#error7").text("")
        return false;
    })
    $("#contra input").on("keyup change", function() {
        contar=0
        $("#contra input").each(function() {
              if($(this).val()!=""){
                  contar++
              }
        })
        if(contar == 2){
            $("#guardar2").prop("disabled",false)
        }else{
            $("#guardar2").prop("disabled",true)
        }
    })
    $('body').loadingModal({
      text: 'Espere...',
      animation: 'threeBounce'
    });
    $('body').loadingModal('hide');
    function obtener_index(elemento) {
        id=elemento[0].id;
        return id.substr(id.length - 1)
    }
    $(".ver_mas").click(function() {
        index=obtener_index($(this))
        $("#mas_info"+index).removeClass("oculto")
        $(this).addClass("oculto")
    })
    $(".ver_menos").click(function() {
        index=obtener_index($(this))
        $("#mas_info"+index).addClass("oculto")
        $("#ver_mas"+index).removeClass("oculto")
    })
    $("input[type=text]").focusin(function() {
        id=$(this)[0].id;
        if($(this).hasClass("sin_def")){
            $(this).val("")
            $(this).removeClass("sin_def")
            if(id == "email"){
                $("#borrar1").removeClass("oculto")
                $("#email2").addClass("required")
                $("#email2_div").slideDown( "slow" )
            }else{
                $("#borrar2").removeClass("oculto")
            }
        }
        if($(this).hasClass("cifrado")){
            $("#email2").addClass("required")
            $("#email2_div").slideDown( "slow" )
            $(this).val("")
            $(this).removeClass("cifrado")
            if(id == "email"){
                $("#borrar1").removeClass("oculto")
            }
        }
    })
    $("#email").focusout(function() {
          email=$("#email").val().replace(/ /g, '')
          email=email.toLowerCase();
          $("#email").val(email)
    })
    $("#cifrado").change(function() {
        if($("#cifrado").prop("checked")){
            alert("ADVERTENCIA: En el caso de que elija cifrar su información de correo electrónico, tenga en cuenta que si en algún momento pierde su contraseña para acceder, podrá recuperarla proporcionando su correo electrónico unicamente si también conoce su nombre de usuario, por lo que le recomendamos guardar esta información.")
        }else{
            if($("#email").hasClass("cifrado")){
                $("#email").focus()
            }
        }
        abilitar_guardar();
    })
    $("#email2").on("keyup change", function() {
        email=$("#email2").val().replace(/ /g, '')
        email=email.toLowerCase();
        $("#email2").val(email)
        $("#error9").text("")
    })
    $("#email").on("keyup change", function() {
        email=$("#email").val().replace(/ /g, '')
        email=email.toLowerCase();
        $("#email").val(email)
        if($("#email").val() && !$("#email").hasClass("sin_def")){
            $("#solo_este_txt").css("opacity", "1")
            $("#solo_este").prop('disabled', false)
            $("#cifrado_txt").css("opacity", "1")
            $("#cifrado").prop('disabled', false)
            $("#ver_mas2").removeClass("oculto")
            $("#ver_mas4").removeClass("oculto")
        }else{
            $("#solo_este_txt").css("opacity", "0.3")
            $("#solo_este").prop('disabled', true)
            $("#solo_este").prop( "checked", false );
            $("#cifrado_txt").css("opacity", "0.3")
            $("#cifrado").prop('disabled', true)
            $("#ver_mas2").addClass("oculto")
            $("#ver_mas4").addClass("oculto")
        }
        abilitar_guardar()
    })
//    $("#email").trigger("change")
    $("#solo_este").click(function (){
          abilitar_guardar();
    })
//     $("#grupo").focusout(function() {
//         grupo=$("#grupo").val()
//         grupo=grupo.toUpperCase()
//         $("#grupo").val(grupo)        
//     })
    $("#grupo").on("keyup change", function() {
        grupo=$(this).val()
        grupo=grupo.trimStart()
        grupo=grupo.replace(/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\,\:\¡\!\¿\?\-\.\ ]+/, "");
        $(this).val(grupo)
        abilitar_guardar()
    })
    $(".borrar").click(function() {
          index=obtener_index($(this))
          if(index == "1"){
              if(email_original){
                    if(confirm("¿Desea eliminar su correo electronico de nuestra base de datos?")){
                          $('body').loadingModal('show');
                          $.get('php/eliminar_email.php',function(resp){
                                if(resp == "1"){
                                      $("#exito").html("<span class='msg_exito'>Su correo ha sido eliminado de nuestra base de datos.</span>");
                                      desavilitar_todo();
                                      setInterval(blink_text, 1000);
                                      setTimeout(function(){ window.scrollTo(0,0) }, 200);
                                      setTimeout(function(){ window.location='index.php'; },5000);
                                      $("#email").val("(Eliminado)")
                                      $("#email").addClass("sin_def")
                                      $("#solo_este").prop( "checked", false )
                                      $("#cifrado").prop( "checked", false )
                                      $("#ver_mas2").removeClass("oculto")
                                }else{
                                      $("#error4").text("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.")
                                      setTimeout(function(){ location.hash="#error4"; }, 200)
                                }
                          }).fail(function(){
                                toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");                  
                          });
                    }
                    $('body').loadingModal('hide');
                    return false
              }else{
                    $("#email2").removeClass("required")
                    $("#email2_div").slideUp( "slow" )
                    $("#email").val("")
                    $("#email2").val("")
                    $("#error9").text("")
                    $("#email").trigger("change")
                    $("#email").val("(Opcional)")
                    $("#email").addClass("sin_def")
                    $(this).addClass('oculto')
              }
          }else{
              if(grupo_original){
                    if(confirm("¿Desea eliminar el nombre de su grupo de nuestra base de datos?")){
                          $('body').loadingModal('show');
                          $.get('php/eliminar_grupo.php',function(resp){
                                if(resp == "1"){
                                      $("#exito").html("<span class='msg_exito'>El nombre de su grupo ha sido eliminado de nuestra base de datos.</span>");
                                      desavilitar_todo();
                                      setInterval(blink_text, 1000);
                                      setTimeout(function(){ window.scrollTo(0,0) }, 200);
                                      setTimeout(function(){ window.location='index.php'; },5000);
                                      $("#grupo").val("(Eliminado)")
                                      $("#grupo").addClass("sin_def")
                                }else{
                                      $("#error4").text("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.")
                                      setTimeout(function(){ location.hash="#error4"; }, 200)
                                }
                          }).fail(function(){
                                toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");                  
                          });
                    }
                    $('body').loadingModal('hide');
                    return false
              }else{
                    $("#grupo").val("")
                    $("#grupo").trigger("change")
                    $("#grupo").val("(Opcional)")
                    $("#grupo").addClass("sin_def")
                    $(this).addClass('oculto')
              }
          }
          $("label.error").text("")
          abilitar_guardar()
    })
    function abilitar_guardar() {
        email=$("#email").val().toLowerCase()
        grupo=$("#grupo").val()
        solo_este="0"
        if($("#solo_este").prop("checked")){
            solo_este="1"
        }
        cifrado="0"
        if($("#cifrado").prop("checked")){
            cifrado="1"
        }
        abilitar=false
        if((email != "" && !$("#email").hasClass("sin_def") && !$("#email").hasClass("cifrado") && email != email_original)){
              $("#email2").addClass("required")
              $("#email2_div").slideDown( "slow" )
              abilitar=true
        }else{
              if((grupo != "" && grupo != "(Opcional)" && grupo != grupo_original) || solo_este != solo_este_original || cifrado != cifrado_original){
                    abilitar=true
              }
        }
        if(abilitar){
              $("#guardar1").prop('disabled', false)
        }else{
              if($("#email").val() != ""){
                    $("#email2").removeClass("required")
                    $("#email2_div").slideUp( "slow" )
              }
              $("#guardar1").prop('disabled', true)
        }
    }
		$.validator.messages.required = 'Llene este campo, de click en borrar o cancele para iniciar de nuevo.';
		$.validator.messages.email = 'Correo invalido, rectifique.';
    function blink_text() {
        $('.msg_exito').fadeOut(500);
        $('.msg_exito').fadeIn(500);
    }
    function continuar() {
        solo_este=0
        if($("#solo_este").prop("checked")){
            solo_este=1
        }
        cifrado=0
        if($("#cifrado").prop("checked")){
            cifrado=1
        }
        email_input=$("#email").val();
        $("#email").addClass("email")
        if($("#email").hasClass('sin_def') || $("#email").hasClass('cifrado')){
            email_input="";
            $("#email").removeClass("email")
        }
        validado=true
        if($("#email").val() != $("#email2").val() && $("#email2").val() != ""){
            $("#email2").focus()
            $('html,body').animate({scrollTop: $("#info").offset().top },'slow');
            $("#error9").text("Los correos escritos deben ser iguales. Revise por favor.")
            validado=false
        }
/*
        if(!$("#clave").val()){
            $("#error5").text("Proporcione su contraseña actual para guardar.")
            validado=false
        }
*/
        if($("#info").validate().form() && validado){
            grupo_input=$("#grupo").val();
            if($("#grupo").hasClass('sin_def')){
                grupo_input="";
            }
            $('body').loadingModal('show');
            $.ajax({
                  type: "POST",
                  url: 'php/guardar_perfil.php',
                  data: $.param({ email: email_input, grupo: grupo_input, solo_este: solo_este, cifrado: cifrado }),
                  timeout: 5000,
                  success: function(data) {
                        $("label.error").text("")
                        if(data == "3"){
                              $("#error4").text("El correo electronico proporcionado ya ha sido usado en otro usuario. Por favor utilice un correo electronico diferente.")
                              $("#email").val("");
                              $('body').loadingModal('hide');
                              setTimeout(function(){ location.hash="#error4"; }, 200)
                              setTimeout(function(){ $("#email").focus(); }, 400)
                              return false;
                        }
                        if(data == "2"){
                              $("#error5").text("La contraseña proporcionada es incorrecta. Rectifique e intente de nuevo.")
                              $('body').loadingModal('hide');
                              return false;
                        }
                        if(data == "1"){
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
                              $('body').loadingModal('hide');
                              return false;
                        }
                        if(data == "4"){
                              $("#exito").html("<span class='msg_exito'>Los cambios se han guardado con éxito.</span>")
                              desavilitar_todo();
                              setInterval(blink_text, 1000);
                              setTimeout(function(){ window.scrollTo(0,0) }, 200);
                              setTimeout(function(){ window.location='index.php'; },5000);
                        }else{
                              if(data=="Error"){
                                  toastr.options.timeOut = 5000;
                                  toastr["error"]("Error: Es necesario volver a iniciar sesión");
                                  setTimeout(function(){ location.reload(); },2500);
                                  return false;
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
                  },
                  error: function(){
                        toastr.options.timeOut = 5000;
                        toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
                  }
            })              
        }else{
            if($('label.error:first:visible').length){
                	$('html,body').animate({scrollTop: $('label.error:first:visible').offset().top - 150},'slow');
            }
        }
        $('body').loadingModal('hide');
        return false;
    }
    function desavilitar_todo() {
        $(".error").text("")
        $(".borrar").addClass("oculto")
        $("input").prop('disabled', true);
        $("button").prop('disabled', true);
        $("#solo_este_txt").css("opacity", "0.3");
        $("#cifrado_txt").css("opacity", "0.3");
    }
