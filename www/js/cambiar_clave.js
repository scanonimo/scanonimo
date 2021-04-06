    $(".contra").on("keyup change", function() {
        contar=0
        $(".contra").each(function() {
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
              url: 'php/recuperar_contra.php',
              data: $.param({ nueva: $("#nueva").val(), id: $("#id").val(), clave: $("#clave").val() }),
              timeout: 5000,
              success: function(data) {
                  if(data==1){
                        $("#exito").removeClass("oculto");
                        $("#contenido").addClass("oculto");
                  }else{
                        if(response=="Error"){
                            toastr.options.timeOut = 5000;
                            toastr["error"]("Error: Es necesario volver a iniciar sesión");
                            setTimeout(function(){ location.reload(); },2500);
                        }else{
                            var results = data.split('|');
                            alert(results[0])
                            azar=results[1]
                            if(Number.isInteger(azar)){
                                  location.href = 'error_php.php?azar='+azar
                            }else{
                                  location.href = 'error_php.php'
                            }
                            return;
                        }
                  }
              },
              error: function(){
                  $("#error4").text("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.")
                  setTimeout(function(){ window.scrollTo(0,0) }, 200);
              }
        })
        $('body').loadingModal('hide');
        return false;
    })
