<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1">
  <title>Error de Jquery</title>
<?php //php
	$last_edited=filectime('css/login.css');
  echo "<link rel='stylesheet' href='css/login.css?$last_edited' type='text/css'>";
    $last_edited=filectime('css/error.css');
  echo "<link rel='stylesheet' href='css/error.css?$last_edited' type='text/css'>";
?>
</head><body>
  <fieldset> <legend>Error Fatal</legend>
      <p>Parece que tu navegador podría no ser compatible con jquery. Esto es inusual en navegadores modernos. Por favor intente usar Google Chrome o Firefox si le es posible, para poder utilizar este programa.</p>
      <p style="text-align: right;"><button id="boton3" type="button" onclick="window.location='index.php';">Cerrar</button></p>
  </fieldset>
</body></html>
