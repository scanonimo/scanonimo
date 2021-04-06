<?php //PHP
  if (is_file('../php/php_error_catcher.php')){
        include '../php/php_error_catcher.php';
  }else{
        if (is_file('php/php_error_catcher.php')){
              include 'php/php_error_catcher.php';
        }else{
              include 'php_error_catcher.php';
        }
  }
	include 'data_base_work.php';
	session_start();
	if(!isset($_SESSION['usuario'])){
		$usuario="";
		$tipo="-1";
	}else{
		$usuario=$_SESSION['usuario'];
		$tipo=$_SESSION['tipo'];
	}
	if($usuario=="" or $tipo!="1"){
		echo "
Es necesario que vuelva a iniciar sesión.
<script type='text/javascript'>
		    location.reload();
</script>
";
		exit;
	}
	$usuario_id=$_SESSION['id'];
	$ordenar=$_POST["ordenar_env"];
	$ordenar_dos=$_POST["ordenar_dos_env"];
	$filtrar=$_POST["filtrar_env"];
  $guardar=$_POST["guardar_env"];
  $eliminar_obs=$_POST["eliminar_obs_env"];
  $oculto2="";
  $oculto3="";
  if($_POST["ocultar_obs_env"]=="1"){
      $oculto3=" oculto2";
  }
  $oculto4="";
  $fun_avan_env=$_POST["fun_avan_env"];
  $change_fun_avan=0;
  if($fun_avan_env=="0"){
      $oculto4=" oculto4";
  }
  include 'eliminar_obs.php';
  if($eliminar_obs != '0'){
      echo "<script type='text/javascript'>
		    $('#eliminar_obs').val('0');
      </script>
      ";
  }
	if($ordenar=="0"){
		$ordenar_por="para_ordenar";
	}else{
  	$ordenar_por="libros.tipo, para_ordenar";
	}
/*
	if($filtrar=="0"){
//		$existencia="LEFT";
//    $existencia2="";
	}else{
//		$existencia="INNER";
//    $existencia2=" cantidad > 0 AND ";
	}
*/
if($ordenar_dos==0){
	$query = "
SELECT 
  CASE 
      WHEN libros.nombre REGEXP '^[a-z]' = 1 THEN libros.nombre 
      WHEN libros.nombre REGEXP '^[^a-z]{3}' = 1 THEN SUBSTR(libros.nombre, 4)
      WHEN libros.nombre REGEXP '^[^a-z]{2}' = 1 THEN SUBSTR(libros.nombre, 3)
      ELSE SUBSTR(libros.nombre, 2)
  END AS para_ordenar,
libros.id, libros.codigo, UPPER(libros.nombre) AS nombre, libros.tipo AS tipo_id, tipo.nombre AS tipo, CONCAT('$', FORMAT(libros.donativo, 2)) AS donativo, inventario.piezas, inventario.obsequiados, CONCAT('$', FORMAT(libros.donativo * inventario.piezas,2)) AS importe, CONCAT('$', FORMAT(libros.donativo * inventario.obsequiados,2)) AS importe_obs, inventario.id AS registro FROM libros LEFT JOIN (SELECT * FROM inventario WHERE usuario='".$_SESSION['id']."') AS inventario ON libros.id=inventario.libro INNER JOIN tipo ON libros.tipo=tipo.id WHERE descontinuado != 1 ORDER BY $ordenar_por";
}else{
	$query = "
SELECT 
  CASE 
      WHEN libros.codigo REGEXP '^[^a-z]{1}' = 1 THEN '1'
      ELSE '0'
  END AS ordenar3,
UPPER(libros.nombre) AS para_ordenar, SUBSTRING_INDEX(libros.codigo,'-',1) AS ordenar1, SUBSTRING_INDEX(libros.codigo,'-',-1) AS ordenar2, libros.id, libros.codigo, UPPER(libros.nombre) AS nombre, libros.tipo AS tipo_id, tipo.nombre AS tipo, CONCAT('$', FORMAT(libros.donativo, 2)) AS donativo, inventario.piezas, inventario.obsequiados, CONCAT('$', FORMAT(libros.donativo * inventario.piezas,2)) AS importe, CONCAT('$', FORMAT(libros.donativo * inventario.obsequiados,2)) AS importe_obs, inventario.id AS registro FROM libros LEFT JOIN (SELECT * FROM inventario WHERE usuario='".$_SESSION['id']."') AS inventario ON libros.id=inventario.libro INNER JOIN tipo ON libros.tipo=tipo.id WHERE descontinuado != 1 ORDER BY libros.tipo, ordenar3, ordenar1, CAST(ordenar2 as SIGNED), ordenar2";
}
$sin_existencia_general="";
	$result=correr_query($enlace, $query);
