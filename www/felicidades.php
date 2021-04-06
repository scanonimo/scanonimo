<?php //PHP
	include "php/loggin.php";
	$last_edited=filectime('css/login.css');
  echo "<link rel='stylesheet' href='css/login.css?$last_edited' type='text/css'>"
?>
  <link rel="stylesheet" href="lib/loading/css/jquery.loadingModal.css">
  <script src="lib/loading/js/jquery.loadingModal.js"></script>
  <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1">
  <title>Felicidades</title>
</head><body>
<form method="post" id="form" name="form" onsubmit="return continuar();">
<fieldset> <legend>Felicidades</legend>
<p>Su cuenta ha sido creada con éxito, pero hay algo que me gustaría mencionarte.</p>
<div style='text-align: right'><button id="omitir" type="button">Omitir y Empezar Ya >></button></div>
<p>Como el desarrollador de este programa, respeto mucho la privacidad de las personas y la de los grupos, por lo que no es necesario proporcionar ninguna información personal sensible para poder utilizar esta aplicación.</p>
<p>Sin embargo, existe cierta información que quizá puedas encontrar útil compartir. Esta información es la siguiente:</p>
<ol>
  <li>Correo electrónico para cambiar tu contraseña si en algún momento llegues a perderla.</li>
  <li>Un nombre de grupo para mostrar en los informes de secretario.</li>
</ol>
<p>Si deseas proporcionar esta información en este momento, puedes hacer clic en el botón que se muestra abajo, o bien, busca este mismo botón en la “Caja de Herramientas” de la aplicación.</p>
<div id="boton"><button onclick="window.location='perfil_de_usuario.php';"><img src="images/perfil.png"><div>MI PERFIL</div></button></div>
<p>Como mencione anteriormente, no esencial proporcionar esta información, pero es importante tenerlo en mente.</p>
<p>Si en algún momento llegas a perder tu contraseña, no se pierde demasiado, siempre y cuando imprimas cotidianamente tus informes, lo cual es una practica recomendada.</p>
<p>Por otro lado, también es posible recuperar el acceso si se tiene el nombre de usuario y la fecha en que se creo la cuenta, por lo que también se sugiere que se recuerde bien ese dato por si acaso.</p>
<p>Por otro lado, el nombre del grupo no necesita ser muy específico y seguro abra más de alguno con el mismo nombre en el país. Por supuesto, siempre se puede agregar el nombre antes de imprimir en la aplicación o después de imprimir con un lápiz o pluma.</p>
<div style='text-align: right'><button id="enterado" type="button">Enterado Gracias >></button></div>
</fieldset>
</form>
<script type="text/javascript">
    $("#omitir, #enterado").click(function() {
        window.location.href = 'index.php'
    })
</script>
</body></html>
