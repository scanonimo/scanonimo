<?php //PHP
	include 'restringido.php';
	include 'data_base_work.php';
	$usuario_id=$_SESSION['id'];
	$query = "UPDATE consulta SET eliminar_obs='2' WHERE usuario='$usuario_id'";
	correr_query($enlace, $query);
	echo "1";
?>