/*
	if(!mysqli_num_rows($result) && !mysqli_num_rows($result2)){
?>
	<div class="error">Actualmente no existe ningún libro en existencia. Agregue los libros en existencia y vuelva a intentarlo.</div>
	<div id="loading"><img src="images/loading.gif"></div>
	<script type="text/javascript">
		$("#filtrar").val("0");
		$(".filtrar").prop('disabled', false);
		$("#filtrar_no").prop('disabled', true);
		setTimeout(contenido, 3000);
	</script>
<?php //php
		exit;
	}
*/
  setlocale(LC_MONETARY, $locale);
  if($guardar){
	    $query = "UPDATE consulta SET ordenar='$ordenar', ordenar_dos='$ordenar_dos' WHERE usuario='$usuario_id'";
//      echo $query;
	    correr_query($enlace, $query);
  }
?>
<table class="libros" border="1" cellpadding="2" cellspacing="2">
  <tbody>
    <tr class="col_head">
      <td>NOMBRE</td>
      <td>TIPO</td>
      <td style="text-align: center;">PRECIO</td>
      <td>PIEZAS</td>
      <td style="text-align: center;">TOTAL</td>
    </tr>
<?php //PHP
  $lista_obsequiados="";
	$availableTags="";
	$availableTags2="";
	$antes="";
	$cuenta=0;
	$total_importe=0;
	$total_piezas=0;
	$total_importe2=0;
	$total_piezas2=0;
	$registros = array();
	if($filtrar){ $sin_exist="sin_exist oculto"; }else{ $sin_exist="sin_exist"; };
  $existencia_tipo=$sin_exist;
  $registros_tipo="";
