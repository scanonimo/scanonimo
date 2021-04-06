$('#act, #desact, #act_obs, #desact_obs, #pasar_regalo, #cerrar, .ordenar, .ordenar_dos, .filtrar, #pasar_a_efectivo, #cambiar_dinero,#act_fun, #desact_fun').unbind()
var se_esta_presionado = "no";
var presionando = new Array();
var timer_guardar = new Array();
var tocado = new Object();
var datos_para_undo = new Object();
var tocado_volteado = new Object();
var gran_total_importe_val;
var nombre="";
var numero
var number_two
var numero_esp
var donativo_antes
var numero_esp2
var ya_no_lo_hagas=false
var esperame=false
regalo=$("#regalo");
pasar_regalo=$('#pasar_regalo')
boton_guardar=$('#guardar');
//regalo_id=$("#regalo_id");
//gran_total_id=$("#gran_total_id");
gran_total=$("#gran_total");
fondo_total=$("#fondo_total")
//cambiar_regalo=cambiar_regalo;
cambiar_dinero=$("#cambiar_dinero");
cambiar_regalo=$("#cambiar_regalo");
gran_total_importe=$("#gran_total_importe");
gran_total_piezas=$("#gran_total_piezas");
dinero=$("#dinero");
$('body').loadingModal({
  text: 'Espere...',
  animation: 'threeBounce'
});
$('body').loadingModal('hide');
function retraer(){
  setTimeout(function(){ esperame=false; },1000);
  if(!esperame) {
    	$( "#header" ).trigger( "click" );
      esperame=true;
  }
}
var countDecimals = function(value) {
      if (value.indexOf('.') != -1)
        return value.toString().split(".")[1].length || 0;
      return 0;
}
function desaparecer(elemento){
    obtener_numero(elemento);
    $("#mas"+numero_esp).removeClass("mas");
    $("#menos"+numero_esp).removeClass("menos");
    checame=number_two
    elemento.fadeOut(1000, function() { 
        $(this).remove();
        if(parseFloat(checame) > 2 && checame != ""){
            if(!$('.piezas_obs').length){
                $('#letra_obs').addClass("oculto")
                $('#totales_regalo').addClass("oculto")
                $('#nav_obs').addClass("oculto")
            }
        }
    });
}
$("#mostrar_button").click(function() {
  	$('.sin_exist .piezas_per').each(function(){
          obtener_numero($(this))
          $("#row"+numero_esp).removeClass("oculto")
    })
    $("#mostrar").addClass("oculto")
})
//$(document).ready(function(){
  var no_regreses
  function guardar_per(datos_para_enviar) {
      $('body').loadingModal('show');
      $.ajax({
          type: "POST",
          url: "php/guardar_per.php",
          data: $.param(datos_para_enviar),
          timeout: 5000,
          success: function(response){
            if(response=="Error"){
	              toastr.options.timeOut = 5000;
	              toastr["error"]("Error: Es necesario volver a iniciar sesión");
	              setTimeout(function(){ location.reload(); },2500);
                $('body').loadingModal('hide');
	              return;
            }else{
                $("#undo_button").prop('disabled', true);
                $('#eliminar_obs').val('1')
                $('.eliminame').remove()
                if(response=="NO MAS"){
                      alert("El limite de libros personalizados que se puede crear por usuario a sido alcanzado.\n\nCada Usuario solo puede crear hasta un máximo de 10 libros personalizados, por lo que usted ya no puede crear más libros.\n\nLe sugerimos borre alguno que ya no necesite para crear otro.")
                      sucess_per(1)
                      $('body').loadingModal('hide');
                      return;
                }
//                empty_undo()
                var results = response.split('|');
                if(results[0]=="1"){
                      if("eliminar_env" in datos_para_enviar) {
                              mensaje = "Libro eliminado exitosamente.";
                          numero_esp_guardado=numero_esp
                          sucess_per()
                          $("#textarea"+numero_esp_guardado).prop('disabled', true);
                          $("#mas"+numero_esp_guardado).prop('disabled', true);
                          $("#menos"+numero_esp_guardado).prop('disabled', true);
                          desaparecer($("#row"+numero_esp_guardado))
                      }else{
                          if("id_env" in datos_para_enviar) {
                              id_env=datos_para_enviar["id_env"]
                              if($("#nombre4_"+id_env).length) {
                                  nombre=datos_para_enviar["nombre"].toUpperCase()
                                  $("#nombre4_"+id_env).text(nombre)
                              }
                              no_regreses=1
                                  mensaje = "Libro editado exitosamente.";
                              sucess_per()
                              no_regreses=0
                          }else{
                                  mensaje = "Libro creado exitosamente.";
                              sucess_new(results[1],nombre_per,donativo_per)
                          }
                      }
                }else{
                      alert(results[0])
                      azar=results[1]
                      if(Number.isInteger(azar)){
                            location.href = 'error_php.php?azar='+azar
                      }else{
                            location.href = 'error_php.php'
                      }
                      $('body').loadingModal('hide');
                      return;
                }
                $('body').loadingModal('hide');
            }
        },
        error: function(){
          toastr.options.timeOut = 5000;
          toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
          $('body').loadingModal('hide');
        }
      });
  }
