<?php //PHP
  include 'data_base_work.php';
  $email=strtolower($_POST["email"]);
  email_check($email);
  $recuperame=0;
  if(isset($_POST["nombre"])){
      $nombre=substr(strtoupper(preg_replace("/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\,\:\¡\!\¿\?\-\.\ ]+/", "", $_POST["nombre"])),0,200);
	    $query="SELECT * FROM usuarios WHERE nombre = '$nombre'";
	    $result=correr_query($enlace, $query);
	    $row=mysqli_fetch_array($result);
      if($row){
          if(password_verify($_POST['email'],$row['email'])){
                $recuperame=1;
          }
      }
  }else{
      $query="SELECT * FROM usuarios WHERE email='$email'";
      $result=correr_query($enlace, $query);
      $row=mysqli_fetch_array($result);
      if($row){
            $recuperame=1;
      }
  }
  if($recuperame){
            $usuaio=$row["nombre"];
            $url = strtok($_SERVER["REQUEST_URI"], '/');
            $domain = $_SERVER['HTTP_HOST'];
            $azar=rand(100000, 999999);
            $place="https://$domain/$url/cambiar_clave.php?id=".$row["id"]."&clave=".$azar;
            $titulo_mensaje="Recuperar Acceso";
            $mensaje="
    <html> <head> <title> $titulo_mensaje </title> </head>
    <body>
        <p>Saludos:</p>
        <p>Ha recibido esto correo porque alguien ha solicitado recuperar el acceso del usuario '$usuaio' al sitio '$domain'.</p>
        <p>Para recuperar el acceso simplemente utilice el siguiente enlace donde podra crear una contraseña nueva.</p>
        <p><a href='$place'>$place</a></p>
        <p>Si usted no a solicitado este cambio de contraseña, puede ignorar este correo.</p>
        <p>El correo no_responder@$domain no es supervisado, por lo que mensajes enviados allí seran ignorados.</p>
</body></html>
            ";
        $opciones = "From: no_responder@$domain\r\n";
        $opciones .= "MIME-Version: 1.0\r\n";
        $opciones .="Content-type: text/html; charset=UTF-8\r\n";
        if(mail("$email", $titulo_mensaje, $mensaje, $opciones)){
              $query="UPDATE usuarios SET recuperar = '$azar' WHERE id='".$row["id"]."'";
              correr_query($enlace, $query);
              echo "2";
        }else{
              echo "3";
        }
  }else{
      echo "1";
  }
?>