//  if(mysqli_num_rows($result)){
	    while($row = mysqli_fetch_array($result)){
		    $desactivar="";
		    $id=$row['id'];
		    $codigo=$row['codigo'];
		    $nombre=$row['nombre'];
        $para_ordenar=$row['para_ordenar'];
		    $tipo=$row['tipo'];
		    $tipo_id=$row['tipo_id'];
		    $donativo=$row['donativo'];
		    $registro=$row['registro'];
		    if($row['piezas']){
			    $piezas=$row['piezas'];
			    $importe=$row['importe'];
		    }else{
			    $importe="$0.00";
			    $piezas="0";
		    }
		    $sin_comillas=addslashes($nombre);
		    $sin_comillas2=addslashes($codigo);
		    $availableTags=$availableTags."{ label: \"$sin_comillas\", value: \"$id\" },\r\n";
		    $availableTags2=$availableTags2."{ label: \"$sin_comillas2\", value: \"$id\" },\r\n";
		    if($piezas=="0"){
			    $desactivar=" disabled";
		    }
        $existencia=$sin_exist;
		    if($ordenar!="0"){
			    $ahora=$tipo_id;
			    if($antes!=$ahora){
				    if($cuenta!=0){
		          $total_importe=money_format("$%!i",$total_importe);
              echo "$titulo_tipo $existencia_tipo$titulo_tipo2
$registros_tipo
		    <tr id='totales_tipo_$antes' class='$existencia_tipo'>
			    <td class='derecha' colspan='3'>Total</td>
			    <td class='centrado total_piezas' id='total_piezas_$antes'>$total_piezas</td>
			    <td class='derecha total_importe' id='total_importe_$antes'>$total_importe</td>
		    </tr>
        <script type='text/javascript'>
//	        $(document).ready(function() {
		        $('.piezas_$antes').change(function (e) {
			        e.preventDefault();
			        e.stopPropagation();
			        total_piezas=0;
			        total_importe=0;
			        $('.piezas_$antes').each(function(){
				        sacar_valores($(this));
				        total_piezas=total_piezas+piezas_val;
				        total_importe=total_importe+importe_val;
			        });
			        $('#total_piezas_$antes').text(total_piezas);
			        $('#total_importe_$antes').text(regresar_texto(total_importe));
		        });
//	        });
        </script>";
					      $total_importe=0;
					      $total_piezas=0;
                $existencias[$cuenta-1]=$existencia_tipo;
                $existencia_tipo=$sin_exist;
	          }
				    $titulo_tipo="
		    <tr id='letra_$ahora' class='letra_titulo"; $titulo_tipo2="'>
			    <td class='letra' colspan='5'>
				    $tipo
			    </td>
		    </tr>
					    ";
					    $antes=$ahora;
					    $letras[$cuenta]=$tipo_id;
					    $tipos_n[$cuenta]=$tipo;
              $registros_tipo="";
					    $cuenta++;
			    }
		    }else{
			    $ahora=$para_ordenar[0];
			    if(preg_match("/[a-z]/i", $ahora)){
				    if($antes!=$ahora){
              if($antes!=""){
					            $titulo_tipo="
		            <tr id='letra_$antes' class='letra_titulo"; $titulo_tipo2="'>
			            <td class='letra' colspan='5'>
				            $antes
			            </td>
		            </tr>
					            ";
                      echo "$titulo_tipo $existencia_tipo$titulo_tipo2
        $registros_tipo";
                $existencias[$cuenta-1]=$existencia_tipo;
                $existencia_tipo=$sin_exist;
              }
					    $antes=$ahora;
					    $letras[$cuenta]=$ahora;
					    $tipos_n[$cuenta]=$ahora;
              $registros_tipo="";
					    $cuenta++;
				    }
			    }
		    }
		    if($registro){
			    $registros[$id] = $registro;
          if($piezas > 0){
              $existencia="con_exist";
              $sin_existencia_general="oculto";
              $existencia_tipo="con_exist";
		          if($ordenar!="0"){
			            $sumar=substr($importe,1);
			            $sumar=floatval(str_replace(",","",$sumar));
			            $total_importe=$total_importe+$sumar;
			            $sumar2=intval($piezas);
			            $total_piezas=$total_piezas+$sumar2;
              }
          }
          if($row["obsequiados"]){
                $importe_obs=$row["importe_obs"];
                $obsequiados=$row["obsequiados"];
			          $sumar3=substr($importe_obs,1);
			          $sumar3=floatval(str_replace(",","",$sumar3));
			          $total_importe2=$total_importe2+$sumar3;
			          $sumar4=intval($obsequiados);
			          $total_piezas2=$total_piezas2+$sumar4;
		            $lista_obsequiados=$lista_obsequiados."
                <tr class='italica$oculto3' id='row3_$id'>
                  <td id='nombre3_$id'>$nombre &#91;$codigo&#93;</td>
                  <td id='tipo3_$id'>$tipo</td>
                  <td id='donativo3_$id'>$donativo</td>
                  <td class='centrado' id='mas_menos3_$id'>
                  <input class='menos' id='menos3_$id' value='-' type='button'><input id='piezas3_$id' class='piezas_obs' value='$obsequiados' disabled><input class='mas' id='mas3_$id' value='+' type='button'$desactivar></td>
                  <td id='importe3_$id'>$importe_obs</td>
                </tr>
	            ";
          }
		    }
		    $registros_tipo=$registros_tipo."
        <tr class='$existencia' id='row_$id'>
          <td id='nombre_$id'>$nombre &#91;$codigo&#93;</td>
          <td id='tipo_$id'>$tipo
          </td>
          <td id='donativo_$id'>$donativo</td>
          <td class='centrado' id='mas_menos_$id'><span style='display:none;'>$piezas</span>
          <input class='menos' id='menos_$id' value='-' type='button'$desactivar><input id='piezas_$id' class='piezas piezas_$ahora' value='$piezas' disabled><input class='mas' id='mas_$id' value='+' type='button'></td>
          <td class='importe_$ahora' id='importe_$id'>$importe</td>
        </tr>
	    ";
	    }
      if($ordenar=="0"){
            $titulo_tipo="
            <tr id='letra_$antes' class='letra_titulo"; $titulo_tipo2="'>
              <td class='letra' colspan='5'>
                $antes
              </td>
            </tr>
                  ";
      }
      echo "$titulo_tipo $existencia_tipo$titulo_tipo2
