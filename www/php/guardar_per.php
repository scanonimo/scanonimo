<?php //PHP
	include 'restringido.php';
	include 'data_base_work.php';
  include 'sanitizar_cadenas.php';
	$usuario_id=$_SESSION['id'];
  if(isset($_POST["eliminar_obs"])){ 
      $eliminar_obs=entero($_POST["eliminar_obs"]);
      if($eliminar_obs == "2"){
	          $query = "UPDATE consulta SET eliminar_obs='1' WHERE usuario='$usuario_id'";
	          correr_query($enlace, $query);
	          $query = "UPDATE inventario SET obsequiados='0' WHERE usuario='$usuario_id'";
	          correr_query($enlace, $query);
	          $query = "UPDATE libros_per SET regalados='0' WHERE usuario='$usuario_id'";
	          correr_query($enlace, $query);
      }
  }
  if(isset($_POST["eliminar_env"])){
      $eliminar=entero($_POST["eliminar_env"]);
  		$query = "DELETE FROM libros_per WHERE id='$eliminar' AND usuario='$usuario_id'";
  }else{
      $nombre=strtoupper($_POST["nombre"]);
      if(isset($_POST["id_env"])){
          $id=entero($_POST["id_env"]);
          $query = "UPDATE libros_per SET nombre='$nombre' WHERE id='$id' AND usuario='$usuario_id'";
      }else{
          $query = "SELECT COUNT(*) AS contar FROM `libros_per` WHERE usuario = '$usuario_id'";
          $result =	correr_query($enlace, $query);
          $row = mysqli_fetch_array($result);
          if(intval($row['contar']) >= $max_personalizados){
              echo "NO MAS";
              exit;
          }
          $donativo=decimales($_POST["donativo"]);
    	    $query = "INSERT INTO libros_per VALUES (NULL,'$usuario_id','$nombre','$donativo','0','0')";
      }
  }
	correr_query($enlace, $query);
	echo "1|".mysqli_insert_id($enlace);
?>
