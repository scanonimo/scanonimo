<?php //PHP
	include 'restringido.php';
	include 'data_base_work.php';
  include 'sanitizar_cadenas.php';
	$usuario_id=$_SESSION['id'];
  depuracion($enlace);
	$usuario_id=$_SESSION['id'];
	$query = "UPDATE consulta SET eliminar_obs='0' WHERE usuario='$usuario_id'";
	correr_query($enlace, $query);
?>
