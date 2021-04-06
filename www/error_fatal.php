<?php //php
  if(!isset($_POST["alerta"])){
      header("Location: index.php");
      die();
  }
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
  <script type="text/javascript" src="js/toastr.js"></script>
  <script type="text/javascript" src="js/jquery.validate.js"></script>
  <link rel="stylesheet" href="lib/loading/css/jquery.loadingModal.css">
  <script src="lib/loading/js/jquery.loadingModal.js"></script>
  <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1">
<?php //php
	$last_edited=filectime('css/login.css');
  echo "<link rel='stylesheet' href='css/login.css?$last_edited' type='text/css'>";
    $last_edited=filectime('css/error.css');
  echo "<link rel='stylesheet' href='css/error.css?$last_edited' type='text/css'>";
?>
  <title>Error Fatal</title>
</head><body>
  <fieldset> <legend>Error Fatal</legend>
    <form id="error_form" onsubmit="return false;">
        <p id="error3" class="error"></p>
<?php //php
  include 'php/data_base_work.php';
  $query="SELECT NOW() AS sql_time";
  $result=correr_query($enlace, $query);
  $row=mysqli_fetch_array($result);
  $sql_time=$row["sql_time"];
  $sql_time = strtotime($sql_time);
  $azar=rand(0, 2);
  if(isset($_SESSION['pregunta'])){
      while($_SESSION['pregunta'] == $azar){
          $azar=rand(0, 2);
      }
  }
  $_SESSION['pregunta']=$azar;
  if(!isset($_SESSION['usuario'])){
      $id="0";
      echo "<input name='usuario' id='usuario' value='Anonimo' type='hidden'>";
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
      echo "<input name='usuario' id='usuario' value='$id' type='hidden'>";
      $query="SELECT last_msg FROM usuarios WHERE id = '$id'";
      $result=correr_query($enlace, $query);
      $row=mysqli_fetch_array($result);
      $tiempo = strtotime($row["last_msg"]);
      $comparar=12;
  }
  $horas=($sql_time-$tiempo)/3600;
  $alert=substr(preg_replace("/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\=\[\]\,\:\¡\!\¿\?\-\n\.\ ]+/", "", $_POST["alerta"]),0,5000);
  $permitido=0;
  if($horas>$comparar){
        $query="UPDATE usuarios SET last_msg = NOW() WHERE id = '$id'";
        correr_query($enlace, $query);
        $browser_str = $_SERVER['HTTP_USER_AGENT'];
        $browser_str=depurar_cadena($browser_str,5000);
        $domain = $_SERVER['HTTP_HOST'];
        $to = $email_error;
        $subject = 'Reporte de error';
        $message = "$alert
Información del Navegador
$browser_str";
        $from = "no_responder@$domain";
        if(!mail($to, $subject, $message)){
            $query="INSERT INTO email_sin_enviar VALUES (NULL,'$message',now())";
            correr_query($enlace, $query);
        }
        $azar=rand(100000, 999999);
        $_SESSION['azar']=$azar;
        echo "<input name='azar' id='azar' value='$azar' type='hidden'>\n";
        $permitido=1;
  }
        echo "<input name='alert' id='alert' value='$alert' type='hidden'>\n";
?>
  <div id="primero">
          <p>Se a topado con error inesperado.</p>
          <p>Normalmente esto significa que nuestro programa no ha sido probado en el navegador que esta utilizando y pudiera no ser compatible, por lo que le recomendamos que intente utilizar <strong>firefox</strong> o <strong>chrome</strong> en su lugar si le es posible.</p>
          <p>No somos perfecto, por eso también es posible que haya encontrado un error que hemos pasado por alto.</p>
