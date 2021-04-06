<?php //php
  session_start();
  include 'php/data_base_work.php';
  if(!isset($_SESSION['error'])){
      header("Location: index.php");
      die();
  }
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
        <div id="error6" class="oculto">
                <p>Lamentablemente el tiempo para enviar la información se ha agotado. Si aun desea enviarnos información sobre el error, por favor intente recrear el problema de nuevo o simplemente envíenos un comentario en el botón de “Contáctenos” que puede encontrarse al iniciar sesión o en el botón “Acerca de” en la caja de herramientas, con una descripción detallada de como podemos replicarlo. Gracias.</p>
                <p style="text-align: right"><button type="button" onclick="window.location='index.php';">Cerrar</button></p>
        </div>
        <p id="error3" class="error"></p>
  <div id="primero">
          <input name='error_php' id='error_php' value='1' type='hidden'>
          <p>Parece que ha encontrado un <strong>error fatal</strong> en nuestro código.</p>
<?php //php
  if(!isset($_SESSION['usuario'])){
      echo "<input name='usuario' id='usuario' value='Anonimo' type='hidden'>";
  }else{
      echo "<input name='usuario' id='usuario' value='".$_SESSION['usuario']."' type='hidden'>";
  }
  $permitido=1;
  if(isset($_GET["azar"]) && isset($_SESSION['azar'])){
        $azar=entero($_GET["azar"]);
        if($azar != $_SESSION['azar']){
            $permitido=0;
        }else{
            echo "<input name='azar' id='azar' value='$azar' type='hidden'>";
        }
  }else{
        $permitido=0;
  }
  $azar=rand(0, 2);
  if(isset($_SESSION['pregunta'])){
      while($_SESSION['pregunta'] == $azar){
          $azar=rand(0, 2);
      }
  }
  $_SESSION['pregunta']=$azar;
  if($permitido){
          $email_text="Correo Electrónico";
          $telef_text="Numero de Celular";
?>
          <p><strong>Información anónima</strong> sobre el error y su navegador ha sido enviada al desarrollador para intentar solucionarlo.</p>
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
