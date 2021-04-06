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
  <title>Donaciones</title>
</head><body>
  <fieldset> <legend>Hacer una donación</legend>
<p>Muchas gracias por tu <strong>inertes</strong> y <strong>generosidad</strong>.</p>
<p>La cuenta para realizar sus donaciones estan a nombre de <strong>Ariel Del Valle Lozano</strong>, por lo que es recomendable que tenga en cuenta este <strong>nombre</strong> para asegurar que esta depositando a la <strong>cuenta correcta</strong>.</p>
<p>Favor de realizar sus aportaciones <strong>no mayores</strong> a $ 15,000.00 pesos a la siguiente cuenta de <strong>BanCoppel</strong> desde cualquier tienda <strong>Coppel</strong> o <strong>OXXO</strong> (NOTA: OXXO cobra una comisión de 15 pesos):</p>
<p><strong>No de cuenta:</strong> 10408933370</p>
<p>También es posible realizar una <strong>transferencia</strong> utilizando la siguiente clave <strong>interbancaria:</strong></p>
<p><strong>Clave:</strong> 137744104089333700</p>
<p>Por ultimo, es posible realizar sus donaciones por <strong>paypal</strong> utilizando la siguiente liga</p>
<p><a href="https://paypal.me/scanonimo?locale.x=es_XC">https://paypal.me/scanonimo</a></p>
<p>Sus aportaciones me ayudaran a pagar el <strong>hospedaje</strong> y el <strong>dominio</strong> scanonimo.com , pues de otra manera deberé <strong>cerrar el sitio</strong> después de un año.</p>
<p>Actualmente estoy <strong>desempleado</strong>, y me encantaría poder continuar haciendo <strong>programas</strong> para la hermandad. Tengo un montón de ideas para programas que pudieran ayudar a los <strong>servidores</strong> en los <strong>grupos</strong> y en las <strong>áreas</strong>, por ejemplo el siguiente programa pudiera ayudar a <strong>tesoreros</strong>, y hay muchas funciones adicionales que me encantaría programar para <strong>secretarios</strong>.</p>
<p>Seria <strong>maravilloso</strong> que las <strong>áreas</strong> o la <strong>OSG</strong> me contrataran. Si usted le interesa alguna <strong>función adicional</strong> en particular, contácteme y quizá podemos llegar a una suma.</p>
<p>Muchas gracias por su <strong>generosidad</strong>. Saludos.</p>
      <button class="btlong" id="contactar" type="button" onclick="window.location='contactanos.php';">Contáctenos</button>
      <button type="button" class="btlong" onclick="window.location='index.php';">Regresar</button>
  </fieldset>
</body></html>
