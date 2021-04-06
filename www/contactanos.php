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
  <title>Contáctenos</title>
</head><body>
  <fieldset> <legend>Contáctenos</legend>
      <p>¿Que clase de mensaje deseas enviarnos?</p>
      <p><button type="button" class="boton99" onclick="window.location='hacer_contacto.php';">Hacer Contacto</button></p>
      <p><button type="button" class="boton99" onclick="window.location='reporte_de_error.php';">Reportar un Error</button></p>
      <p><button type="button" class="boton99" onclick="window.location='index.php';">Cancelar</button></p>
  </fieldset>
</body></html>
