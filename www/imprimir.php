<?php //php
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <title>Imprimir</title>
<!--  <link rel="stylesheet" href="css/login.css" type="text/css">-->
  <link rel="stylesheet" href="css/imprimir.css" type="text/css">
  <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.js"></script>
</head><body>
<div class="no-print"><button onclick="window.location='index.php';">&lt;&lt; Regresar</button><button onclick="window.print();">Imprimir &gt;&gt;</button></div>
<?php //PHP
	include "php/loggin.php";
	include 'php/data_base_work.php';
	$usuario_id=$_SESSION['id'];
	$query="SELECT * FROM usuarios WHERE id=$usuario_id";
	$result=correr_query($enlace, $query);
	$row=mysqli_fetch_array($result);
	$grupo=$row["grupo"];
	$query="SELECT * FROM consulta WHERE usuario=$usuario_id";
	$result=correr_query($enlace, $query);
	$row=mysqli_fetch_array($result);
  include 'php/consulta.php';
  include 'php/eliminar_obs.php';
  $col_span=4;
  $lista_de_obs="";
  if(isset($_GET["ordenar_env"])){
	    $ordenar=$_GET["ordenar_env"];
	    $filtrar="0";
      if($ordenar == "1"){
          $col_span=3;
      }
  }else{
	    $ordenar="1";
	    $filtrar="1";
  }
	if($ordenar=="0"){
		$ordenar_por="para_ordenar";
	}else{
		$ordenar_por="libros.tipo, para_ordenar";
	}
	if($filtrar=="0"){
		$existencia="LEFT";
	}else{
		$existencia="INNER";
	}
	$query = "SELECT
  CASE 
      WHEN libros.nombre REGEXP '^[a-z]' = 1 THEN libros.nombre 
      WHEN libros.nombre REGEXP '^[^a-z]{3}' = 1 THEN SUBSTR(libros.nombre, 4)
      WHEN libros.nombre REGEXP '^[^a-z]{2}' = 1 THEN SUBSTR(libros.nombre, 3)
      ELSE SUBSTR(libros.nombre, 2)
  END AS para_ordenar, libros.id, libros.codigo, UPPER(libros.nombre) AS nombre, libros.tipo AS tipo_id, tipo.nombre AS tipo, CONCAT('$', FORMAT(libros.donativo, 2)) AS donativo, inventario.piezas, CONCAT('$', FORMAT(libros.donativo * inventario.piezas,2)) AS importe, inventario.id AS registro, inventario.obsequiados, CONCAT('$', FORMAT(libros.donativo * inventario.obsequiados,2)) AS importe_obs FROM libros ".$existencia." JOIN (SELECT * FROM inventario WHERE usuario='".$_SESSION['id']."') AS inventario ON libros.id=inventario.libro INNER JOIN tipo ON libros.tipo=tipo.id ORDER BY $ordenar_por";
	$result=correr_query($enlace, $query);
//	$query = "UPDATE consulta SET filtrar='$filtrar', ordenar='$ordenar' WHERE usuario='$usuario_id'";
//	correr_query($enlace, $query);
  setlocale(LC_ALL, $locale);
  if($filtrar == "1"){
?>
          <div class='espacio' style="text-align: center">
              <span>
                    INFORME DE SECRETARIO<br>
                    LITERATURA PARA VENTA EN EL GRUPO
              </span><br>
              (<?php echo strftime("%d de %B del %Y"); ?>)<br>
              <span>GRUPO:</span> <input name="nombre" id="nombre" value="<?php echo $grupo; ?>" maxlength='200'> 
<?php //php
          if($grupo){
                echo "<button id='guardar' class='no-print' onclick='window.location=\"perfil_de_usuario.php\";'>Cambiar Nombre &gt;&gt;</button>";
          }else{
?>
                <button id="guardar" class="no-print" onclick="window.location='perfil_de_usuario.php';">Guardar Un Nombre &gt;&gt;</button>
<?php //php
          }
?>
          </div>
<?php //php
  }else{
      if($ordenar == "0"){
          echo "<div class='espacio'><span>- LISTA DE PRECIOS LAC -</span><br>(Alphabetiamente)</div>";
      }else{
          echo "<div class='espacio'><span>- LISTA DE PRECIOS LAC -</span><br>(Ordenada por Tipo)</div>";
      }
  }
