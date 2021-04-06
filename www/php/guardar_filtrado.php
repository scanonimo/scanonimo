<?php //PHP
	include 'restringido.php';
	include 'data_base_work.php';
	$usuario_id=$_SESSION['id'];
	$query = "UPDATE consulta SET filtrar='".entero($_POST['filtrar_env'])."' WHERE usuario='$usuario_id'";
	correr_query($enlace, $query);
?>