$registros_tipo";
      $existencias[$cuenta-1]=$existencia_tipo;
	    if($ordenar!="0"){
          $total_importe=money_format("$%!i",$total_importe);
		      echo "
        <tr id='totales_tipo_$antes' class='$existencia_tipo'>
			    <td class='derecha' colspan='3'>Total</td>
			    <td class='centrado total_piezas' id='total_piezas_$antes'>$total_piezas</td>
			    <td class='derecha total_importe' id='total_importe_$antes'>$total_importe</td>
		    </tr>
        <script type='text/javascript'>
//	        $(document).ready(function() {
		        $('.piezas_$antes').change(function (e) {
			        e.preventDefault();
			        e.stopPropagation();
			        total_piezas=0;
			        total_importe=0;
			        $('.piezas_$antes').each(function(){
				        sacar_valores($(this));
				        total_piezas=total_piezas+piezas_val;
				        total_importe=total_importe+importe_val;
			        });
			        $('#total_piezas_$antes').text(total_piezas);
			        $('#total_importe_$antes').text(regresar_texto(total_importe));
		        });
//	        });
        </script>";
	    }
      $existencia_tipo=$sin_exist;
//  }
	$query = "SELECT id, UPPER(nombre) AS nombre, donativo, cantidad, CONCAT('$', FORMAT(donativo * cantidad,2)) AS importe, regalados, CONCAT('$', FORMAT(donativo * regalados,2)) AS importe_reg, total_cant, total_imp FROM `libros_per`, (SELECT SUM(cantidad) AS total_cant, SUM(donativo * cantidad) AS total_imp FROM libros_per WHERE usuario = $usuario_id) AS totales WHERE usuario = $usuario_id ORDER BY id";
	$result=correr_query($enlace, $query);
/*
  $hay_per=0;
  if (!(($filtrar!="0") && !(mysqli_num_rows($result)))) {
      $hay_per=1
*/
					    $titulo_tipo="
		    <tr id='letra_per' class='letra_titulo"; $titulo_tipo2="'>
		      <td class='letra' colspan='5'>
			      PERSONALIZADOS
		      </td>
	      </tr>
	      <tr id='mostrar' class='"; $titulo_tipo3="'>
	        <td colspan='5'>
		        <input id='mostrar_button' value='&#8711; Mostrar Sin Existencia &#8711;' type='button'>
	        </td>
        </tr>
					    ";
      $existencia_tipo=$sin_exist;
      $total_imp=0;
      $total_cant=0;
      $registros_tipo="";
      $hay_sin_exist="oculto";
	    if(mysqli_num_rows($result)){
        	while($row = mysqli_fetch_array($result)){
          		$id=$row['id'];
          		$nombre=$row['nombre'];
          		$donativo=money_format("$%!i",$row['donativo']);
          		$cantidad=$row['cantidad'];
              $importe=$row['importe'];
              $total_cant=$row['total_cant'];
              $total_imp=$row['total_imp'];
              $desactivar="";
              if($cantidad=="0"){
                $desactivar=" disabled";
              }
              if($row["regalados"]){
                    $importe_reg=$row["importe_reg"];
                    $regalados=$row["regalados"];
			              $sumar3=substr($importe_reg,1);
			              $sumar3=floatval(str_replace(",","",$sumar3));
			              $total_importe2=$total_importe2+$sumar3;
			              $sumar4=intval($regalados);
			              $total_piezas2=$total_piezas2+$sumar4;
		                $lista_obsequiados=$lista_obsequiados."
                    <tr class='italica$oculto3' id='row4_$id'>
                      <td id='nombre4_$id'>$nombre</td>
                      <td id='tipo4_$id'>PERSONALIZADO</td>
                      <td id='donativo4_$id'>$donativo</td>
                      <td class='centrado' id='mas_menos4_$id'>
                      <input class='menos' id='menos4_$id' value='-' type='button'><input id='piezas4_$id' class='piezas_obs' value='$regalados' disabled><input class='mas' id='mas4_$id' value='+' type='button'$desactivar></td>
                      <td id='importe4_$id'>$importe_reg</td>
                    </tr>
	                ";
              }
              $existencia=$sin_exist;
              if($cantidad > 0){
                  $existencia="con_exist";
                  $existencia_tipo="con_exist";
                  $sin_existencia_general="oculto";
              }else{
                  if($filtrar!="0"){ $hay_sin_exist=""; }
              }
              $registros_tipo=$registros_tipo."
              <tr class='$existencia$oculto4' id='row2_$id'>
                <td id='nombre2_$id'><textarea id='textarea2_$id' class='textarea_per' rows='1'>$nombre</textarea></td>
                <td id='tipo2_$id'>PERSONALIZADO</td>
                <td id='donativo2_$id'>$donativo</td>
                <td class='centrado' id='mas_menos2_$id'><input id='guardar2_$id' class='guardar' value='Guardar' type='button' style='display:none;' disabled><input id='cancelar2_$id' class='cancelar' value='Cancelar' type='button' style='display:none;'><span id='mas_menos_span_$id'><input class='menos' id='menos2_$id' value='-' type='button' $desactivar><input id='piezas2_$id' class='piezas piezas_per' value='$cantidad' disabled><input class='mas' id='mas2_$id' value='+' type='button'></span></td>
                <td><input id='eliminar2_$id' class='eliminar' value='Eliminar' type='button' style='display:none;'><span id='importe2_$id'>$importe</span></td>
              </tr>";
          }
      }
      if($existencia_tipo!="con_exist"){
          $hay_sin_exist="oculto";
      }else{
          if(!$fun_avan_env){
                $change_fun_avan=1;
          }
      }
      echo "$titulo_tipo$oculto4 $existencia_tipo$titulo_tipo2$hay_sin_exist$oculto4$titulo_tipo3