?>
<?php if($filtrar == "1"){ ?> <div class="espacio"> <?php }else{ echo "<div class='espacio2'>"; } ?>
<?php if($ordenar == "0"){ echo "<table class='ord_letras'>"; }else{ ?>
<table>
<?php } ?>
  <tbody>
    <tr class="col_head">
      <td>NOMBRE</td>
<?php if($ordenar == "0"){ ?>       <td>TIPO</td> <?php } ?>
<?php if($filtrar == "0"){ ?>       <td>CANTIDAD</td> <?php } ?>
      <td>PRECIO</td>
<?php if($filtrar == "1"){ ?>       <td>CANTIDAD</td> <?php } ?>
<?php if($filtrar == "1"){ ?>      <td>TOTAL</td> <?php } ?>
    </tr>
<?php //PHP
	$antes="";
	$cuenta=0;
	$total_importe=0;
	$total_piezas=0;
	$gran_total_importe=0;
	$gran_total_piezas=0;
	$gran_total_importe_obs=0;
  $total_cant_obs=0;
  $total_imp_obs=0;
	$gran_total_piezas_obs=0;
  $libros="";
  $titulo="";
	while($row = mysqli_fetch_array($result)){
		$id=$row['id'];
		$codigo=$row['codigo'];
		$nombre=$row['nombre'];
    $para_ordenar=$row['para_ordenar'];
		$tipo=$row['tipo'];
		$tipo_id=$row['tipo_id'];
		$donativo=$row['donativo'];
		if($row['piezas']){
			$piezas=$row['piezas'];
			$importe=$row['importe'];
		}else{
			$importe="$0.00";
			$piezas="0";
		}
		if($row['obsequiados']){
			$piezas_obs=$row['obsequiados'];
			$importe_obs=$row['importe_obs'];
		}else{
			$importe_obs="$0.00";
			$piezas_obs="0";
		}
    if($piezas!="0" || $filtrar == "0"){
		      $sin_comillas=addslashes($nombre);
		      $sin_comillas2=addslashes($codigo);
		      if($ordenar!="0"){
			      $sumar=substr($importe,1);
			      $sumar=floatval(str_replace(",","",$sumar));
			      $total_importe=$total_importe+$sumar;
            $gran_total_importe=$gran_total_importe+$sumar;
			      $sumar2=intval($piezas);
			      $total_piezas=$total_piezas+$sumar2;
            $gran_total_piezas=$gran_total_piezas+$sumar2;
			      $ahora=$tipo_id;
			      if($antes!=$ahora){
				      if($cuenta!=0){
					      $total_importe=$total_importe-$sumar;
					      $total_piezas=$total_piezas-$sumar2;
					      setlocale(LC_MONETARY, $locale);
					      $total_importe=money_format("$%!i",$total_importe);
                if($libros != ""){
                      echo "$titulo\n";
                      echo "$libros\n";
                      if($filtrar == "1"){ 
                					echo "
		                      <tr class='totales'>
                            <td></td>
			                      <td>Total:</td>
			                      <td>$total_piezas</td>
			                      <td>$total_importe</td>
		                      </tr>
                        </tbody>
                      </table>
                      </div>
                      <div class='espacio'>
                      <table>
                        <tbody>
                      ";
                    }
                    $libros="";
                }
              }
				      $total_importe=$sumar;
				      $total_piezas=$sumar2;
		        }
					      $titulo="
		      <tr>
			      <td class='letra' colspan='$col_span'>
				      $tipo
			      </td>
		      </tr>
					      ";
					      $antes=$ahora;
					      $letras[$cuenta]=$tipo_id;
					      $tipos_n[$cuenta]=$tipo;
					      $cuenta++;
		      }else{
			      $ahora="- ".$para_ordenar[0]." -";
			      if(preg_match("/[a-z]/i", $ahora)){
				      if($antes!=$ahora){
                echo "$titulo\n";
                echo "$libros\n";
                $libros="";
					      $titulo="
		      <tr>
			      <td class='letra' colspan='$col_span'>
				      $ahora
			      </td>
		      </tr>
					      ";
					      $antes=$ahora;
					      $letras[$cuenta]=$ahora;
					      $tipos_n[$cuenta]=$ahora;
					      $cuenta++;
				      }
			      }
		      }
		      $libros=$libros."
          <tr>
              <td>$nombre &#91;$codigo&#93;</td>\n";
          if($ordenar == "0"){
        		$libros=$libros."<td>$tipo</td>\n";
          }
          if($filtrar == "1"){
              $libros=$libros."<td>$donativo</td>";
              $libros=$libros."<td>$piezas</td>";
          }else{
              $libros=$libros."<td></td>";
              $libros=$libros."<td>$donativo</td>";
          }
          if($filtrar == "1"){ 
              $libros=$libros."
              <td>$importe</td>";
          }
          $libros=$libros."
          </tr>
	      ";
    }
    if($piezas_obs != "0" && $filtrar == "1"){
		      $sumar=substr($importe_obs,1);
		      $sumar=floatval(str_replace(",","",$sumar));
          $gran_total_importe_obs=$gran_total_importe_obs+$sumar;
		      $sumar2=intval($piezas_obs);
          $gran_total_piezas_obs=$gran_total_piezas_obs+$sumar2;
          $lista_de_obs=$lista_de_obs."
          <tr>
              <td>$nombre &#91;$codigo&#93;</td>
              <td>$tipo</td>
              <td>$donativo</td>
              <td>$piezas_obs</td>
              <td>$importe_obs</td>
          </tr>
";
    }
	}
    echo "$titulo\n";
    echo "$libros\n";
    $libros="";
    $titulo="";
		setlocale(LC_MONETARY, $locale);
		$total_importe=money_format("$%!i",$total_importe);
    if($filtrar == "1"){ 
					echo "
		<tr class='totales'>
      <td></td>
			<td>Total:</td>
			<td>$total_piezas</td>
			<td>$total_importe</td>
		</tr>
  </tbody>
</table>
</div>
<div class='espacio'>
<table>
  <tbody>
";
	              $titulo="<tr>
		              <td class='letra' colspan='4'>
			              PERSONALIZADOS
		              </td>
	              </tr>
                ";
                $libros="";
                $query = "SELECT id, UPPER(nombre) as nombre, CONCAT('$', FORMAT(libros_per.donativo, 2)) AS donativo, cantidad, CONCAT('$', FORMAT(libros_per.donativo * cantidad,2)) AS importe, total_cant, total_imp, total_cant_obs, total_imp_obs, regalados, CONCAT('$', FORMAT(libros_per.donativo * regalados,2)) AS importe_obs FROM `libros_per`, (SELECT SUM(cantidad) AS total_cant, SUM(regalados) AS total_cant_obs, SUM(donativo * cantidad) AS total_imp, FORMAT(SUM(donativo * regalados),2) AS total_imp_obs FROM libros_per WHERE usuario = '$usuario_id') AS totales WHERE usuario = '$usuario_id'";
                $result=correr_query($enlace, $query);
                if(mysqli_num_rows($result)){
                  	while($row = mysqli_fetch_array($result)){
                    		$id=$row['id'];
                    		$nombre=$row['nombre'];
                    		$donativo=$row['donativo'];
                    		$cantidad=$row['cantidad'];
                        $importe=$row['importe'];
                        $total_cant=$row['total_cant'];
                        $total_imp=$row['total_imp'];
                        $piezas_obs=$row['regalados'];
                        $importe_obs=$row['importe_obs'];
                        $total_cant_obs=$row['total_cant_obs'];
                        $total_imp_obs=$row['total_imp_obs'];
                        if($cantidad != "0"){
                                $libros=$libros."
                                <tr>
                                  <td>$nombre</td>
                                  <td>$donativo</td>
                                  <td>$cantidad</td>
                                  <td>$importe</td>
                                </tr>";
                        }
                        if($piezas_obs != "0"){
                                $lista_de_obs=$lista_de_obs."
                                <tr>
                                    <td>$nombre</td>
                                    <td>PERSONALIZADO</td>
                                    <td>$donativo</td>
                                    <td>$piezas_obs</td>
                                    <td>$importe_obs</td>
                                </tr>
                                ";
                        }
                    }
                }
                if($libros != ""){
                        echo "$titulo
                        $libros
                        ";
		                    $total_imp=money_format("$%!i",$total_imp);
					                    echo "
		                    <tr class='totales'>
                          <td></td>
			                    <td>Total:</td>
			                    <td>$total_cant</td>
			                    <td>$total_imp</td>
		                    </tr>
                        ";
                }
// if(false){
      if($lista_de_obs!=""){
            echo "</tbody>
            </table>
            </div>
            <div class='espacio'>
            <table class='obsequios_tabla'>
              <tbody>
                <tr class='col_head'>
		              <td>NOMBRE</td>
		              <td>TIPO</td>
		              <td>PRECIO</td>
		              <td>CANTIDAD</td>
		              <td>TOTAL</td>
	              </tr>
                <tr>
		              <td class='letra' colspan='5'>
			              OBSEQUIADOS
		              </td>
	              </tr>
            $lista_de_obs
            ";
            $gran_total_importe_obs=$gran_total_importe_obs+$total_imp_obs;
		        $sumar2=intval($total_cant_obs);
            $gran_total_piezas_obs=$gran_total_piezas_obs+$sumar2;
            $gran_total_importe_obs_text=money_format("$%!i",$gran_total_importe_obs);
            echo "
            <tr class='totales'>
              <td colspan='2'></td>
              <td>Total:</td>
              <td>$gran_total_piezas_obs</td>
              <td>$gran_total_importe_obs_text</td>
            </tr>
            ";            
      }
//}
      $gran_total_importe_obs=money_format("$%!i",$gran_total_importe_obs);
	    $query = "SELECT CONCAT('$', FORMAT(fondo_total, 2)) AS total FROM consulta WHERE usuario=".$_SESSION['id'];
	    $result=correr_query($enlace, $query);
	    $regalo="$0.00";
      $row = mysqli_fetch_array($result);
			$gran_total=$row["total"];
      if(is_null($gran_total)){
    	    $gran_total="SIN DEFINIR";
      }
      if($filtrar == "1"){
          if(isset($total_cant)){ $gran_total_piezas=$gran_total_piezas+$total_cant; }
          if(isset($total_imp)){ 
	            $sumar_1=substr($total_imp,1);
	            $sumar_1=floatval(str_replace(",","",$sumar_1));
              $gran_total_importe=$gran_total_importe+$sumar_1;
          }
	        $sumar_1=substr($gran_total,1);
	        $sumar_1=floatval(str_replace(",","",$sumar_1));
	        $sumar_2=substr($gran_total_importe_obs,1);
	        $sumar_2=floatval(str_replace(",","",$sumar_2));
          $dinero_total="SIN DEFINIR";
          if($gran_total!="SIN DEFINIR"){
              $dinero_total=$sumar_1-$sumar_2-$gran_total_importe;
	            $dinero_total=money_format("$%!i",$dinero_total);
          }
	        $gran_total_importe=money_format("$%!i",$gran_total_importe);
      }
  }
?>
  </tbody>
</table>
</div>
<?php //php
    if($filtrar == "1"){ 
?>
<div class='espacio'>
<table class="gran">
  <tbody>
    <tr>
        <td class="titulo" colspan='3'>TOTALES</td>
    </tr>
    <tr>
        <td colspan='2'>Literatura (<?php echo "$gran_total_piezas" ?>)</td>
        <td><?php echo "$gran_total_importe" ?></td>
    </tr>
    <tr>
        <td colspan='2'>Dinero</td>
        <td><?php echo "$dinero_total" ?></td>
    </tr>
    <tr>
        <td colspan='2'>Obsequiado</td>
        <td><?php echo "$gran_total_importe_obs" ?></td>
    </tr>
    <tr>
        <td></td>
        <td>Gran Total:</td>
        <td><?php echo "$gran_total" ?></td>
    </tr>
  </tbody>
</table>
</div>
<?php //php
    }
?>
<div class='espacio'></div>
</body></html>
