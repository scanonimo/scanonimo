<?php //PHP
  include 'data_base_work.php';
  session_start();
  if(isset($_POST["error_php"])){
        if(!isset($_SESSION['error'])){
              echo "4";
              exit();
        }
  }
  if(!isset($_SESSION['pregunta'])){
        $azar=rand(0, 2);
        $_SESSION['pregunta']=$azar;
        switch ($pregunta) {
            case 0:
                $texto="Escriba las iniciales de las oficinas de Al-Anon a nivel mundial:";
                break;
            case 1:
                $texto="Escriba las iniciales de las oficinas de Al-Anon en México:";
                break;
            case 2:
                $texto="Las tres primeras letras de los legados en el triangulo de Al-Anon son (UNI)dad, (SER)vicio y por ultimo:";
                break;
        }
        echo "2|$texto";
        exit;
  }
  $respuesta=substr(strtoupper(preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['respuesta'])),0,3);
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
      echo "3";
      exit;
  }
  if(isset($_POST["reporte_de_error"])){
        unset($_POST["reporte_de_error"]);
  }
  include 'enviar_email.php';
?>
