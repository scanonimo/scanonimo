<?php //PHP
	include 'restringido.php';
	include 'data_base_work.php';
	$usuario_id=$_SESSION['id'];
	if(isset($_POST["eliminar_env"])){
        $_POST["eliminar_env"]=entero($_POST["eliminar_env"]);
		$query = "DELETE FROM totales WHERE id='".$_POST["eliminar_env"]."' AND usuario='$usuario_id'";
		correr_query($enlace, $query);
		exit;
	}
	$regalo_id=entero($_POST["regalo_id_env"]);
	$regalo=entero($_POST["regalo_env"]);
	$gran_total_id=entero($_POST["gran_total_id_env"]);
	$gran_total=decimales($_POST["gran_total_env"]);
	if($regalo_id!="" and $regalo=="0"){
		$query = "DELETE FROM totales WHERE id='$regalo_id' AND usuario='$usuario_id'";
		correr_query($enlace, $query);
		echo "-1,";
	}else{
		if(!($regalo_id=="" and $regalo=="0")){
			if($regalo_id){
				$query = "UPDATE totales SET total='$regalo' WHERE id='$regalo_id' AND usuario='$usuario_id'";
				correr_query($enlace, $query);
				echo $regalo_id.",";
			}else{
				$query = "DELETE FROM totales WHERE tipo='1' AND usuario='$usuario_id'";
				correr_query($enlace, $query);
				$query = "INSERT INTO totales VALUES (NULL,'$usuario_id','1','$regalo')";
				correr_query($enlace, $query);
				echo mysqli_insert_id($enlace).",";
			}
		}else{
			echo "-1,";
		}
	}
	if($gran_total_id){
		$query = "UPDATE totales SET total='$gran_total' WHERE id='$gran_total_id' AND usuario='$usuario_id'";
		correr_query($enlace, $query);
		echo $gran_total_id;
	}else{
		$query = "DELETE FROM totales WHERE tipo='0' AND usuario='$usuario_id'";
		correr_query($enlace, $query);
		$query = "INSERT INTO totales VALUES (NULL,'$usuario_id','0','$gran_total')";
		correr_query($enlace, $query);
		echo mysqli_insert_id($enlace);
	}
?>
