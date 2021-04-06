<?php //PHP
	include "php/loggin.php";
  if(isset($_SESSION['acceso'])){
      unset($_SESSION['acceso']);
  }
?>
  <link rel="stylesheet" href="css/estilos.css" type="text/css">
  <link rel="stylesheet" href="css/tabla.css" type="text/css">
  <link rel="stylesheet" type="text/css" media="all" href="css/drawer.css">
  <link rel="stylesheet" href="css/drawer2.css" type="text/css">
  <meta name="viewport" content="width=790, minimum-scale=0.76">
  <title>Inventario</title>
</head><body>
<?php //PHP
	include 'php/data_base_work.php';
  include 'php/consulta.php';
?>
<div id="referencia"></div>
<div id="contenido">
	<div id="loading"><img src="images/loading.gif"></div>
</div>
<div id="menu">
	<br>
</div>
	<div id="section" class="drawer">
		<div id="header" class="clickme"><img src="images/flecha.png"></div>
			<div class="drawer-content">
				    <div><div class="botones3"><input value="Nombre" id="tags" name="tags"></div> <div class="botones3"><input value="Código" id="codigo" name="codigo"></div>
					    <table id="totales" border="0">
						    <tbody>
							    <tr>
								    <td id="gran_total_piezas">Literatura</td>
								    <td id="gran_total_importe">$0.00</td>
							    </tr>
							    <tr>
								    <td class="dineros rojo">Dinero</td>
								    <td class="dineros rojo" id="dinero">SIN DEFINIR</td>
							    </tr>
<?php //php
      if($fun_avan) {
?>
							    <tr id="reg_obs">
<?php //php
      }else{
                  echo "							    <tr id='reg_obs' class='oculto4'>";
      }
?>
								    <td>Obsequiado</td>
								    <td><span id="regalo">$0.00</span></td>
							    </tr>
							    <tr>
								    <td>Total</td>
								    <td class="gran_total"><?php echo "<input id='fondo_total' value='$fondo_total' type='hidden'>" ?><span id="gran_total">SIN DEFINIR</span></td>
							    </tr>
						    </tbody>
					    </table>
				    </div>
				    <div>Ordenar
              <div class="botones3">
<?php //php
	    if(false){
    ?>
					    <button name="ordenar_n" type="button" id="por_nombre">Por Nombre</button>
					    <button name="ordenar_t" type="button" id="por_tipo">Por Tipo</button>
<?php //php
	    }
	    echo "<input id='ordenar' type='hidden' value='$ordenar'>";
	    echo "<input id='ordenar_dos' type='hidden' value='$ordenar_dos'>";
	    if($ordenar=="1"){
	          if($ordenar_dos=="0"){
	                echo "
		                <button class='ordenar_dos' type='button' disabled>Por Nombre</button>
		                <button class='ordenar_dos' type='button'>Por Codigo</button>
	                ";
	          }else{
	                echo "
		                <button class='ordenar_dos' type='button'>Por Nombre</button>
		                <button class='ordenar_dos' type='button' disabled>Por Codigo</button>
	                ";	
	          }
            echo "<button class='ordenar' type='button'>Alfabético</button>";
      }else{
	          echo "
		          <button class='ordenar_dos' type='button'>Por Nombre</button>
		          <button class='ordenar_dos' type='button'>Por Codigo</button>
              <button class='ordenar' type='button' disabled>Alfabético</button>
	          ";	
      }
/*
	    if($ordenar=="0"){
	    echo "
		    <button class='ordenar' type='button' disabled>Por Nombre</button>
		    <button class='ordenar' type='button'>Por Tipo</button>
	    ";
	    }else{
	    echo "
		    <button class='ordenar' type='button'>Por Nombre</button>
		    <button class='ordenar' type='button' disabled>Por Tipo</button>
	    ";	
	    }
*/
?>
      				</div>
				    </div>
				    <div>Mostrar LAC
              <div class="botones3">
<?php //php
	    if(false){
?>
					    <button name="en_existencia" type="button" id="en_existencia">En existencia</button>
					    <button name="todos" type="button" id="todos">Todos</button>
<?php //php
	    }
	    echo "<input id='filtrar' type='hidden' value='$filtrar'>";
	    if($filtrar=="0"){
	        echo "
		        <button class='filtrar' type='button' id='filtrar_no' disabled>Todos</button>
		        <button class='filtrar' type='button'>En existencia</button>
	        ";
	    }else{
          echo "
	          <button class='filtrar' type='button' id='filtrar_no'>Todos</button>
	          <button class='filtrar' type='button' disabled>En existencia</button>
          ";	
	    }
        $oculto4="";
  	    echo "<input id='fun_avan' type='hidden' value='$fun_avan'>";
        if($fun_avan == "0"){
              $oculto4=" class='oculto4'";
        }
?>
      			</div>
			    </div>
			    <div id="mas_largo">
              <div class="botones3">
							    <div class="centrado">Dinero</div>
							    <div><input type='tel' value="SIN DEFINIR" id="cambiar_dinero" class="sin_def"></div>
              </div>
<?php //php
        if($fun_avan == "0"){
              echo "
              <div class='botones3 ocultame oculto4'>
							    <div class='centrado'><br></div>
							    <div class='centrado'><input id='pasar_regalo' value='&lt;&lt;' type='button'></div>
              </div>
              <div class='botones3 ocultame oculto4'>
							    <div class='centrado'>Obsequio</div>
							    <div><input value='0.00' id='cambiar_regalo' name='cambiar_regalo' disabled></div>
              </div>
";
        }else{
?>
              <div class="botones3">
							    <div class="centrado"><br></div>
							    <div class="centrado"><input id="pasar_regalo" value="&lt;&lt;" type="button"></div>
              </div>
              <div class="botones3">
							    <div class="centrado">Obsequio</div>
							    <div><input value="0.00" id="cambiar_regalo" name="cambiar_regalo" disabled></div>
              </div>
<?php //php
        }
