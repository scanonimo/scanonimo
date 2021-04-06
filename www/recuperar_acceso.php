<?php //php
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
  <script type="text/javascript" src="lib/autosize.js"></script>
  <script type="text/javascript" src="js/toastr.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.js"></script>
  <script type="text/javascript" src="lib/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<?php //php
    $azar=rand(0, 2);
    if(isset($_SESSION['pregunta'])){
        while($_SESSION['pregunta'] == $azar){
            $azar=rand(0, 2);
        }
    }
    $_SESSION['pregunta']=$azar;
	$last_edited=filectime('css/login.css');
  echo "<link rel='stylesheet' href='css/login.css?$last_edited' type='text/css'>"
?>
  <link rel="stylesheet" href="lib/jquery-ui-1.12.1.custom/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="lib/loading/css/jquery.loadingModal.css">
  <script src="lib/loading/js/jquery.loadingModal.js"></script>
  <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1">
  <title>Recuperar Acceso</title>
</head><body>
<form method="post" id="recuperar" name="recuperar" onsubmit="return continuar();">
  <fieldset> <legend>Recuperar Acceso</legend>
      <div style="color: blue;" id="exito"></div>
      <div id="error2" class="error oculto">
          No pudimos encontrar el correo electrónico proporcionado en nuestra base de datos, 
          ¿esta seguro que ha proporciono esta información en su perfil? ¿eligió que cifráramos dicha información? <a href='javascript:void(0);' id="ver_mas1"  class="ver_mas">más info >></a>
          <span id="info" class="oculto">Si eligió cifrar su correo, es indispensable elegir la recuperación por nombre de usuario y posteriormente se le preguntare por su correo registrado. Si no eligió cifrar su correo, cerciórese que ha escrito su correo de forma correcta e inténtelo de nuevo. De otra forma, tendrá como única opción tratar de recuperar su acceso usando su nombre de usuario.</span>
      </div>
      <div id="error3" class="error"></div>
      <p style="text-align: right;">
      <button id="boton3" type="button" onclick="window.location='index.php';">Cerrar</button>
      </p>
      <div id="error8" class="error oculto">
            <p>El correo proporcionado es correcto, lamentablemente estamos experimentando problemas para enviarle un correo de recuperación. Por favor inténtelo de nuevo en un par de horas, y si el problema persiste después de 24 horas, por favor comunicante con notros para tratar de ayudarle. Gracias.</p>
      </div>
      <div id="error7" class="error oculto">
          El correo proporcionado no es igual al correo que proporcionaste en tu perfil.
          ¿Has escrito el correo correctamente? ¿habrías registrado algún otro de tus correos? <a href='javascript:void(0);' id="ver_mas5"  class="ver_mas">más info >></a>
          <span id="info5" class="oculto">Por desgracia, existe también la posibilidad de que haya cometido un error al escribir su correo en su perfil, en cuyo caso no nos sera posible ayudarlo a recobrar su acceso usando este método, por lo que le recomendamos crear un nuevo usuario y utilizar su ultimo informe de tesorero para vaciar la información.</span>
      </div>
      <div id="inicial">
            <p>
            <label for="nombre">Proporcione su nombre de usuario:</label><br>
            <input name="nombre" id="nombre" maxlength='200' type="text"><br>
            <button id="boton1" type="button">Usar nombre de usuario</button>
            <div id="error4" class="error"></div>
            </p>
            <p style="text-align: center">O</p>
            <p>
            <label for="email">Proporcione su correo eletronico:</label><br>
            <input name="email" class='email required' id="email" maxlength='200' type="text">
            <button id="boton2" type="submit">Usar correo electrónico</button>
            <div id="error1" class="error"></div>
            </p>
      </div>
      <div class="cifrado_fecha oculto">
            <p>Su usuario tiene dos opciones para recuperar su acceso, ambas se presentan a continuacion:</p>
      </div>
      <div id="cifrado" class="oculto">
            <p>
                  <label for="email2"><span class="cifrado_fecha oculto">1) </span>Proporcione su correo electrónico:</label>
                  <input name="email2" class='email required' id="email2" maxlength='200' type="text">
                  <button id="boton5" type="button">Recuperar Acceso</button>
            </p>
      </div>
      <div class="cifrado_fecha oculto">
            <p style="text-align: center">O</p>
      </div>
      <div id="segundo" class="oculto">
          <p>
              <span class="cifrado_fecha oculto">2) </span>Para recuperar su acceso es necesario que seleccione la fecha exacta en que creo su usuario. <a href='javascript:void(0);' id="ver_mas2"  class="ver_mas">más info >></a>
              <span id="info2" class="oculto">Si no recuerda la fecha exacta, le recomendamos crear un usuario nuevo y utilizar un reporte de tesorero para vaciar la información, de lo contrario intente varias veces hasta encontrar la fecha correcta de creación.</span>
          </p>
          <p>
              <label for="fecha">Fecha de creación:</label><br>
              <input name="fecha" id="fecha" readonly="readonly" type="text">
              <div id="error6" class="error"></div>
          </p>
          <p>
              <span id="pregunta">
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
            </span>
            <input name="respuesta" id="respuesta" maxlength="3">
            <div id="error5" class="error"></div>
            </p>
            <p>
                    <button id="boton4" type="button">Recuperar Acceso</button>
            </p>
      </div>
  </fieldset>
</form>
<?php //php
	$last_edited=filectime('js/recuperar_acceso.js');
    echo "<script type='text/javascript' src='js/recuperar_acceso.js?$last_edited'></script>";
?>
</body></html>