$registros_tipo";
      echo "
      <tr class='espacial $existencia_tipo$oculto4' id='row2_new'>
        <td id='nombre2_new'><textarea id='textarea2_new' class='textarea_per' rows='1'></textarea></td>
        <td class='donativo_esp' colspan='2'><span class='dolar'>$</span> <input type='tel' id='donativo2_new' class='donativo_per'></td>
        <td class='centrado' id='mas_menos2_new'><input id='guardar2_new' class='guardar' value='Crear' type='button' style='display:none;' disabled><input id='cancelar2_new' class='cancelar' value='Cancelar' type='button' style='display:none;'><div class='blink'>&lt;--Crear Nuevo</div></td>
        <td><input id='eliminar2_new' class='eliminar' value='Eliminar' type='button' style='display:none;' disabled><span id='importe2_new'>$0.00</span></td>
      </tr>
";
      if($ordenar!="0"){
		    $total_imp=money_format("$%!i",$total_imp);
					    echo "
		    <tr id='totales_tipo_per' class='$existencia_tipo$oculto4'>
			    <td class='derecha' colspan='3'>Total</td>
			    <td class='centrado total_piezas' id='total_piezas_per'>$total_cant</td>
			    <td class='derecha' id='total_importe_per'>$total_imp</td>
		    </tr>
              ";
?>
<script type='text/javascript'>
  function asignar_per(){
		$('.piezas_per').change(function (e) {
			e.preventDefault();
			e.stopPropagation();
			total_piezas=0;
			total_importe=0;
			$('.piezas_per').each(function(){
				  sacar_valores($(this));
				  total_piezas=total_piezas+piezas_val;
				  total_importe=total_importe+importe_val;
			});
			$('#total_piezas_per').text(total_piezas);
			$('#total_importe_per').text(regresar_texto(total_importe));
		});
  }
  asignar_per()
</script>
<?php //php
      }
//  }
//    if($lista_obsequiados){
      $oculto="";
      if(!$lista_obsequiados){
          $oculto=" oculto";
      }else{
          $sin_existencia_general="oculto";
      }
	      echo "
        <tr id='letra_obs' class='letra_titulo italica$oculto$oculto3'>
		      <td class='letra' colspan='5'>
			        OBSEQUIADOS <button id='pasar_a_efectivo'>Enviar todo a efectivo >></button>
		      </td>
	      </tr>
";
        echo $lista_obsequiados;
		    if($ordenar!="0"){
        		$total_importe2=money_format("$%!i",$total_importe2);
            echo "
		            <tr class='italica$oculto$oculto3' id='totales_regalo'>
			            <td class='derecha' colspan='3'>Total</td>
			            <td class='centrado' id='total_obsequio'>$total_piezas2</td>
			            <td class='derecha' id='total_importe_obs'>$total_importe2</td>
		            </tr>
            ";
?>
<script type='text/javascript'>
//	$(document).ready(function() {
      function asignar_obs() {
		    $('.piezas_obs').change(function (e) {
			    e.preventDefault();
			    e.stopPropagation();
			    total_piezas=0;
			    total_importe=0;
			    $('.piezas_obs').each(function(){
				      sacar_valores($(this));
				      total_piezas=total_piezas+piezas_val;
				      total_importe=total_importe+importe_val;
			    });
			    $('#total_obsequio').text(total_piezas);
			    $('#total_importe_obs').text(regresar_texto(total_importe));
		    });
      }
      asignar_obs()
//	});
</script>
<?php //php
        }
