<?php //php
	$query="SELECT * FROM consulta WHERE usuario=$usuario_id";
	$result=correr_query($enlace, $query);
	$row=mysqli_fetch_array($result);
	if($row){
		$ordenar=$row["ordenar"];
    $ordenar_dos=$row["ordenar_dos"];
		$filtrar=$row["filtrar"];
    $pulso=$row["pulso"];
    $fondo_total=$row["fondo_total"];
    $eliminar_obs=$row["eliminar_obs"];
    $ocultar_obs=$row["ocultar_obs"];
    $fun_avan=$row["fun_avan"];
    if($fondo_total != ""){ 
        setlocale(LC_MONETARY, $locale);
        $fondo_total=money_format("$%!i",$fondo_total);
    }else{
        $fondo_total="SIN DEFINIR";
    }
	}else{
		$query="INSERT INTO consulta VALUES ('$usuario_id','1','0','0',NULL,0,1,0,0)";
		correr_query($enlace, $query);
		$ordenar="1";
    $ordenar_dos=0;
		$filtrar="0";
    $pulso="0";
    $ocultar_obs="0";
    $eliminar_obs=0;
    $fun_avan=0;
    $fondo_total="SIN DEFINIR";
	}
?>
