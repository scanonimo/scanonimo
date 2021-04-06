function contenido(guardar=0){
	loading="<div id='loading'><img src='images/loading.gif'></div>";
	$('#contenido').html(loading);
	ordenar=$("#ordenar").val();
	filtrar=$("#filtrar").val();
  eliminar_obs=$("#eliminar_obs").val();
	error="<div class='error'>Error de conexión. Compruebe su conexión a internet y refresque su navegador para intentarlo de nuevo.</div>";
  $.ajax({
		type: "POST",
		url: "php/contenido_barras.php",
		data: {ordenar_env: ordenar, filtrar_env: filtrar, guardar_env: guardar, eliminar_obs_env: eliminar_obs, ocultar_obs_env: obs_oculto },
		timeout: 5000,
    		success: function( data ) {
	          $('#contenido').html(data);
	          retraer();
    		},
      	error: function() {
	          $('#contenido').html(error);
            $( "#header" ).trigger( "click" );
    		}
	});
}
