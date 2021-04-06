<?php //php
  if(!isset($_POST["error_php"])){
        if(isset($_POST["alert"])){
              $_POST["alert"]=substr(preg_replace("/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\=\[\]\,\:\¡\!\¿\?\-\n\.\ ]+/", "", $_POST["alert"]),0,5000);
        }else{
              $_POST["alert"]="";
        }
  }else{
        $_POST["alert"]=$_SESSION['error'];
  }
  $informacion="";
  $contar=1;
  if(!isset($_POST["contacto"])){
        $browser_str = $_SERVER['HTTP_USER_AGENT'];
        $browser_str=depurar_cadena($browser_str,5000);
        $browser_str="Información del Navegador\n".$browser_str;
        $subject = 'Reporte de error';
  }else{
        $browser_str="";
        $subject = 'Contacto de Usuario: '.$_POST["asunto"];
        unset($_POST["contacto"]);
  }
  foreach ($_POST as $key => $value) {
        if($key != "azar" && $key != "alert" && $key != "respuesta"){
              if($key != "email" && $key != "telef"){
                    if($key != "nave"){
                        $_POST[$key]=depurar_cadena($_POST[$key],5000);
                    }else{
                        $_POST[$key]=depurar_cadena($_POST[$key],200);
                    }
              }else{
                    if($key != "email"){
                          $_POST[$key]=substr(preg_replace("/[^0-9() \-]+/", "", $_POST[$key]),0,200);
                    }else{
                          email_check($_POST[$key]);
                    }
              }
              $key_up=strtoupper($key);
              $informacion="$informacion$key_up: ".$_POST[$key]."\n";
        }
        if($contar>10){
            break;
        }else{
            $contar++;
        }
  }
  $domain = $_SERVER['HTTP_HOST'];
  $to = $email_error;
  $alert=$_POST["alert"];
  $message = "$informacion
$alert
$browser_str";
  $from = "no_responder@$domain";
  if(!mail($to, $subject, $message)){
        $query="INSERT INTO email_sin_enviar VALUES(NULL,'$message',now())";
        correr_query($enlace, $query);
  }
  $azar=rand(0, 2);
  if(isset($_SESSION['pregunta'])){
      while($_SESSION['pregunta'] == $azar){
          $azar=rand(0, 2);
      }
  }
  $_SESSION['pregunta']=$azar;
  echo "1";
?>