/*
  function undo_function() {
      undo_id=$("#undo_id").val()
      elemento=$("#"+undo_id)
	    sacar_valores(elemento)
      undo_value=$("#undo_value").val()
      undo_total=$("#undo_total").val()
      undo_regalo=$("#undo_regalo").val()
      valores_generales()
      datos_para_enviar = { }
      if(undo_total != gran_total_text){
			    if(gran_total_text!="SIN DEFINIR"){
              gran_total_val_env=regresar_val(undo_total)
              Object.assign(datos_para_enviar, { gran_total_env: gran_total_val_env, gran_total_id_env: gran_total_id_text });
			    }else{
						  datos_para_enviar["eliminar_env"]=gran_total_id_text;
          }
      }
      if(undo_regalo != regalo_text){
          cambiar_regalo_val=regresar_val(undo_regalo)
          Object.assign(datos_para_enviar, { regalo_env: cambiar_regalo_val, regalo_id_env: regalo_id_text });
      }
		  if(!(numero_esp in tocado)){
			  tocado[numero_esp]=piezas_val;
		  }
  		registro_val=""

		  if((numero_esp in registro)){
			  registro_val=registro[numero_esp];
		  }

      piezas_val=undo_value
    	piezas.val(piezas_val);
  		Object.assign(datos_para_enviar, { id_env: numero, piezas_env: piezas_val, registro_env: registro_val, number_two_env: number_two })
			guardar_valores(datos_para_enviar,1,elemento,1);
  }
*/
  function preferencias(datos_para_enviar) {
      $.ajax({
          type: "POST",
          url: "php/guardar_preferencia.php",
          data: $.param(datos_para_enviar),
          timeout: 5000,
          success: function(response){
	            if(response=="Error"){
		              toastr.options.timeOut = 5000;
		              toastr["error"]("Error: Es necesario volver a iniciar sesión");
		              setTimeout(function(){ location.reload(); },2500);
		              return;
	            }
                if(response!="1"){
                      var results = response.split('|');
                      alert(results[0])
                      azar=results[1]
                      if(Number.isInteger(azar)){
                            location.href = 'error_php.php?azar='+azar
                      }else{
                            location.href = 'error_php.php'
                      }
                      return;
                }
              retraer()
          }
      });
  }
  $('#act').click(function() {
      pulso="1"
      $('#act').css("display", "none")
      $('#desact').css("display", "")
      datos_para_enviar = { pulso_env: pulso }
      preferencias(datos_para_enviar)
  });
  $('#desact').click(function() {
      pulso="0"
      $('#act').css("display", "")
      $('#desact').css("display", "none")
      datos_para_enviar = { pulso_env: pulso }
      preferencias(datos_para_enviar)
  });
  $('#act_fun').click(function() {
      $(".oculto4").removeClass("oculto4")
      fun_avan="1"
      $("#fun_avan").val(fun_avan)
      $('#act_fun').css("display", "none")
      $('#desact_fun').css("display", "")
      datos_para_enviar = { fun_avan: fun_avan }
      preferencias(datos_para_enviar)
  });
  $('#desact_fun').click(function() {
      if($('#total_piezas_per').length) {
            total_piezas=$('#total_piezas_per').text()
      }else{
        		total_piezas=0;
            $('.piezas_per').each(function(){
		              sacar_valores($(this));
		              total_piezas=total_piezas+piezas_val;
            });
      }
      if(total_piezas != "0"){
          alert("ADVERTENCIA: Existe una o más piezas personalizadas que tienen existencias. Para desactivar las funciones avanzadas es necesario tener todas las piezas personalizadas en 0.")
          return
      }
      if($('.piezas_obs').length) {
          alert("ADVERTENCIA: Existe una o más piezas en obsequio. Para desactivar las funciones avanzadas, es necesario no tener piezas obsequiadas. Le sugerimos enviar los obsequios a dinero utilizando el botón correspondiente para poder desactivar las funciones avanzadas.")
          return
      }
      $("#undo_button").prop('disabled', true);
      fun_avan="0"
      $('#nav_per, #letra_per, #mostrar, #row2_new, #totales_tipo_per, #reg_obs, #act, #desact, #act_obs, #desact_obs, .ocultame').addClass("oculto4")
      $('.piezas_per').each(function(){
            obtener_numero($(this))
            $("#row"+numero_esp).addClass("oculto4")
      });
      $('#act_fun').css("display", "")
      $('#desact_fun').css("display", "none")
      datos_para_enviar = { fun_avan: fun_avan }
      preferencias(datos_para_enviar)
  });
  $('#act_obs').click(function() {
      obs_oculto="0"
      $('#act_obs').css("display", "none")
      $('#desact_obs').css("display", "")
      datos_para_enviar = { ocultar_obs_env: obs_oculto }
      preferencias(datos_para_enviar)
      $('.oculto2').removeClass('oculto2')
  });
  $('#desact_obs').click(function() {
      obs_oculto="1"
      $('#act_obs').css("display", "")
      $('#desact_obs').css("display", "none")
      datos_para_enviar = { ocultar_obs_env: obs_oculto }
      preferencias(datos_para_enviar)
      $('.piezas_obs').each(function(){
	          sacar_valores($(this));
            $('#row'+numero_esp).addClass('oculto2')
      })
      $('#totales_regalo, #nav_obs, #letra_obs').addClass('oculto2')
  });
  function salio(objeto1) {
      redibujar()
    	if((numero_esp in tocado)){
          toastr["error"]("Parece que tu dedo resbalo fuera del botón. Inténtelo de nuevo.")
      }
      regresar()
      se_esta_presionado="no"
      clearTimeout(timer_guardar[numero_esp]);
      clearTimeout(presionando[numero_esp]);
      objeto1.off("mouseleave touchmove");
  }
