<?php //php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
    if (is_file('../php/php_error_catcher.php')){
          include '../php/php_error_catcher.php';
    }else{
          if (is_file('php/php_error_catcher.php')){
                include 'php/php_error_catcher.php';
          }else{
                include 'php_error_catcher.php';
          }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<script type="text/javascript">
    ya_hay_error=0
    function error_probocado(){
          try {
              $('body').append($('<form/>')
                .attr({'action': 'error_fatal.php', 'method': 'post', 'id': 'replacer'})
                .append($('<input/>')
                  .attr({'type': 'hidden', 'name': 'alerta', 'value': alerta})
                )
              ).find('#replacer').submit();
          } catch (error) {
              alert(error);
              window.location='recuperar_acceso.php';
          }
    }
    window.onerror = function (msg, url, line, columnNo, error) {
        if(ya_hay_error==0){
              ya_hay_error=1
              alerta="Error fatal.\nUbicacion: "+url+"\nMensaje de Error: "+msg+"\nEn la linea:"+line+"\nEn la Columna:"+columnNo+"\nMás info:"+error;
              alert(alerta)
              setTimeout(function(){ error_probocado(), 2000})
        }
    }
</script>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
  <link rel="stylesheet" href="lib/loading/css/jquery.loadingModal.css">
  <script src="lib/loading/js/jquery.loadingModal.js"></script>
  <script type="text/javascript" src="lib/autosize.js"></script>
  <script type="text/javascript" src="js/toastr.js"></script>
<script type="text/javascript">
	toastr.options = {
	  "closeButton": false,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": false,
	  "positionClass": "toast-bottom-center",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
</script>
  <link rel="stylesheet" href="css/toastr.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.js"></script>
<?php //php
  if (is_file('../var/data_base_info.php'))
  {
    	include '../var/data_base_info.php';
  }else{
    	include 'var/data_base_info.php';
  }
if(!isset($_SESSION['usuario'])){
	$usuario="";
	$tipo="-1";
}else{
	$usuario=$_SESSION['usuario'];
	$tipo=$_SESSION['tipo'];
      $usuario_id=$_SESSION['id'];
}
if($usuario=="" or $tipo!="1"){
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
  <link rel="stylesheet" href="lib/loading/css/jquery.loadingModal.css">
  <script src="lib/loading/js/jquery.loadingModal.js"></script>
  <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1">
  <title>Inicia sesión</title>
</head><body>
<noscript>
    <style type="text/css">
        #logginform {display:none;}
        table {display:none;}
    </style>
    <div class="noscriptmsg">
        <fieldset> <legend>Error Fatal</legend>
              <p>Parece que tu navegador tiene el <strong>javascript deshabilitado</strong> o simplemente no lo soporta.</p>
              <p><strong>Esto es inusual</strong> por defecto. Recomendamos intente utilizar una instalación limpia de Mozilla Firefox, Google Chrome o cualquier otro navegador <strong>con compatibilidad con javascript</strong> para poder utilizar este programa.</p>
              <p>Quisiera mencionar, que tanto el código <strong>javascript</strong> en el lado del usuario como como el <strong>php</strong> del lado del servidor son <strong>100% software libre</strong>, por lo que pueden ser auditado en todo momento, de manera que se pueda descartar que exista algún código mal intencionado oculto en este programa.</p>
              <p>Por favor <strong>visita la siguiente liga</strong> si deseas leer, estudiar, aprender de, y/o auditar nuestro código que es 100% compatible con la licencia GPL de software libre.</p>
              <p><a href='<?php echo "$codigo"; ?>'><?php echo "$codigo"; ?></a></p>
        </fieldset>
    </div>
</noscript>
<?php //php
	if(!empty($_GET)){
?>
		<form name="data" class="cmxform" id="data" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
<?php //php
    foreach ($_GET as $result_nme => $result_val) {
			echo "<input name='$result_nme' type='hidden' value='$result_val'>";
		}
		echo "</form>";
	}else{
		if(!empty($_POST)){
?>
		<form name="data" class="cmxform" id="data" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
<?php //php
      foreach ($_POST as $result_nme => $result_val) {
        if(is_string($result_nme) && is_string($result_val)){
      				echo "<input name='$result_nme' type='hidden' value='$result_val'>";
        }
			}
			echo "</form>";
		}
	}
?>
<form method="post" id="logginform" name="logginform" onsubmit="return continuar();">
  <fieldset> <legend>Inicia sesión</legend>
  <p id="error3" style="color: red;"><?php if($tipo=="0"){ echo "No Tiene perisos suficiente para entrar a esta sección."; }?> </p>
  <p><label for="usuario">Nombre de Usuario:</label><br>
  <?php if(isset($_GET["usuario"])){ echo "<input name='usuario' id='usuario' class='required' maxlength='200' value=".$_GET["usuario"].">"; }else{ ?><input name="usuario" maxlength='200' id="usuario" class="required"><?php } ?></p>
  <p> <label for="password">Contraseña:</label><br>
  <?php if(isset($_GET["password"])){ echo "<input name='password' id='password' class='required' maxlength='200' type='password' value=".$_GET["password"].">"; }else{ ?><input name="password" maxlength="200" id="password" class="required" type="password"><?php } ?></p>
  <div id="crear" class="oculto">
  <p> <label for="again">Escribela de nuevo:</label><br>
  <input name="again" id="again" type="password"><span id="error1" class="error"></span>
  </p>
  <p><input name="entiendo" id="entiendo" type="checkbox"> Entiendo que este programa y su desarrollar no son oficiales, <a href='javascript:void(0);' id="ver_mas">más info >></a><span id="mas_info" class="oculto">por lo que su calidad y funcionamiento no deben ser atribuidos negativamente la OSG, la OSM o la hermandad en general. Este programa es ofrecido sin ninguna garantía y bajo la licencia GPL. <a href='javascript:void(0);' id="ver_menos">&#60;&#60; menos info</a></span><div id="error2" class="error"></div>
  </p>
  <p>
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
  <input name="respuesta" id="respuesta" maxlength="3"><span id="error4" class="error"></span>
  </p>
  </div>
  <button id="entrar" class="entrar" name="entrar" type="submit">Entrar</button><button id="crear_boton" class="entrar oculto" name="crear_boton" type="submit">Crear</button> <button class="crear_nuevo" id="crear_nuevo" type="button">Registrarse &gt;&gt;</button><button class="crear_nuevo oculto" id="cancelar" type="button">Cancelar</button>
  <button id="olvido" type="button" onclick="window.location='recuperar_acceso.php';">¿Olvido su contraseña?</button>
  <button id="contactar" type="button" onclick="window.location='contactanos.php';">Contáctenos</button>
  <button type="button" class="btlong" onclick="window.location='acerca_de.php';">Acerca de nosotros</button>
  <button type="button" class="btlong" onclick="window.location='acerca_de.php';">Tutorial</button>
  </fieldset>
</form>
<script type="text/javascript">
  lugar_actual="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"
</script>
<?php //php
	$last_edited=filectime('js/loggin.js');
    echo "<script type='text/javascript' src='js/loggin.js?$last_edited'></script>";
?>
</body></html>
<?php //php
exit;
}
?>
