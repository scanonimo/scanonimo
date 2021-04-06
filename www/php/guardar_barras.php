<?php //PHP 
	include 'restringido.php';
	include 'data_base_work.php';
  include 'sanitizar_cadenas.php';
	$usuario_id=$_SESSION['id'];
  depuracion($enlace);
  $query = "UPDATE libros SET barras='".$_POST['barras_env']."' WHERE id='".$_POST['id_env']."'";
	correr_query($enlace, $query);
  echo "Guardado existoso.";
?>
