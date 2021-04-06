    $('body').loadingModal({
      text: 'Espere...',
      animation: 'threeBounce'
    });
    $('body').loadingModal('hide');
		$.validator.messages.required = 'Llene este campo primero.';
      function continuar() {
          $("#error1").text('');
          if($("#pass").validate().form()){
            $('body').loadingModal('show');
            $.ajax({
                  type: "POST",
                  url: 'php/entrar_a_perfil.php',
                  data: $.param({ clave: $("#clave").val() }),
                  timeout: 5000,
                  success: function(data) {
                        switch (data) {
                          case '1':
                              $("#error1").text("La contraseña proporcionada es incorrecta. Rectifique e intente de nuevo.")
                              break;
                          case 'Error':
                              toastr.options.timeOut = 5000;
                              toastr["error"]("Error: Es necesario volver a iniciar sesión");
                              setTimeout(function(){ window.location='index.php'; },2500);
                              break;
                          case '3':
                              location.reload(true)
                              return true;
                              break;
                          default:
                              var results = data.split('|');
                              azar=results[1]
                              if(Number.isInteger(azar)){
                                    location.href = 'error_php.php?azar='+azar
                              }else{
                                    location.href = 'error_php.php'
                              }
                              break;
                        }
                        $('body').loadingModal('hide');
                  },
                  error: function(){
                        toastr.options.timeOut = 5000;
                        toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
                        $('body').loadingModal('hide');
                  }
            })
          }
          return false;
      }
