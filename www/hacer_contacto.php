<?php //php
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
  $permitido=0;
?>
  <title>Mensaje de Contacto</title>
</head><body>
  <fieldset> <legend>Mensaje de Contacto</legend>
    <div id="primero">
        <form id="error_form" onsubmit="return false;">
            <p id="error3" class="error"></p>
<?php //php
  if($horas>$comparar){
        $azar=rand(100000, 999999);
        $_SESSION['azar']=$azar;
        echo "<input name='azar' id='azar' value='$azar' type='hidden'>\n";
        $permitido=1;
  }
?>
              <input name='contacto' id='contacto' value='contacto' type='hidden'>
              <input name='reporte_de_error' id='reporte_de_error' value='reporte_de_error' type='hidden'>
              <p>Por favor <strong>llene y envié</strong> el siguiente formulario para <strong>ponerse en contacto</strong> con nosotros.</p>
              <p><input name="email" id="email" class="sin_def" value="Correo Electrónico" maxlength='200' type="text"></p>
              <p>
                    <input name="telef" id="telef" class="sin_def" value="Numero de Celular" maxlength='200' type="text">
                    <div id="error2" class="error"></div>
              </p>
              <p><input name="asunto" id="asunto" class="sin_def" value="Asunto por el que nos escribes" maxlength='200' type="text"><div id="error6" class="error"></div></p>
              <p><textarea name="mensaje" id="mensaje" class="sin_def" rows="3">Escribe tu mensaje aquí</textarea><div id="error7" class="error"></div></p>
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
                <p><button id="boton1" type="button">Responder y enviar</button></p>
                <p><button id="boton2" type="button">Cambiar Pregunta</button></p>
                <p><button type="button" class="boton99" onclick="window.location='index.php';">Cancelar</button></p>
        </div>
<?php //php
  if($permitido){
?>
          <p class="enviar"><button id="enviar" type="button" onclick="continuar();" disabled>Enviar</button> <button type="button" onclick="window.location='index.php';">Cancelar</button></p>
<?php //php
  }
?>
    </div>
        <div id="exitoso" class="oculto">
              <p>Agradecemos su contacto. Si es pertinente, nos pondremos en contacto con usted muy pronto. Saludos.</p>
              <p><button id="boton3" type="button" onclick="window.location='index.php';">Cerrar</button></p>
        </div>
  </fieldset>
<script type="text/javascript">
  do_it=true
  mensaje_de_contacto=true
</script>
<?php //php
	$last_edited=filectime('js/error_fatal.js');
    echo "<script type='text/javascript' src='js/error_fatal.js?$last_edited'></script>";
?>
</body></html>