?>
              <div class="botones3">
							    <input id="guardar" value="Guardar" type="button">
							    <input id="cerrar" value="Cerrar Cajón" type="button">
              </div>
			    </div>
          <div class="last-part">
              <button onclick="window.location='imprimir.php';"><img src="images/imprimir3.png"><div>INFORME</div></button>
<!--              <button onclick="window.location='imprimir.php?ordenar_env=1';"><img src="images/imprimir3.png"><div>LISTA A</div></button>
              <button onclick="window.location='imprimir.php?ordenar_env=0';"><img src="images/imprimir3.png"><div>LISTA B</div></button>
              <button onclick="window.location='imprimir.php';"><img src="images/check2.png"><div>INVENTARIAR</div></button>
              <button onclick="window.location='imprimir.php';"><img src="images/check2.png"><div>USO DEL GPO.</div></button>
-->
<?php //php
        if($fun_avan == "0"){
              echo "<button id='desact_fun' style='display:none'><img src='images/check5.png'><div>FUNCIONES<br>AVANZADAS</div></button>
      <button id='act_fun'><img src='images/check4.png'><div>FUNCIONES<br>AVANZADAS</div></button>";
        }else{
?>
              <button id="act_fun" style='display:none'><img src="images/check4.png"><div>FUNCIONES<br>AVANZADAS</div></button>
              <button id="desact_fun"><img src="images/check5.png"><div>FUNCIONES<br>AVANZADAS</div></button>
<?php //php
        }
        if($pulso == "0"){
              echo "<button id='act'$oculto4><img src='images/check5.png'><div>PULSO<br>LARGO</div></button>
      <button style='display:none' id='desact'><img src='images/check4.png'><div>PULSO<br>LARGO</div></button>";
        }else{
              echo "<button id='act' style='display:none'><img src='images/check5.png'><div>PULSO<br>LARGO</div></button>
      <button id='desact'$oculto4><img src='images/check4.png'><div>PULSO<br>LARGO</div></button>";
        }
              echo "
              <input id='eliminar_obs' type='hidden' value='$eliminar_obs'>
";
        if($ocultar_obs != "0"){
              echo "<button id='act_obs'$oculto4><img src='images/check4.png'><div>MOSTRAR<br>OBSEQ.</div></button>
      <button style='display:none' id='desact_obs'><img src='images/check5.png'><div>MOSTRAR<br>OBSEQ.</div></button>";
        }else{
              echo "<button id='act_obs' style='display:none'><img src='images/check4.png'><div>MOSTRAR<br>OBSEQ.</div></button>
      <button id='desact_obs'$oculto4><img src='images/check5.png'><div>MOSTRAR<br>OBSEQ.</div></button>";
        }
?>
              <button id="undo_button" disabled><img src="images/undo.png"><div>DESHACER</div></button>
              <button onclick="window.location='perfil_de_usuario.php';"><img src="images/perfil.png"><div>MI PERFIL</div></button>
              <button onclick="window.location='acerca_de.php';"><img src="images/favicon.png"><div>ACERCA</div></button>
              <button id="salir_button"><img src="images/salir.png"><div>SALIR</div></button>
    		</div>
		</div>
	</div>
<script type="text/javascript" src="js/jquery.slidedrawer.min.js"></script>
<script type="text/javascript">
  var fun_avan=<?php echo $fun_avan."\n" ?>
  var pulso=<?php echo $pulso."\n" ?>
  var obs_oculto=<?php echo $ocultar_obs."\n" ?>
  height_antes=$(window).height()
  function make_drawer(){
      p = $( "#referencia" ).first();
      position = p.position();
      position = position.top;   
      $("#right_tape").width(position)
      $("#right_tape2").height(position)
      $("#right_tape").scrollLeft(position*5)
      height_ventana=$(window).height()
      $("body").css("padding-bottom", height_ventana-95)
      width_antes=$(window).width()
      $('.clickme').off()
      $(".drawer").css("max-height","")
      $(".drawer-content").css("max-height","")
      $(".drawer").css("height","auto")
      $(".drawer-content").css("height","auto")
      $(".drawer").height($(".drawer").height()-104)
      $(".drawer-content").height($(".drawer-content").height()-82)
      $(".drawer").css("max-height",position)
      $(".drawer-content").css("max-height",position-133)
      $('.drawer').slideDrawer({ showDrawer: true, slideTimeout: false });
      $( "#header" ).click(function() {
          $(".drawer-content").animate({scrollTop:0}, 500, 'swing')
      });
  }
  $(document).ready(function() {
      make_drawer()
  });
  $(window).resize(function(){
      height_ventana=$(window).height()
      if(height_ventana < height_antes-350 || height_ventana-350 > height_antes){
          height_antes=height_ventana
          make_drawer()
          retraer()
      }
  });
</script>
<?php //php
	$last_edited=filectime('js/descripcion.js');
    echo "<script type='text/javascript' src='js/descripcion.js?$last_edited'></script>";
	$last_edited=filectime('js/contenido.js');
    echo "<script type='text/javascript' src='js/contenido.js?$last_edited'></script>";
	$last_edited=filectime('js/general.js');
    echo "<script type='text/javascript' src='js/general.js?$last_edited'></script>";
?>
<script type="text/javascript">
    contenido();
</script>
</body></html>
