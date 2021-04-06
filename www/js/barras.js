$('.barras_guardar').click(function(){
    sacar_valores($(this))
    barras=$('#barras_'+numero).val()
    $.ajax({
      type: "POST",
      url: "php/guardar_barras.php",
      data: $.param({ barras_env: barras, id_env: numero }),
      timeout: 5000,
      		success: function( response ) {
              if(response=="Error"){
                  toastr.options.timeOut = 5000;
                  toastr["error"]("Error: Es necesario volver a iniciar sesión");
                  setTimeout(function(){ location.reload(); },2500);
                  return;
              }
              toastr["success"](response);
      		},
          error: function(){
            toastr.options.timeOut = 5000;
            toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
          }
    });
})
