<?php //php
	include 'restringido.php';
	include 'data_base_work.php';
	$usuario_id=$_SESSION['id'];
	$query="SELECT password, email FROM usuarios WHERE id='$usuario_id'";
	$result=correr_query($enlace, $query);
	$row=mysqli_fetch_array($result);
  if(! password_verify($_POST['clave'],$row['password'])){
      echo "1";
      exit;
  }
  echo "3";
  $_SESSION['acceso']=true;
?>
