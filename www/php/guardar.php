<?php //PHP
	include 'restringido.php';
	include 'data_base_work.php';
  include 'sanitizar_cadenas.php';
	$usuario_id=$_SESSION['id'];
  $regalo="";
  $eliminar_obs=entero($_POST["eliminar_obs"]);
  if($eliminar_obs == "2"){
	      $query = "UPDATE consulta SET eliminar_obs='1' WHERE usuario='$usuario_id'";
	      correr_query($enlace, $query);
	      $query = "UPDATE inventario SET obsequiados='0' WHERE usuario='$usuario_id'";
	      correr_query($enlace, $query);
	      $query = "UPDATE libros_per SET regalados='0' WHERE usuario='$usuario_id'";
	      correr_query($enlace, $query);
  }
	if(isset($_POST["eliminar_total"])){
    	$query = "UPDATE consulta SET fondo_total=NULL WHERE usuario='$usuario_id'";
      correr_query($enlace, $query);
	}
	if(isset($_POST["eliminar_reg"])){
      $registro=entero($_POST["registro_env"]);
      $query = "DELETE FROM inventario WHERE id='$registro' AND usuario='$usuario_id'";
      correr_query($enlace, $query);
      echo "-1";
	}
	if( isset($_POST["piezas_env"]) and isset($_POST["id_env"]) and isset($_POST["registro_env"]) and !isset($_POST["eliminar_reg"] )) {
      $piezas=entero($_POST["piezas_env"]);
      $id=entero($_POST["id_env"]);
      $registro=entero($_POST["registro_env"]);
      if($_POST["number_two_env"]=="2" || $_POST["number_two_env"]=="4"){
          if(isset($_POST["regalo_env"])){
              $regalo=", regalados='".entero($_POST["regalo_env"])."'";
          }
          $query = "UPDATE libros_per SET cantidad='$piezas'$regalo WHERE id='$id' AND usuario='$usuario_id'";
          correr_query($enlace, $query);
      }else{
	          if($registro){
                if(isset($_POST["regalo_env"])){
                    $regalo=", obsequiados='".entero($_POST["regalo_env"])."'";
                }
		            $query = "UPDATE inventario SET piezas='$piezas'$regalo WHERE id='$registro' AND usuario='$usuario_id'";
		            correr_query($enlace, $query);
	          }else{
                $regalo=0;
                if(isset($_POST["regalo_env"])){
                      $regalo=$_POST["regalo_env"];
                }
		            $query = "DELETE FROM inventario WHERE libro='$id' AND usuario='$usuario_id'";
		            correr_query($enlace, $query);
		            $query = "INSERT INTO inventario VALUES (NULL,'$id','$piezas','$regalo','$usuario_id')";
		            correr_query($enlace, $query);
		            echo mysqli_insert_id($enlace);
	          }
      }
	}
	if(isset($_POST["gran_total_env"])){
		$gran_total=decimales($_POST["gran_total_env"]);
		$query = "UPDATE consulta SET fondo_total='$gran_total' WHERE usuario='$usuario_id'";
		correr_query($enlace, $query);
	}
?>