var cancelame = ""
function cancelame_fun() {
    if(cancelame){
        $("#cancelar"+cancelame).trigger('click')
    }
}
  function asignar_mas_menos() {
      $('.mas, .menos').unbind()
      $('.mas, .menos').bind("touchstart mousedown", function (e) {
        cancelame_fun()
        var attr = $(this).attr('disabled');
        if (typeof attr !== typeof undefined && attr !== false) {
            return;
        }
        if(se_esta_presionado=="no"){
          sacar_valores($(this));
          clearTimeout(timer_guardar[numero_esp]);
          se_esta_presionado=numero_esp;
          if(pulso == "0" && fun_avan == "1" && !(parseFloat(number_two) > 2 && number_two != "" && clase == "mas")){ presionando[numero_esp]=setTimeout(function(){ se_solto(objeto,1); }, 500); }
          $(this).bind("mouseleave touchmove", function(e) { salio($(this)); });
        }
      });
      $('.mas, .menos').click(function (e) { se_solto($(this),0); });
  }
  asignar_mas_menos()
  function sucess_new(id_return,nombre_per,donativo_per){
      $('#row2_new').before("          <tr id='row2_"+id_return+"' class='sin_exist'>\
            <td id='nombre2_"+id_return+"'><textarea id='textarea2_"+id_return+"' class='textarea_per' rows='1' style='overflow: hidden; overflow-wrap: break-word; height: 21px;'>"+nombre_per+"</textarea></td>\
            <td id='tipo2_"+id_return+"'>PERSONALIZADO</td>\
            <td id='donativo2_"+id_return+"'>"+regresar_texto(parseFloat(donativo_per))+"</td>\
            <td class='centrado' id='mas_menos2_"+id_return+"'><input id='guardar2_"+id_return+"' class='guardar' value='Guardar' type='button' style='display:none;' disabled=''><input id='cancelar2_"+id_return+"' class='cancelar' value='Cancelar' type='button' style='display:none;'><span id='mas_menos_span_"+id_return+"'><input class='menos' id='menos2_"+id_return+"' value='-' type='button' disabled><input id='piezas2_"+id_return+"' class='piezas piezas_per' value='0' disabled=''><input class='mas' id='mas2_"+id_return+"' value='+' type='button'></span></td>\
            <td><input id='eliminar2_"+id_return+"' class='eliminar' value='Eliminar' type='button' style='display:none;'><span id='importe2_"+id_return+"'>$0.00</span></td>\
          </tr>")
      if($('#ordenar').val() == '1'){ asignar_per() };
      sucess_per()
      asignar_mas_menos()
      asignar_acciones()
  }
  function sucess_per(saltatelo) {
      saltatelo = (typeof saltatelo !== 'undefined') ?  saltatelo : 0
      $("#cancelar"+numero_esp).click()
      $(".blink").css("display", "")
      autosize($('textarea'));
      toastr.options.timeOut = 5000;
      if(!saltatelo){ toastr["success"](mensaje); }
  }
  function asignar_acciones(){
      $('.textarea_per, .donativo_per, .eliminar').unbind()
      $(".eliminar").click(function() {
	        obtener_numero($(this));
          nombre_per=$("#textarea"+numero_esp).val()
          piezas_per=$('#piezas2_'+numero).val()
          if(piezas_per == "0"){
              if($("#row"+numero_esp2).length && !($("#row"+numero_esp2).hasClass('eliminame'))){
                    alert("Este libro también se encuentra presente la lista de libros obsequiados. Para poder eliminarlo, deberás limpiar la lista de obsequios primero y entonces podras eliminarlo.")
                    animacion($("#row"+numero_esp2),"red")
                    setTimeout(function() { location.hash="#letra_obs"; }, 100);
                    $("#cancelar"+numero_esp).click()
              }else{
					        if(confirm("¿Seguro que quieres eliminar tu libro personalizado ("+nombre_per+")?")){
                  		datos_para_enviar = { eliminar_env: numero };
                      guardar_per(datos_para_enviar)
                  }
              }
          }else{
              alert("Antes de eliminar, es necesario dejar el numero de piezas en existencia en cero.")
              animacion($("#mas_menos2_"+numero),"red");
              $("#cancelar"+numero_esp).click()
          }
      })
      var donativo_original
      var nombre_original
      $('.textarea_per, .donativo_per').focusin(function() {
	        obtener_numero($(this));
          if(cancelame != "" && cancelame != numero_esp){
                $("#cancelar"+cancelame).trigger('click')
                obtener_numero($(this));
          }
          cancelame=numero_esp
          if(! nombre_original){
              $(".blink").css("display", "none")
//              $('.textarea_per, .donativo_per').prop('disabled', true);
              if(numero!="new"){
                    nombre_original=$("#textarea"+numero_esp).val()
    //              donativo_original=$('#donativo2_'+numero).val()
                  $("#mas_menos_span_"+numero).css("display", "none")
              }//else{
    //              donativo_antes=$('#donativo2_new').val()
//                  $('#donativo2_new').prop('disabled', false);
//              }
    //          nombre_antes=$("#textarea"+numero_esp).val()
//              $("#textarea"+numero_esp).prop('disabled', false);
//          		desactiva_todo()
              $("#guardar"+numero_esp).css("display","")
              $("#cancelar"+numero_esp).css("display","")
              $("#eliminar"+numero_esp).css("display","")
              $("#importe2_"+numero).css("display","none")
              $(this).trigger("change")
          }
      })
      $('.textarea_per, .donativo_per').on("keyup change", function() {
			    obtener_numero($(this));
          if(numero=="new"){ 
              donativo_per=$.trim($('#donativo2_'+numero).val())
              if(texto=="donativo2_new"){
                  donativo_per=solo_numeros($(this))
                  if(donativo_per!="" && $.isNumeric(donativo_per)) {
                      if(!(donativo_per<10000) && ! (ya_no_lo_hagas)){
                          toastr.options.timeOut = 5000;
                          toastr["warning"]("Las piezas personalizadas solo pueden tener un monto menor a los $ 10,000.00 por pieza.")
                          ya_no_lo_hagas=true
                      }
                  }
              }
          }
//          donativo_antes=donativo_per
          nombre_per=$("#textarea"+numero_esp).val()
          if(nombre=="textarea2_"){
/*
              if(/[^a-zA-Zá-úÁ-Ú0-9\(\)\,\:\¡\!\¿\?\-\.\ ]+/.test(nombre_per)){
                  $("#textarea"+numero_esp).val(nombre_antes)
                  return
              }
*/
              nombre_per=nombre_per.trimStart()
              nombre_per=nombre_per.replace(/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\,\:\¡\!\¿\?\-\.\ ]+/g, "");
              nombre_per=nombre_per.substring(0, 200)
              $("#textarea"+numero_esp).val(nombre_per)
              
          }
//          nombre_antes=nombre_per
          nombre_per=$.trim(nombre_per)
//          if(nombre_per!="" && donativo_per!="" && $.isNumeric(donativo_per) && (donativo_per!=donativo_original || nombre_per!=nombre_original)){
          desact=1
//          alert(nombre_per+" uno"+nombre_original)
          if(nombre_per!="" && nombre_per!=nombre_original){
              if(numero!="new"){
          				$("#guardar"+numero_esp).prop('disabled', false);
                  $("#eliminar"+numero_esp).prop('disabled', true);
                  desact=0
              }else{
                  if(donativo_per!="" && $.isNumeric(donativo_per)) {
                      if(donativo_per<10000){
                  				$("#guardar"+numero_esp).prop('disabled', false);
                          desact=0
                      }
                  }
              }
          }
          if(desact) {
      				$("#guardar"+numero_esp).prop('disabled', true);
              if(numero!="new"){
                  $("#eliminar"+numero_esp).prop('disabled', false);
              }
          }
      })
      $(".cancelar").unbind()
      $(".cancelar").click(function() {
          cancelame=""
			    obtener_numero($(this));
          $(".blink").css("display", "")
          if(numero=="new"){
              $('#textarea2_new').val("")
              $('#donativo2_new').val("")
          }else{
              if(!no_regreses){
                    $("#textarea"+numero_esp).val(nombre_original)
//                    $('#donativo2_'+numero).val(donativo_original)
              }
              $("#mas_menos_span_"+numero).css("display", "")
          }
          autosize.update($("#textarea"+numero_esp))
          $('.textarea_per, .donativo_per').prop('disabled', false);
          $("#guardar"+numero_esp).css("display","none")
          $("#cancelar"+numero_esp).css("display","none")
          $("#eliminar"+numero_esp).css("display","none")
          $("#importe2_"+numero).css("display","")
  				$("#guardar"+numero_esp).prop('disabled', true);
          nombre_original=""
//          activar_todos()
      })
      $(".guardar").unbind()
      $(".guardar").click(function() {
			    obtener_numero($(this));
          if(numero=="new"){
          		datos_para_enviar = { nombre: nombre_per, donativo: donativo_per };
          }else{
          		datos_para_enviar = { id_env: numero, nombre: nombre_per };
          }
          guardar_per(datos_para_enviar)
      })
  }
  asignar_acciones()