<?php //php
  if($permitido){
          $email_text="Correo Electrónico";
          $telef_text="Numero de Celular";
?>
          <p>Información anónima sobre el error y su navegador ha sido enviada al desarrollador para intentar solucionarlo.</p>
          <p>Si desea contribuir a solucionar el problema o ser notificado cuando el problema sea resuelto, por favor llene la siguiente formulario y presione enviar para ponernos en contacto con usted:</p>
<?php //php
  }else{
          $email_text="Correo Electrónico (Opcional)";
          $telef_text="Numero de Celular (Opcional)";
?>
          <p id="coment2">Para enviar información anónima que nos ayudaría a encontrar solución al problema simplemente responda la pregunta que se muestra a continuación.</p>
      <div id="personal" class="oculto">
<?php //php
  }
?>
          <p><input name="email" id="email" class="sin_def" value="<?php echo $email_text; ?>" maxlength='200' type="text"></p>
          <p>
                <input name="telef" id="telef" class="sin_def" value="<?php echo $telef_text; ?>" maxlength='200' type="text">
                <div id="error2" class="error"></div>
          </p>
          <p><input name="nave" id="nave" class="sin_def" value="Navegador utilizando (Opcional)" maxlength='200' type="text"></p>
          <p><textarea name="explicacion" id="explicacion" class="sin_def" rows="3">¿Que intentabas hacer cuando ocurrió el problema? (Opcional)</textarea></p>
          <p><textarea name="comentario" id="comentario" class="sin_def">Comentarios extras (Opcional)</textarea></p>
<?php //php
  if($permitido){
?>
          <p class="enviar"><button id="enviar" type="button" onclick="continuar();" disabled>Enviar</button> <button type="button" onclick="window.location='index.php';">Cancelar</button></p>
<?php //php
  }else{
?>
        </div>
<?php //php
  }
?>
  </div>
        <div id="exitoso" class="oculto">
              <p>Muchas gracias por su confianza. Le contactaremos tan pronto tengamos alguna idea sobre el problema. Hasta pronto.</p>
              <p><button id="boton3" type="button" onclick="window.location='index.php';">Cerrar</button></p>
        </div>
    </form>
<?php //php
  if($permitido){
?>
        <div id="preguntar" class="oculto">
<?php //php
  }else{
        echo "<div id='preguntar'>\n";
  }
?>
                <p id="error5" class="error"></p>
<?php //php
  if($permitido){
?>
                <p id="coment1">Por favor conteste la siguiente pregunta para enviar su información.</p>
<?php //php
  }
?>
                <p><span id="pregunta" style="font-weight: bold;">
<?php //php
                      $pregunta=$_SESSION['pregunta'];
                      switch ($pregunta) {
                          case 0:
                              echo "Escriba las iniciales de las oficinas de Al-Anon a nivel mundial:";
                              break;
                          case 1:
                              echo "Escriba las iniciales de las oficinas de Al-Anon en México:";
                              break;
                          case 2:
                              echo "Las tres primeras letras de los legados en el triangulo de Al-Anon son (UNI)dad, (SER)vicio y por ultimo:";
                              break;
                      }
?>
                </span></p>
                <p><input name="respuesta" id="respuesta" value="Respuesta" class="sin_def" maxlength="3"><div id="error4" class="error"></div></p>
                <p><button id="boton1" type="button">Responder</button></p>
                <p><button id="boton2" type="button">Cambiar Pregunta</button></p>
<?php //php
  if(!$permitido){
?>                
                <p><button id="boton4" class="boton99" type="button">&#8711; Agregar más info &#8711;</button></p>
                <p>Si desea contribuir a solucionar el problema o ser notificado cuando el problema sea resuelto, presione el botón “Agregar más info” de arriba para proporcionar información adicional que podría ayudarnos.</p>
                <p><button onclick="window.location='index.php';" class="boton99" type="button">Cancelar</button></p>
<?php //php
  }
?>
        </div>
<script type="text/javascript">
  do_it=false
<?php //php
  if($permitido){
?>
      do_it=true
<?php //php
  }
?>
</script>
<?php //php
	$last_edited=filectime('js/error_fatal.js');
    echo "<script type='text/javascript' src='js/error_fatal.js?$last_edited'></script>";
?>
  </fieldset>
</body></html>
