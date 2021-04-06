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
  if (is_file('../var/data_base_info.php'))
  {
    	include '../var/data_base_info.php';
  }else{
    	include 'var/data_base_info.php';
  }
?>
  <title>Acerca de Nosotros</title>
</head><body>
  <fieldset> <legend>Acerca de Nosotros</legend>
      <p><strong>Gracias por su interés</strong> en este programa. <img class="logo" src="images/favicon.png"></p>
      <p>Este programa es ofrecido sin ningún tipo de garantía bajo la <strong>licencia GNU <img class="logo" src="images/gnu.png">  de software libre</strong>, por lo que puede ser estudiado, modificado y compartido <strong>libremente</strong>. Si esta interesado en <strong>estudiar y/o auditar</strong> nuestro código <strong>visite la siguiente liga</strong>:</p>
      <p><a href='<?php echo "$codigo"; ?>'><?php echo "$codigo"; ?></a></p>
      <p>Este programa fue desarrollado por un miembro activo de Al-Anon quien prefiere <strong>permanece en el anonimato</strong>, bajo el seudónimo de <strong>“secretario anónimo”</strong>. <img class="logo" src="images/secre.png"></p>
      <p><strong>Si desea contactarnos</strong>, por presione el siguiente botón:</p>
      <button type="button" class="btlong" onclick="window.location='contactanos.php';">Contáctenos</button>
      <button type="button" class="btlong" onclick="window.location='donaciones.php';">Donaciones</button>
      <button type="button" class="btlong" onclick="window.location='index.php';">Regresar</button>
  </fieldset>
</body></html>
