<?php // php
	include 'data_base_work.php';
  session_start();
  if(!isset($_SESSION['pregunta'])){
  		echo "Error";
  		exit;
  }
  $nombre=substr(strtoupper(preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['nombre'])),0,200);
  if($_POST['nombre']=="RESERVADO"){
      if($_POST['nuevo_env']){
          echo "2";
      }else{
          echo "3";
      }
      exit;
  }
	$query="SELECT * FROM usuarios WHERE nombre = '$nombre'";
	$result=correr_query($enlace, $query);
	$row=mysqli_fetch_array($result);
  $_POST['nuevo_env']=es_numerico($_POST['nuevo_env']);
  if($_POST['nuevo_env']){
	    if($row){
          echo "2";
      }else{
          $respuesta=substr(strtoupper(preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['respuesta_env'])),0,3);
          $pregunta=$_SESSION['pregunta'];
          $acertado=0;
          switch ($pregunta) {
              case 0:
                  if($respuesta == "OMS"){ $acertado=1; };
                  break;
              case 1:
                  if($respuesta == "OSG"){ $acertado=1; };
                  break;
              case 2:
                  if($respuesta == "REC"){ $acertado=1; };
                  break;
          }
          if(! $acertado){
              echo "1";
              exit;
          }
          $azar=rand(0, 2);
          if(isset($_SESSION['pregunta'])){
              while($_SESSION['pregunta'] == $azar){
                  $azar=rand(0, 2);
              }
          }
          $_SESSION['pregunta']=$azar;
          $clave=password_hash($_POST['password'], PASSWORD_DEFAULT);
          $query="INSERT INTO usuarios VALUES (NULL, '$nombre', '$clave', 1, '', '',curdate(),curdate(),'0','0','2020-01-01 00:00:00')";
        	correr_query($enlace, $query);
	        $_SESSION['id']=mysqli_insert_id($enlace);
	        $_SESSION['usuario']=$nombre;
	        $_SESSION['tipo']="1";
	        echo "correcto";
      }
  }else{
	    if($row){
          if(! password_verify($_POST['password'],$row['password'])){
              echo "3";
          }else{
		          if($row['tipo']=="1"){
			            $_SESSION['id']=$row['id'];
			            $_SESSION['usuario']=$row['nombre'];
			            $_SESSION['tipo']=$row['tipo'];
                	$query = "UPDATE usuarios SET accedido=curdate(), recuperar='0' WHERE id='".$row['id']."'";
                	correr_query($enlace, $query);
			            echo "correcto";
		          }else{
			          echo "4";
		          }
          }
	    }else{
		    echo "5";
	    };
  }
?>
