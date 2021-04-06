<?php //PHP
  include 'data_base_work.php';
  include 'sanitizar_cadenas.php';
  include 'depurar_html.php';
  $_POST["nombre"]=substr(strtoupper(preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['nombre'])),0,200);
  $nombre=$_POST["nombre"];
  $query="SELECT * FROM usuarios WHERE nombre = '$nombre'";
  $result=correr_query($enlace, $query);
  $row=mysqli_fetch_array($result);
  if($row){
        if($row['email']) {
            if(filter_var($row['email'], FILTER_VALIDATE_EMAIL)){
                  $usuaio=$row["nombre"];
                  $email=$row["email"];
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
                      mail("$email", $titulo_mensaje, $mensaje, $opciones);
                      $query="UPDATE usuarios SET recuperar = '$azar' WHERE id='".$row["id"]."'";
                      correr_query($enlace, $query);
                      $parts = explode("@",$email); 
                      $username = $parts[0];
                      $username = substr($username, 0, 3);
                      $domain_name = $parts[1];
                      $email_back = $username."*****@$domain_name";
                      if($row['solo_este']) {
                            echo "2,";
                      }else{
                            echo "3,";
                      }
                      echo $email_back;
            }else{
                    if($row['solo_este']) {
                          echo "5,";
                    }else{
                          echo "6,";
                    }
            }
        }else{
                echo "4,";
        }
  }else{
      echo "1,";
  }
?>
