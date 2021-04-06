function contenido(guardar){
  guardar = (typeof guardar !== 'undefined') ?  guardar : 0
	loading="<div id='loading'><img src='images/loading.gif'></div>";
	$('#contenido').html(loading);
	ordenar=$("#ordenar").val();
	ordenar_dos=$("#ordenar_dos").val();
	filtrar=$("#filtrar").val();
	fun_avan=$("#fun_avan").val();
  eliminar_obs=$("#eliminar_obs").val();
	error="<div class='error'>Error de conexión. Compruebe su conexión a internet y refresque su navegador para intentarlo de nuevo.</div>";
  $.ajax({
		type: "POST",
		url: "php/contenido.php",
		data: { ordenar_dos_env: ordenar_dos, ordenar_env: ordenar, filtrar_env: filtrar, guardar_env: guardar, eliminar_obs_env: eliminar_obs, ocultar_obs_env: obs_oculto, fun_avan_env: fun_avan },
		timeout: 5000,
        success: function(data){
	          $('#contenido').html(data);
    		},
      	error: function() {
	          $('#contenido').html(error);
            $( "#header" ).trigger( "click" );
    		}
	});
}
