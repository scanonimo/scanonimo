<?php //PHP
  include 'data_base_work.php';
  $texto="";
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  }
  function new_question() {
        global $texto;
        $azar=rand(0, 2);
        if(isset($_SESSION['pregunta'])){
            while($_SESSION['pregunta'] == $azar){
                $azar=rand(0, 2);
            }
        }
        $_SESSION['pregunta']=$azar;
        $pregunta=$_SESSION['pregunta'];
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
  }
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
      new_question();
      echo "3;$texto";
      exit;
  }
  $azar=rand(0, 2);
  if(isset($_SESSION['pregunta'])){
      while($_SESSION['pregunta'] == $azar){
          $azar=rand(0, 2);
      }
  }
  $_SESSION['pregunta']=$azar;
  $nombre=substr(strtoupper(preg_replace("/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\,\:\¡\!\¿\?\-\.\ ]+/", "", $_POST["nombre"])),0,200);
  $fecha=substr(strtoupper(preg_replace("/[^0-9]\-/", "", $_POST["fecha"])),0,10);
  $query="SELECT * FROM usuarios WHERE nombre LIKE '$nombre' AND creado = '$fecha'";
  $result=correr_query($enlace, $query);
  $row=mysqli_fetch_array($result);
  if($row){
      $url = strtok($_SERVER["REQUEST_URI"], '/');
      $domain = $_SERVER['HTTP_HOST'];
      $azar=rand(100000, 999999);
      $place="https://$domain/$url/cambiar_clave.php?id=".$row["id"]."&clave=".$azar;
      $query="UPDATE usuarios SET recuperar = '$azar' WHERE id='".$row["id"]."'";
      correr_query($enlace, $query);
      echo "2;$place";
  }else{
      new_question();
      echo "1;$texto";
  }
?>
