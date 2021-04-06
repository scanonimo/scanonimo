<?php //PHP
	include 'restringido.php';
	include 'data_base_work.php';
	$usuario_id=$_SESSION['id'];
  depuracion($enlace);
  if(isset($_POST['pulso_env'])){
    	$query = "UPDATE consulta SET pulso='".entero($_POST['pulso_env'])."' WHERE usuario='$usuario_id'";
  }else{
      if(isset($_POST['ocultar_obs_env'])){
          	$query = "UPDATE consulta SET ocultar_obs='".entero($_POST['ocultar_obs_env'])."' WHERE usuario='$usuario_id'";
      }else{
          	$query = "UPDATE consulta SET fun_avan='".entero($_POST['fun_avan'])."' WHERE usuario='$usuario_id'";
      }
  }
	correr_query($enlace, $query);
	echo "1";
?>