/*
  function empty_undo() {
      $("#undo_id").val("")
      $("#undo_value").val("")
      $("#undo_total").val("")
      $("#undo_regalo").val("")
      $("#undo_button").prop('disabled', true);
  }
*/
//})
function se_solto(elemento,mantuvo_presionado){
  elemento.off("mouseleave touchmove");
	sacar_valores(elemento);
	if((mantuvo_presionado) && (numero_esp in tocado)){ 
      if(tocado[numero_esp]!=piezas_val){
          redibujar()
          toastr["error"]("Un pulsado largo no puede ir despues de un pulso corto.")
          regresar()
          se_esta_presionado="no"
          return;
      }
  }
	if(se_esta_presionado==numero_esp){
		if(!(numero_esp in tocado) && !(mantuvo_presionado)){
			tocado[numero_esp]=piezas_val;
		}
    if(parseFloat(number_two) > 2 && number_two != ""){
          objeto_voltear=$("#piezas"+numero_esp2)
          volteado=parseFloat(objeto_voltear.val())
      		if(!(numero_esp in tocado_volteado) && !(mantuvo_presionado)){
              tocado_volteado[numero_esp]=volteado;
          }
    }
		var agregar_valores = {};
		if(clase=='mas'){
			piezas_val=piezas_val+1;
      a_sumar=-1
    	gran_total_val_env=0;
			if(gran_total_text!="SIN DEFINIR"){
				gran_total_val_env=gran_total_val+donativo_val;
				agregar_valores = { gran_total_env: gran_total_val_env };
			}
		}else{
			piezas_val=piezas_val-1;
      a_sumar=1
      if($("#piezas"+numero_esp2).length){
            obsequiado_val=parseFloat($("#piezas"+numero_esp2).val())+1
      }else{
    			  obsequiado_val=1
      }
      agregar_valores = { regalo_env: obsequiado_val };
		}
		registro_val=""
		if((numero in registro) && (number_two == "" || number_two == "3")){
			registro_val=registro[numero];
		}
		datos_para_enviar = { id_env: numero, piezas_env: piezas_val, registro_env: registro_val, number_two_env: number_two };
		se_esta_presionado = "no";
		if(!mantuvo_presionado){
      if(parseFloat(number_two) > 2 && number_two != ""){
            regalo_val=piezas_val
            volteado=volteado+a_sumar
            piezas_val=volteado
            datos_para_enviar = { id_env: numero, piezas_env: piezas_val, registro_env: registro_val, number_two_env: number_two, regalo_env: regalo_val };
      }
      if(number_two == "" && piezas_val == 0 && registro_val != "" && !mantuvo_presionado){
          eliminar_reg=1
          if($("#piezas3_"+numero).length){
              if($("#piezas3_"+numero).val() != "0"){
                  eliminar_reg=0
              }
          }
          if(eliminar_reg){
              datos_para_enviar["eliminar_reg"]=1
          }
      }
			clearTimeout(presionando[numero_esp]);
			if(gran_total_text!="SIN DEFINIR" && clase=='mas' && (parseFloat(number_two) < 3 || number_two == "")){
				if(dinero_val<donativo_val){
					if(confirm("No hay suficientes efectivo para comprar ese libro. ¿Desea reiniciar el fondo de efectivo pasando dicho fondo al estado de sin definir? Esto le permitirá agregar y quitar literatura sin efectivo y deberá especificar un fondo de efectivo posteriormente, de lo contrario, pulse cancelar y el libro no sera agregado.\n\nNota: Si desea agregar un libro sin utilizar el fondo de efectivo, presione y mantenga presionado el botón \"+.\", lo cual aumentara el Fondo Total.")){
						datos_para_enviar["eliminar_total"]="1";
						guardar_valores(datos_para_enviar,1,elemento);
						return;
					}else{
						regresar()
						return;
					}
				}
			}
			timer_guardar[numero_esp]=setTimeout(guardar_valores.bind(null,datos_para_enviar,mantuvo_presionado,elemento,clase), 500);
      if(parseFloat(number_two) > 2 && number_two != ""){
          sacar_valores(objeto_voltear);
          piezas_val=volteado
    			sacar_importe(1);
        	sacar_valores(elemento);          
          piezas_val=regalo_val
      }
			sacar_importe();
		}else{
      if(parseFloat(number_two) > 2 && number_two != ""){
          regalo_val=piezas_val
          piezas_val=volteado
          datos_para_enviar = { id_env: numero, piezas_env: piezas_val, registro_env: registro_val, number_two_env: number_two, regalo_env: regalo_val };
          if(regalo_val == "0" && piezas_val == "0"){
              datos_para_enviar["eliminar_reg"]=1
          }
      }else{
    	    for (var key in agregar_valores) { datos_para_enviar[key] = agregar_valores[key]; };
      }
	    guardar_valores(datos_para_enviar,mantuvo_presionado,elemento);
			redibujar();
		}
	}
}
var tipo_de_undo=0
$('#undo_button').unbind()
$('#undo_button').click(function() {
    if(! confirm("¿Desea deshacer la ultima acción realizada?")){
        retraer()
        toastr.options.timeOut = 5000;	              
        toastr["warning"]("No se realizo ningún cambio.");
        return
    }
    if(tipo_de_undo==0){
		    if("id_env" in datos_para_undo){
            numero_undo=datos_para_undo["id_env"]
            number_two_undo=datos_para_undo["number_two_env"]
            regalo_undo=datos_para_undo["regalo_env"]
            if(number_two_undo == "2" || number_two_undo == "4"){
                if(regalo_undo == "0"){
                    if($("#row4_"+numero_undo).length){
                        datos_para_undo["number_two_env"]="4"
                    }else{
                        datos_para_undo["number_two_env"]="2"
                        delete datos_para_undo["regalo_env"];
                    }
                }else{
                    datos_para_undo["number_two_env"]="2"
                }
            }else{
                if(regalo_undo == "0"){
                    if($("#row3_"+numero_undo).length){
                        datos_para_undo["number_two_env"]="3"
                    }else{
                        datos_para_undo["number_two_env"]=""
                        delete datos_para_undo["regalo_env"];
                    }
                }else{
//                    alert($("#piezas3_"+numero_undo).val()+", "+regalo_undo)
                    if($("#piezas3_"+numero_undo).val() != regalo_undo){
                          datos_para_undo["number_two_env"]=""
                    }else{
                        datos_para_undo["number_two_env"]=""
                        delete datos_para_undo["regalo_env"];
                    }
                }
            }
        }
        guardar_valores(datos_para_undo,1,"","",true);
    }else{
        desactiva_todo()
        $.ajax({
            type: "POST",
            url: "php/desmarcar.php",
            timeout: 5000,
            success: function(response){
                if(response=="Error"){
                    toastr.options.timeOut = 5000;
                    toastr["error"]("Error: Es necesario volver a iniciar sesión");
                    setTimeout(function(){ location.reload(); },2500);
                    return;
                }
                if(response=="1"){
                      $('#eliminar_obs').val('0')
                      $('.obs_eliminado').addClass('piezas_obs')
                      $('.obs_eliminado').removeClass('obs_eliminado')
                      $(".eliminame").removeClass('oculto');
                      $(".eliminame").removeClass('eliminame');
                      $('#totales_regalo, #nav_obs, #letra_obs').removeClass('oculto');
                      if($('#totales_regalo').length){
                            asignar_obs()
                            $( ".piezas_obs" ).first().trigger("change")
                      }
                      activar_todos();
                      funcion_gran_total();
                      toastr["success"]("Se revertió la ultima accion con éxito.");
                      retraer()
                }else{
                      var results = response.split('|');
                      alert(results[0])
                      azar=results[1]
                      if(Number.isInteger(azar)){
                            location.href = 'error_php.php?azar='+azar
                      }else{
                            location.href = 'error_php.php'
                      }
                      return;
                }
            },
            error: function(){
                activar_todos();
                toastr.options.timeOut = 5000;
                toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
            }
        })
    }
    $("#undo_button").prop('disabled', true);
});
function valores_undo(datos_para_enviar_env){
    datos_para_undo = { }
    if("eliminar_total" in datos_para_enviar_env || "gran_total_env" in datos_para_enviar_env){
        valores_generales()
        if(gran_total_text!="SIN DEFINIR"){
              datos_para_undo['gran_total_env']=gran_total_val
        }else{
              datos_para_undo['eliminar_total']="1"
        }
    }
		if(("id_env" in datos_para_enviar_env)){
		    registro_val_undo=""
		    if((numero in registro) && (number_two == "" || number_two == "3")){
			    registro_val_undo=registro[numero];
		    }
        datos_para_undo["registro_env"]=registro_val_undo
        agregar_datos_para_undo={ id_env: numero, number_two_env: number_two }
        for (var key in agregar_datos_para_undo) { datos_para_undo[key] = agregar_datos_para_undo[key]; };
        if((numero_esp in tocado)){
            if(parseFloat(number_two) > 2 && number_two != ""){
                  regalo_undo=tocado[numero_esp]
                  if((numero_esp in tocado_volteado)){
                        piezas_val_undo=tocado_volteado[numero_esp]
                  }else{
                        piezas_val_undo=$('#pieza'+numero_esp2).val()
                  }
            }else{
                  piezas_val_undo=tocado[numero_esp]
                  if((numero_esp in tocado_volteado)){
                        regalo_undo=tocado_volteado[numero_esp]
                  }else{
                        regalo_undo="0"
                  }
            }
        }else{
            if(parseFloat(number_two) > 2 && number_two != ""){
                piezas_val_undo=$("#piezas"+numero_esp2).val()
                regalo_undo=$("#piezas"+numero_esp).val()
            }else{
                piezas_val_undo=$("#piezas"+numero_esp).val()
                if($("#piezas"+numero_esp2).length){
                    regalo_undo=$("#piezas"+numero_esp2).val()
                }else{
                    regalo_undo="0"
                }
            }
        }
        datos_para_undo['regalo_env']=regalo_undo
        datos_para_undo['piezas_env']=piezas_val_undo
        if(regalo_undo=="0" && piezas_val_undo=="0"){
              datos_para_undo["eliminar_reg"]=1
        }
    }
    $("#undo_button").prop('disabled', false);
}
var guardar_valores = function(datos_para_enviar,mantuvo_presionado,obj_env,clase_env,undo_now){
  clase_env = (typeof clase_env !== 'undefined') ?  clase_env : "mas"
  undo_now = (typeof undo_now !== 'undefined') ?  undo_now : false
	if(!mantuvo_presionado){
		sacar_valores(obj_env);
		mas.prop('disabled', true);
		menos.prop('disabled', true);
	}else{
    desactiva_todo()
	}
  datos_para_enviar["eliminar_obs"]=$('#eliminar_obs').val()
	$.ajax({
		type: "POST",
		url: "php/guardar.php",
		data: $.param(datos_para_enviar),
		timeout: 5000,
		success: function(response){
      if(response=="Error"){
          toastr.options.timeOut = 5000;
          toastr["error"]("Error: Es necesario volver a iniciar sesión");
          animacion(fila,"red");
          setTimeout(function(){ location.reload(); },2500);
          return;
      }
      if(!$.isNumeric(response) && response!=""){
              var results = response.split('|');
              alert(results[0])
              azar=results[1]
              if(Number.isInteger(azar)){
                    location.href = 'error_php.php?azar='+azar
              }else{
                    location.href = 'error_php.php'
              }                    
              return;
      }
      tipo_de_undo=0
      $('#eliminar_obs').val('1')
      $('.eliminame').remove()
			var arreglo = response.split(",");
      tipo_msg = "info"
      color_ani='#69cd70'
			var mensaje = "";
			var time_out = 1000;
      no_actives = false
			if(("eliminar_total" in datos_para_enviar)){
          sin_definir_ahora()
      }
			if(("id_env" in datos_para_enviar)){
          number_two_env=datos_para_enviar["number_two_env"]
          id_env=datos_para_enviar["id_env"]
				  sacar_valores($("#mas"+number_two_env+"_"+id_env));
          if(!undo_now){ valores_undo(datos_para_enviar); }
/*
          if(!undo_now){
              $("#undo_id").val(id)
              $("#undo_value").val(tocado[numero_esp])
              $("#undo_total").val(gran_total.text())
              $("#undo_regalo").val(regalo.text())
              $("#undo_button").prop('disabled', false);
          }
*/
				  if($.isNumeric(arreglo[0]) || arreglo[0]==""){
                if(number_two_env!="2"){
					          if( arreglo[0]!="-1" ){
    						        if(arreglo[0]!=""){
                            registro[numero]=arreglo[0]
                        };
					          }else{
  						          delete registro[numero];
					          }
                }
					      delete tocado[numero_esp];
                tipo_msg = "success"
  				      mensaje = "Guardado con éxito";
                if("regalo_env" in datos_para_enviar){ color_ani='#42c2e7' }
                if(undo_now){ color_ani='#42c2e7' }
                if(parseFloat(number_two_env) > 2 && number_two_env!=""){
                    tipo_msg = "info"
                    time_out = 5000
      				      mensaje = "Se regreso el obsequio de vuelta al inventario.";
                    if(clase_env == "mas"){
            				      mensaje = "Se saco la pieza(s) del inventario para ser obsequiada(s).";
                    }
                    if(datos_para_enviar["regalo_env"] == "0"){
                          desaparecer($("#row"+numero_esp))
                          no_actives = true
                    }
                }
                animacion(fila,color_ani);
			    }
			}else{
          if(!undo_now){ valores_undo(datos_para_enviar); }
          tipo_msg = "info"
      }
/*
			if($.isNumeric(arreglo[1])){
				  if( arreglo[1]!="-1" ){
  					  regalo_id.val(arreglo[1]);
				  }else{
  					  regalo_id.val("");
				  }
			}
*/
			if(("gran_total_env" in datos_para_enviar)){
          tipo_msg = "info"
					gran_total.text(regresar_texto(datos_para_enviar["gran_total_env"]));
					time_out = 5000
    			if(("id_env" in datos_para_enviar)){
    					mensaje = "Se agrego el libro sin sacar dinero del fondo actual con éxito";
          }else{
          		animacion(dinero,"#42c2e7");
              $("#cerrar").trigger("click")
              mensaje = "Se cambio el fondo de efectivo con éxito";
          }
					animacion(gran_total,"#42c2e7");
			}
			if(("regalo_env" in datos_para_enviar && (parseFloat(number_two_env) < 3 || number_two_env==""))){
          regalo_env=datos_para_enviar["regalo_env"]
          if($("#piezas"+numero_esp2).length){
              $("#piezas"+numero_esp2).val(regalo_env)
          }else{
              if(datos_para_enviar["number_two_env"]==""){
                    nombre2=$("#nombre"+numero_esp).text()
              }else{
                    nombre2=$("#textarea"+numero_esp).val()
                    nombre2=nombre2.toUpperCase();
              }
              tipo2=$("#tipo"+numero_esp).text()
              donativo2=$("#donativo"+numero_esp).text()
              oculto2=""
              if(obs_oculto=="1"){
                  oculto2=" oculto2"
              }
              $('#letra_obs').after("<tr class='italica"+oculto2+"' id='row"+numero_esp2+"'>\
                      <td id='nombre"+numero_esp2+"'>"+nombre2+"</td>\
                      <td id='tipo"+numero_esp2+"'>"+tipo2+"</td>\
                      <td id='donativo"+numero_esp2+"'>"+donativo2+"</td>\
                      <td class='centrado' id='mas_menos"+numero_esp2+"'>\
                      <input class='menos' id='menos"+numero_esp2+"' value='-' type='button'><input id='piezas"+numero_esp2+"' class='piezas_obs' value='"+regalo_env+"' disabled><input class='mas' id='mas"+numero_esp2+"' value='+' type='button'></td>\
                      <td id='importe"+numero_esp2+"'>"+donativo2+"</td>\
                    </tr>\
	                ")
              if($('#ordenar').val() == '1'){ asignar_obs() };
              $("#row"+numero_esp2).change()
              $('#letra_obs').removeClass("oculto")
              $('#totales_regalo').removeClass("oculto")
              $('#nav_obs').removeClass("oculto")
              asignar_mas_menos()
          }
          para_animar=$("#row"+numero_esp2)
          setTimeout(function(){ 
    		        if(!undo_now){ location.hash="#letra_obs"; }
                animacion(para_animar,"#42c2e7");
          },2500);
          tipo_msg = "info"
				  mensaje = "El Obsequio se agrego con éxito";
//				  regalo.text(regresar_texto(datos_para_enviar["regalo_env"]));
//				  animacion(regalo,"yellow");
			}
/*
			if(("regalo_env" in datos_para_enviar) && ("gran_total_env" in datos_para_enviar)){
				  time_out = 5000
				  animacion(dinero,"yellow");
          if(!undo_now){
              $("#undo_button").prop('disabled', true);
    				  mensaje = "Obsequios y dinero del fondo actualizados con éxito";
    				  retraer();
          }
			}
      if(undo_now){
          $("#undo_id").val("")
          $("#undo_value").val("")
          $("#undo_total").val("")
          $("#undo_regalo").val("")
          mensaje = "Se deshizo la ultima acción exitosamente.";
          $('html, body').animate({
              scrollTop: $("#row"+datos_para_enviar["number_two_env"]+"_"+datos_para_enviar["id_env"]).offset().top
          }, 0);
		      retraer();
      }
*/
      if(("piezas_env" in datos_para_enviar)){
	        piezas_val=datos_para_enviar["piezas_env"];
          if(parseFloat(number_two_env) > 2 && number_two_env!=""){
              numero_esp_ausar=numero_esp2
          }else{
              numero_esp_ausar=numero_esp
          }
          tipo_num=sacar_tipo(numero_esp_ausar)
          if(piezas_val != 0){
                des_ocultar(numero_esp_ausar)
                $('#row'+numero_esp_ausar).removeClass("sin_exist")
                $("#letra_"+tipo_num).removeClass("sin_exist")
                $("#totales_tipo_"+tipo_num).removeClass("sin_exist")
                $("#letra_nav_"+tipo_num).removeClass("sin_exist")
                $('#row'+numero_esp_ausar).addClass("con_exist")
                $("#letra_"+tipo_num).addClass("con_exist")
                $("#totales_tipo_"+tipo_num).addClass("con_exist")
                $("#letra_nav_"+tipo_num).addClass("con_exist")
                if(tipo_num == "per"){ 
                    $("#row2_new").removeClass("sin_exist")
                    $("#row2_new").addClass("con_exist")
                    $("#mostrar").removeClass("sin_exist")
                    $("#mostrar").addClass("con_exist")
                }
          }else{
                $('#row'+numero_esp_ausar).addClass("sin_exist")
                $('#row'+numero_esp_ausar).removeClass("con_exist")
                if(!$(".con_exist .piezas_"+tipo_num).length){
                      if(tipo_num == "per"){ 
                          $("#row2_new").addClass("sin_exist")
                          $("#row2_new").removeClass("con_exist")
                          $("#mostrar").addClass("sin_exist")
                          $("#mostrar").removeClass("con_exist")
                      }
                      $("#letra_"+tipo_num).addClass("sin_exist")
                      $("#totales_tipo_"+tipo_num).addClass("sin_exist")
                      $("#letra_nav_"+tipo_num).addClass("sin_exist")
                      $("#letra_"+tipo_num).removeClass("con_exist")
                      $("#totales_tipo_"+tipo_num).removeClass("con_exist")
                      $("#letra_nav_"+tipo_num).removeClass("con_exist")
                }
          }
      }
			if(!mantuvo_presionado){
				  if(!no_actives){
              mas.prop('disabled', false);
          }
				  desabilitar_si_cero();
			}else{
				  valores_generales();
				  if(("id_env" in datos_para_enviar)){
    				  time_out = 5000
              if(parseFloat(number_two_env) > 2 && number_two_env!=""){
                    piezas_val=datos_para_enviar["regalo_env"]
                    tipo_msg = "info"
    					      mensaje = "El obsequio seleccionado fue enviado a efectivo.";
                    if(undo_now){ 
                        numero_esp2_guardado=numero_esp2
          					    sacar_importe(1);
                      	sacar_valores($("#row"+numero_esp2_guardado));
                        piezas_val=datos_para_enviar["piezas_env"]
                    }
              }else{
                    if($("#row"+numero_esp2).length && "regalo_env" in datos_para_enviar){
                        numero_esp2_guardado=numero_esp2
          					    sacar_importe(1);
                      	sacar_valores($("#row"+numero_esp2_guardado));
                        piezas_val=datos_para_enviar["regalo_env"]
                    }
              }
					    sacar_importe();
				  }else{
					  funcion_gran_total(); 
				  }
				  activar_todos();
			}
      if(undo_now){ 
            tipo_msg = "info"
            mensaje="Se revertió la ultima accion con éxito."; 
            retraer()
      }
      if(!mensaje){
          alert(response)
      }
			toastr.options.timeOut = time_out;
			toastr[tipo_msg](mensaje);
		},
		error: function(){
			if(("id_env" in datos_para_enviar)){
				sacar_valores($("#mas"+datos_para_enviar["number_two_env"]+"_"+datos_para_enviar["id_env"]));
				mas.prop('disabled', false);
        $("#undo_button").prop('disabled', false);
				regresar()
				desabilitar_si_cero();
			}
			toastr.options.timeOut = 5000;
			toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
			if(mantuvo_presionado){
				activar_todos();
			}
		}
	});
}
function animacion(anchor,color){
	anchor.animate({backgroundColor: color}, '500');
	anchor.animate({backgroundColor: "transparent"}, '500');
	anchor.animate({backgroundColor: color}, 'slow');
	anchor.animate({backgroundColor: "transparent"}, '500');
	anchor.animate({backgroundColor: color}, 'slow');
	anchor.animate({backgroundColor: "transparent"}, '500');
}
function activar_todos(){
  $('#pasar_regalo, #pasar_a_efectivo').prop('disabled', false);
	boton_guardar.prop('disabled', false);
	$('.mas').prop('disabled', false);
	$('.menos').prop('disabled', false);
	$('.piezas').each(function(){
		  piezas_val=regresar_val($(this).val());
		  obtener_numero($(this));
    	menos=$("#menos"+numero_esp);
		  mas=$("#mas"+numero_esp);
		  desabilitar_si_cero();
	});
}
function sacar_importe(sin_total){
    sin_total = (typeof sin_total !== 'undefined') ?  sin_total : 0
	piezas.val(piezas_val);
	importe.text(regresar_texto(donativo_val*piezas_val));
	desabilitar_si_cero()
	piezas.trigger("change");
  if(!sin_total){
    	funcion_gran_total();
  }
}
function regresar(){
	if((numero_esp in tocado)){
      hay_volteado=0
      if(parseFloat(number_two) > 2 && number_two != ""){
        	if((numero_esp in tocado_volteado)){
              objeto_voltear=$("#piezas"+numero_esp2)
              volteado_val=tocado_volteado[numero_esp]
    		      delete tocado_volteado[numero_esp];
              hay_volteado=1
          }
      }
		  piezas_val=tocado[numero_esp];
		  delete tocado[numero_esp];
		  animacion(fila,"red");
		  sacar_importe(hay_volteado)
      if(hay_volteado){
          sacar_valores(objeto_voltear)
          piezas_val=volteado_val
		      animacion(fila,"red");
		      sacar_importe()
      }
	}
}
function desabilitar_si_cero(){
  if(parseFloat(number_two) > 2 && number_two != ""){
      menos.prop('disabled', false);
      volteado=parseFloat($("#piezas"+numero_esp2).val())
      piezas_val=parseFloat($("#piezas"+numero_esp).val())
	    if(volteado==0){
   		    mas.prop('disabled', true);
	    }else{
		      mas.prop('disabled', false);
	    }
	    if(piezas_val==0){
   		    menos.prop('disabled', true);
	    }else{
		      menos.prop('disabled', false);
	    }
  }else{
	    if(piezas_val==0){
   		    menos.prop('disabled', true);
          if($("#mas"+numero_esp2).length){ $("#mas"+numero_esp2).prop('disabled', true); }
	    }else{
		      menos.prop('disabled', false);
          if($("#mas"+numero_esp2).length){ $("#mas"+numero_esp2).prop('disabled', false); }
	    }
  }
}
function sacar_valores(elemento){
	objeto=elemento;
	id=objeto[0].id;
	obtener_numero(objeto);
	clase=objeto[0].className;
  donativo=$("#donativo"+numero_esp);
  donativo_val=regresar_val(donativo.text());
	mas_menos=$("#mas_menos"+numero_esp);
	piezas=$("#piezas"+numero_esp);
	piezas_val=regresar_val(piezas.val());
	importe=$("#importe"+numero_esp);
	importe_val=regresar_val(importe.text());
	menos=$("#menos"+numero_esp);
	mas=$("#mas"+numero_esp);
	fila=$("#row"+numero_esp);
}
function sacar_tipo(numero_esp_env){
    tipo_text=$('#piezas'+numero_esp_env).attr('class').split(' ')[1]
    return tipo_text.substring(tipo_text.lastIndexOf("_") + 1);
}
function des_ocultar(numero_esp_env){
    tipo_num=sacar_tipo(numero_esp_env)
    $('#row'+numero_esp_env).removeClass("oculto")
    $("#letra_"+tipo_num).removeClass("oculto")
    $("#totales_tipo_"+tipo_num).removeClass("oculto")
    $("#letra_nav_"+tipo_num).removeClass("oculto")
}
function redibujar(){ //al redibujar los botones, esto aparecen sin presionar
  if(number_two == "2"){
      mas_menos_a_usar=$("mas_menos_span_"+id)      
  }else{
      mas_menos_a_usar=mas_menos
  }
	var cont=mas_menos_a_usar.find('*').detach();
  cont.appendTo(mas_menos_a_usar);
  mas.blur();
  menos.blur();
  setTimeout(function(){ redibujar_otro(mas_menos_a_usar) }, 1000);
  setTimeout(function(){ redibujar_otro(mas_menos_a_usar) }, 3000);
}
redibujar_otro = function(mas_menos_a_usar) {
	var cont=mas_menos_a_usar.find('*').detach();
  cont.appendTo(mas_menos_a_usar);
}
function regresar_val(valor){
	valor=valor.replace(/,/g, '')
	return parseFloat(valor.replace('$', ''))
}
function regresar_texto(valor){
	valor=valor.toFixed(2).replace(/./g, function(c, i, a) {
	    return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
	});
	return "$"+valor;
}
/*
function totales(){
//	regalo_id.val(regalo_id_php);
//	regalo.text(regalo_php);
//	gran_total_id.val(gran_total_id_php);
	gran_total.text(fondo_total.val());
//	cambiar_regalo.val(regalo_php.replace('$', ''));
//	valores_generales();
	funcion_gran_total();
}
*/
function valores_generales(){
	regalo_text=regalo.text();
	regalo_val=regresar_val(regalo_text);
//	regalo_id_text=regalo_id.val();
//	gran_total_id_text=gran_total_id.val();
	gran_total_text=gran_total.text();
	if(gran_total_text!="SIN DEFINIR"){ gran_total_val=regresar_val(gran_total_text); };
}
/*
boton_guardar.click(function() {
	if(son_numericos()){
		gran_total_val_env=cambiar_dinero_val+cambiar_regalo_val+gran_total_importe_val;
		datos_para_enviar = { gran_total_env: gran_total_val_env, gran_total_id_env: gran_total_id_text, regalo_env: cambiar_regalo_val, regalo_id_env: regalo_id_text };
		guardar_valores(datos_para_enviar,1);
	}
});
$("#cerrar").click(function() {
  	retraer();
});
$('#pasar_regalo').click(function() {
	if(son_numericos()){
		cambiar_dinero.val(cambiar_dinero_val+cambiar_regalo_val);
		cambiar_regalo.val("0.00");
	}
});
function son_numericos(){
	cambiar_dinero_texto=cambiar_dinero.val();
	cambiar_regalo_texto=cambiar_regalo.val();
	if(!$.isNumeric(cambiar_dinero_texto)){
		toastr.options.timeOut = 5000;
		if(cambiar_dinero_texto=="SIN DEFINIR"){
			toastr["error"]("Escriba un numero primero.");
		}else{
			toastr["error"]("Error: Por favor escriba solo numeros o punto decimal.");
		}
		cambiar_dinero.val("");
		cambiar_dinero.focus();
		return false;
	}else{
		if(!$.isNumeric(cambiar_regalo_texto)){
			toastr.options.timeOut = 5000;
			toastr["error"]("Error: Por favor escriba solo numeros o punto decimal.");
			cambiar_regalo.val("");
			cambiar_regalo.focus();
			return false;
		}
	}
	cambiar_regalo_val=parseFloat(cambiar_regalo_texto);
	cambiar_dinero_val=parseFloat(cambiar_dinero_texto);
	if(regalo < 0){
		toastr.options.timeOut = 5000;
		toastr["error"]("Error: Escriba solo valores positivos.");
		return false;
	}else{
		if(dinero < 0){
			toastr.options.timeOut = 5000;
			toastr["error"]("Error: Escriba solo valores positivos.");
			return false;
		}
	}
	return true;
}
*/
function marcar_eliminar_obs(por_boton) {
    por_boton = (typeof por_boton !== 'undefined') ?  por_boton : 0
    $.ajax({
        type: "POST",
        url: "php/marcar_eliminar.php",
        timeout: 5000,
        success: function(response){
          if(response=="Error"){
              toastr.options.timeOut = 5000;
              toastr["error"]("Error: Es necesario volver a iniciar sesión");
              setTimeout(function(){ location.reload(); },2500);
              return;
          }else{
              if(!$.isNumeric(response) && response!=""){
                      var results = response.split('|');
                      alert(results[0])
                      azar=results[1]
                      if(Number.isInteger(azar)){
                            location.href = 'error_php.php?azar='+azar
                      }else{
                            location.href = 'error_php.php'
                      }                    
                      return;
              }
              tipo_de_undo=1
              $("#undo_button").prop('disabled', false);
              location.hash="#letra_obs";
              toastr["success"]("El valor de los obsequios se enviaro a efectivo con éxito.");
              $('#eliminar_obs').val('2')
              $('.piezas_obs').unbind()
              $('.piezas_obs').addClass('obs_eliminado')
              $('.piezas_obs').removeClass('piezas_obs')
			        $('.obs_eliminado').each(function(){
				          sacar_valores($(this));
                  $('#row'+numero_esp).addClass('eliminame')
                  $('#row'+numero_esp).fadeOut(2500, function() { 
                      $(this).addClass('oculto');
                      $(this).removeAttr("style")
                  });
			        });
              $('#totales_regalo, #nav_obs').fadeOut(2500, function() { 
                      $(this).addClass('oculto');
                      $(this).removeAttr("style")
              });
              $('#letra_obs').fadeOut(2500, function() { 
                      $(this).addClass('oculto');
                      $(this).removeAttr("style")
                      activar_todos()
              });
              if($('#total_obsequio').length){
                  $('#total_importe_obs').text("$0.00");
                  $('#total_obsequio').text("0");
              }
              animacion(dinero,"#42c2e7");
              animacion(regalo,"#42c2e7");
              funcion_gran_total()
              if(por_boton == 0){ retraer(); }
          }
      },
      error: function(){
        activar_todos();
        toastr.options.timeOut = 5000;
        toastr["error"]("Error de conexión. Revise que este conectado correctamente a internet e inténtelo de nuevo.");
      }
    });
}
function seguro_mandar(por_boton){
   por_boton = (typeof por_boton !== 'undefined') ?  por_boton : 0
   if(confirm("¿Recuperar la cantidad invertida en obsequios enviándola a efectivo? Esto eliminara el registro que se tiene de las piezas que se han obsequiados.")){
          desactiva_todo()
          marcar_eliminar_obs(por_boton)
    }
}
$('#pasar_regalo').click(function() {
  seguro_mandar()
});
$('#pasar_a_efectivo').click(function() {
  seguro_mandar(1)
});
boton_guardar.click(function() {
    toastr.options.timeOut = 5000;	
    if(cambiar_dinero.hasClass("sin_def")){
          cambiar_dinero.focus()
    			toastr["warning"]("Escriba el monto en efectivo que desea guardar primero.");
          return
    }
    cambiar_given=parseFloat(cambiar_dinero.val())
    if(!$.isNumeric(cambiar_given)){
          cambiar_dinero.focus()
    			toastr["warning"]("Escriba un monto valido de efectivo antes de guardar.");
          return
    }
    if(!(cambiar_given < 100000)){
    			toastr["error"]("El monto de efectivo debe ser menor a $ 100,000.00 Por favor contate al desarrollador para incrementar el limite si usted necesita manejar un monto superior.");
          return
    }
    gran_total_importe_val=regresar_val(gran_total_importe.text());   
    regalo_val=regresar_val(regalo_text);
		gran_total_val_env=cambiar_given+regalo_val+gran_total_importe_val;
		datos_para_enviar = { gran_total_env: gran_total_val_env };
		guardar_valores(datos_para_enviar,1);
});
$("#cerrar").click(function() {
    $(this).val('Cerrar Cajón')
    cambiar_dinero.addClass('sin_def')
    if(dinero.text()!="SIN DEFINIR"){
        cambiar_dinero.val(regresar_val(dinero.text()))
    }else{
        cambiar_dinero.val("SIN DEFINIR");
    }
    asignar_cambiar_dinero()
    pasar_regalo.prop('disabled', false);
  	retraer();
});
function asignar_cambiar_dinero(){
    cambiar_dinero.focus(function(){
        $(this).val("");
        $(this).removeClass("sin_def");
        $("#cerrar").val("Cancelar")
        $(this).off("focus")
        pasar_regalo.prop('disabled', true);
    })
}
asignar_cambiar_dinero()
function solo_numeros(elemento){
    numero_given=$.trim(elemento.val())
    numero_given=numero_given.replace(/[^0-9\.]+/g, "");
    if(numero_given!="" && numero_given!="."){
        decimales=countDecimals(numero_given);
        if(decimales > 2){
            numero_given=Math.floor(numero_given * 100) / 100;
        }
    }
    elemento.val(numero_given)
    return numero_given
}
cambiar_dinero.on("keyup change", function() {
    solo_numeros($(this))
})
function sin_definir_ahora(){
		gran_total.text("SIN DEFINIR");
		dinero.text("SIN DEFINIR");
    $(".dineros").addClass("rojo")
		animacion(gran_total,"#42c2e7");
		animacion(dinero,"#42c2e7");
    cambiar_dinero.addClass("sin_def");
    cambiar_dinero.val("SIN DEFINIR");
    valores_generales();
}
function funcion_gran_total(){
	cal_total_piezas=0;
	cal_total_importe=0;
	if($('.total_piezas').length){
		$('.total_piezas').each(function(){
			obtener_numero($(this));
			cal_total_piezas=cal_total_piezas+parseFloat($(this).text());
			cal_total_importe=cal_total_importe+regresar_val($("#total_importe"+numero_esp).text());
		});
	}else{
		$('.piezas').each(function(){
			obtener_numero($(this));
			cal_total_piezas=cal_total_piezas+parseFloat($(this).val());
			cal_total_importe=cal_total_importe+regresar_val($("#importe"+numero_esp).text());
		});
	}
	obs_total_importe="$0.00";
	if($('#total_obsequio').length){
      obs_total_importe=$('#total_importe_obs').text();
	}else{
    if($('.piezas_obs').length){
        obs_total_importe=0;
		    $('.piezas_obs').each(function(){
			    obtener_numero($(this));
			    obs_total_importe=obs_total_importe+regresar_val($("#importe"+numero_esp).text());
		    });
        obs_total_importe=regresar_texto(obs_total_importe)
    }
	}
  regalo.text(obs_total_importe);
  cambiar_regalo.val(regresar_val(obs_total_importe).toFixed(2));
	valores_generales()
	gran_total_importe.text(regresar_texto(cal_total_importe));
	gran_total_piezas.text("Literatura ("+cal_total_piezas+")");
	gran_total_importe_val=regresar_val(gran_total_importe.text());
	if(gran_total_text!="SIN DEFINIR"){
			cal_dinero=gran_total_val-gran_total_importe_val-regalo_val;
			if(cal_dinero>=0){
				cambiar_dinero.val(cal_dinero.toFixed(2));
				dinero.text(regresar_texto(cal_dinero));
				dinero_val=regresar_val(dinero.text());
        $(".dineros").removeClass("rojo")
			}else{
          sin_definir_ahora();
			}
	}
//	cambiar_regalo.val(regalo_val.toFixed(2));
}
function obtener_numero(elemento){
	texto=elemento[0].id;
  ultimo_index=texto.lastIndexOf("_")
  number_two=texto.substr(ultimo_index-1,1);
  nombre=texto.substr(0,ultimo_index+1);
	numero=texto.substring(texto.lastIndexOf("_") + 1);
  if(!$.isNumeric(number_two)){
      number_two=""
  }
  numero_esp=number_two+"_"+numero
  switch (number_two) {
     case '':
        numero_esp2="3_"+numero;
        break;
      case '2':
        numero_esp2="4_"+numero;
        break;
      case '3':
        numero_esp2="_"+numero;
        break;
      case '4':
        numero_esp2="2_"+numero;;
        break;
  }
}
$(document).ready(function() {
  retraer()
	$('.ordenar, .ordenar_dos, .filtrar').click(function (e) {
		e.preventDefault();
		e.stopPropagation();
		nombre=$(this)[0].className;
    if(nombre != "ordenar"){
		    if($('#'+nombre).val()=="0"){
			    $('#'+nombre).val("1");
		    }else{
			    $('#'+nombre).val("0");
		    }
		    $('.'+nombre).prop('disabled', false);
		    $(this).prop('disabled', true);
        if(nombre == "ordenar_dos"){
            $('#ordenar').val("1");
            $('.ordenar').prop('disabled', false);
        }
    }else{
			    $('#ordenar').val("0");
			    $('#ordenar_dos').val("0");
  		    $('.ordenar_dos').prop('disabled', false);
  		    $(this).prop('disabled', true);
    }
    if(nombre=="ordenar" || nombre=="ordenar_dos"){
    		contenido(1);
    }else{
        if($('#'+nombre).val()=="0"){
            $(".sin_exist").removeClass("oculto")
            $("#mostrar").addClass("oculto")
            $("#no_hay_exist").addClass("oculto")
        }else{
            $(".sin_exist").addClass("oculto")
            if($('.sin_exist .piezas_per').length && $('.con_exist .piezas_per').length){
                  $("#mostrar").removeClass("oculto")
            }
            if(! $('.con_exist').length && $('#letra_obs').hasClass('oculto')){
                $("#no_hay_exist").removeClass("oculto")
            }
        }
        $("#right_tape").scrollLeft(2000)
        $("#right_tape").scrollTop(0)
	      filtrar=$("#filtrar").val();
        retraer()
        $.ajax({
		      type: "POST",
		      url: "php/guardar_filtrado.php",
		      data: $.param({filtrar_env: filtrar}),
		      timeout: 5000,
          		success: function( response ) {
	                if(response=="Error"){
		                  toastr.options.timeOut = 5000;
		                  toastr["error"]("Error: Es necesario volver a iniciar sesión");
		                  setTimeout(function(){ location.reload(); },2500);
		                  return;
	                }
                    if(!$.isNumeric(response) && response!=""){
                            var results = response.split('|');
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
	      });
    }
	});
});
function desactiva_todo(){
		boton_guardar.prop('disabled', true);
		$('.mas, .menos').prop('disabled', true);
    $("#undo_button").prop('disabled', true);
    $('#pasar_regalo, #pasar_a_efectivo').prop('disabled', true);
}
$(document).ready(function() {
      $("#nav_per").unbind()
      $("#nav_per").click(function() {
          if(! $('#letra_per').hasClass('oculto')){
                location.hash="#letra_per";
          }else{
              $("#no_hay_exist").addClass("oculto")
              $("#letra_per").removeClass("oculto")
              $("#totales_tipo_per").removeClass("oculto")
              $("#row2_new").removeClass("oculto")
                $('.piezas_per').each(function(){
                    obtener_numero($(this))
                    $("#row"+numero_esp).removeClass("oculto")
              })
              location.hash="#letra_per";
          }
      })
      p = $( "#referencia" ).first();
      position = p.position();
      position = position.top;
      $("#right_tape").width(position)
      $("#right_tape").scrollLeft(position*5)
      $("#right_tape2").height(position)
})
gran_total.text(fondo_total.val());
funcion_gran_total();
