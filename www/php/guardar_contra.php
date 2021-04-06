<?php //PHP
	include 'restringido.php';
  if(!isset($_SESSION['acceso'])){
      echo "Error";
      exit;
  }
	include 'data_base_work.php';
	$usuario_id=$_SESSION['id'];
/*
	$query="SELECT password FROM usuarios WHERE id='$usuario_id'";
	$result=correr_query($enlace, $query);
	$row=mysqli_fetch_array($result);
    if(! password_verify($_POST['actual2'],$row['password'])){
        echo "1";
        exit;
    }
*/
    $clave=password_hash($_POST['nueva'], PASSWORD_DEFAULT);
    $query="UPDATE usuarios SET password='$clave' WHERE id='$usuario_id'";
    correr_query($enlace, $query);
    echo "2";
?>
