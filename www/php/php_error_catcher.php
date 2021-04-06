<?php //php
    function customError($error_level,$error_message,$error_file,$error_line,$error_context){
/*
          if($error_level != "E_USER_ERROR"){
              return;
          }
*/
          if(!isset($_SESSION)) 
          { 
              session_start(); 
          }
          include 'data_base_work.php';
          $query="SELECT NOW() AS sql_time";
          $result=correr_query($enlace, $query);
          $row=mysqli_fetch_array($result);
          $sql_time=$row["sql_time"];
          $sql_time = strtotime($sql_time);
          $alert = "Error Encontrado
Mensaje de error: $error_message
En el Archivo: '$error_file' en la linea $error_line";
          $alert = substr(preg_replace("/[^a-zA-Zá-úÁ-Ú0-9\/\*\(\)\=\[\]\,\:\¡\!\¿\?\-\n\.\ ]+/", "", $alert),0,5000);
          $_SESSION['error']=$alert;
          $browser_str = $_SERVER['HTTP_USER_AGENT'];
          $browser_str = substr(preg_replace("/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\=\[\]\,\:\¡\!\¿\?\-\n\.\ ]+/", "", $browser_str),0,5000);
          $domain = $_SERVER['HTTP_HOST'];
          $to = $email_error;
          $subject = 'Reporte de error';
          $message = "$alert
Información del Navegador
$browser_str";
          $message = substr(preg_replace("/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\=\[\]\,\:\¡\!\¿\?\-\n\.\ ]+/", "", $message),0,5000);
          $message = mysqli_real_escape_string($enlace, $message);
          if(!isset($_SESSION['usuario'])){
              $id="0";
              $query="SELECT last_msg FROM usuarios WHERE id = '$id'";
              $result=correr_query($enlace, $query);
              $row=mysqli_fetch_array($result);
              if($row){
                    $tiempo = strtotime($row["last_msg"]);
              }else{
                    $query="INSERT INTO usuarios VALUES ('$id', 'RESERVADO', '', 1, '', '',NULL,NULL,'0','0',now())";
                    correr_query($enlace, $query);
                    $tiempo = $sql_time;
              }
              $comparar=1;
          }else{
              $id=$_SESSION['id'];
              $query="SELECT last_msg FROM usuarios WHERE id = '$id'";
              $result=correr_query($enlace, $query);
              $row=mysqli_fetch_array($result);
              $tiempo = strtotime($row["last_msg"]);
              $comparar=12;
          }
          $horas=($sql_time-$tiempo)/3600;
          if($horas>$comparar){
                $query="UPDATE usuarios SET last_msg = NOW() WHERE id = '$id'";
                correr_query($enlace, $query);
                $domain = $_SERVER['HTTP_HOST'];
                $subject = 'Reporte de error';
                $from = "no_responder@$domain";
                $to = $email_error;
                if(!mail($to, $subject, $message)){
                    $query="INSERT INTO email_sin_enviar VALUES (NULL,'$message',now())";
                    correr_query($enlace, $query);
                }
                $azar=rand(100000, 999999);
                $_SESSION['azar']=$azar;
                if(error_reporting() == "32767" || error_reporting() == "E_ALL" || $debugging_mode){
                      if(strpos($alert, "\r")){
                          $alert=str_replace("\r","<br>",$alert);
                      }else{
                          $alert=str_replace("\n","<br>",$alert);
                      }
                      echo "$alert";
                      echo ". |$azar|<script type='text/javascript'>setTimeout(function(){ location.href = 'error_php.php?azar=$azar'; },5000);</script>";
                }else{
                      echo "Error Fatal";
                      echo ". |$azar|<script type='text/javascript'>location.href = 'error_php.php?azar=$azar';</script>";
                }
                die();
          }
          if(error_reporting() == "32767" || error_reporting() == "E_ALL" || $debugging_mode){
                echo "$alert";
                echo ". ||<script type='text/javascript'>setTimeout(function(){ location.href = 'error_php.php'; },5000);</script>";
          }else{
                echo "Error Fatal";          
                echo ". ||<script type='text/javascript'>location.href = 'error_php.php';</script>";
          }
          die();
    }
    set_error_handler('customError');
?>
