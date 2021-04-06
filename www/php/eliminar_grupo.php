<?php //PHP
	include 'restringido.php';
	include 'data_base_work.php';
	$usuario_id=$_SESSION['id'];
	$query="UPDATE usuarios SET grupo='' WHERE id='$usuario_id'";
	$result=correr_query($enlace, $query);
  echo "1";
?>
