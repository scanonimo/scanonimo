<?php //PHP
  include 'data_base_work.php';
  session_start();
  if(isset($_POST["error_php"])){
        if(!isset($_SESSION['error'])){
              echo "4";
              exit();
        }
  }
  if(isset($_POST["azar"]) && isset($_SESSION['azar'])){
      $azar=entero($_POST["azar"]);
      if($azar != $_SESSION['azar']){
          echo "2";
          exit;
      }
  }else{
      echo "2";
      exit;
  }
  if(isset($_POST["reporte_de_error"])){
        if(!isset($_SESSION['usuario'])){
              $id="0";        
        }else{
              $id=$_SESSION['id'];        
        }
        $query="UPDATE usuarios SET last_msg = NOW() WHERE id = '$id'";
        correr_query($enlace, $query);
        unset($_POST["reporte_de_error"]);
  }
  include 'enviar_email.php';
?>