//    }
	  $availableTags=substr($availableTags,0,-3);
	  $availableTags2=substr($availableTags2,0,-3);
/*
	  $query = "SELECT id, tipo, CONCAT('$', FORMAT(total, 2)) AS total FROM totales WHERE usuario=".$_SESSION['id'];
	  $result=correr_query($enlace, $query);
	  $gran_total="SIN DEFINIR";
	  $gran_total_id="";
	  $regalo="$0.00";
	  $regalo_id="";
	  while($row = mysqli_fetch_array($result)){
		  $tipo_query=intval($row["tipo"]);
		  switch ($tipo_query) {
		      case 0:
			  $gran_total=$row["total"];
			  $gran_total_id=$row["id"];
		          break;
		      case 1:
			  $regalo=$row["total"];
			  $regalo_id=$row["id"];
		          break;
		  }
	  }
    $fondo_total=$_POST["fondo_total_env"];
    $fondo_total=money_format("$%!i",$fondo_total);
	  $valores="'$fondo_total','$regalo'";
*/
	if($filtrar=="0"){
      $sin_existencia_general="oculto";
  }
  echo "
  <tr id='no_hay_exist' class='$sin_existencia_general'>
    <td colspan='5'>
        <span class='error2'>NO TIENES NINGÚNA PIEZA DE LAC EN EXISTENCIA:</span> Agrega alguna buscándola en las cajas de búsqueda o escoge “MOSTRAR LAC >> TODOS” en el cajón de herramientas para ver el catalogo completo y agregar alguna pieza a la existencia y ver algo aquí.
    </td>
  </tr>
";
?>
<script type='text/javascript'>
//  	$(document).ready(function() {
        autosize($('textarea'));
//    });
</script>
</tbody>
</table>
<?php //php
	$letras_html="";
	$cuenta=0;
	$voltear="";
	if($ordenar=="0"){
		$clase="letter";
		foreach ($letras as $letra) {
			$letras_html=$letras_html."<a id='letra_nav_$letra' class='".$existencias[$cuenta]."' href='#letra_$letra'><div class='$clase'>".$tipos_n[$cuenta]."</div></a>";
			$cuenta++;
		};
    $letras_html=$letras_html."<a href='javascript:void(0);' id='nav_per'><div class='$clase$oculto4'>P*</div></a>";
    $letras_html=$letras_html."<a href='#letra_obs' id='nav_obs' class='$oculto$oculto3'><div class='$clase'>O*</div></a>";
	}else{
		$clase="tipo";
		$voltear=" class='voltear'";
		foreach ($letras as $letra) {
			$letras_html="<a id='letra_nav_$letra' class='".$existencias[$cuenta]."' href='#letra_$letra'><div class='$clase'>".$tipos_n[$cuenta]."</div></a>".$letras_html;
			$cuenta++;
		};
    $letras_html="<a href='javascript:void(0);' id='nav_per'><div class='$clase$oculto4'>PERSONALIZADOS</div></a>".$letras_html;
    $letras_html="<a href='#letra_obs' id='nav_obs' class='$oculto$oculto3'><div class='$clase'>OBSEQUIADOS</div></a>".$letras_html;
	}
	$last_edited=filectime('../js/operaciones.js');
	echo "<script type='text/javascript' src='js/operaciones.js?$last_edited'></script>";
?>

<?php //php
	if($ordenar=="0"){
  	$letras_html="<div id='right_tape2'$voltear>$letras_html</div>";
  }else{
  	$letras_html="<div id='right_tape'$voltear>$letras_html</div>";
  }
?>
<script type="text/javascript">
  autocomplete_now()
  registro={}
<?php
	foreach ($registros as $clave => $valor){ echo "registro[$clave]=$valor;\r\n"; }
?>
//  $(document).ready(function(){
	    $("#menu").html("<?php echo $letras_html ?>");
//	    totales();
    var availableTags = [
<?php //PHP
	echo $availableTags;
?>
    ];
    var availableTags2 = [
<?php //PHP
	echo $availableTags2;
?>
    ];
	$("#tags").autocomplete('option', 'source',availableTags);
	$("#codigo").autocomplete('option', 'source',availableTags2);
<?php //php
  if($change_fun_avan or $lista_obsequiados){
?>
      $("#act_fun").trigger( "click" );
<?php //php
  }
?>
//  } );
</script>
