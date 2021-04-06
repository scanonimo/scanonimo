<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
  <script type="text/javascript" src="lib/autosize.js"></script>
  <script type="text/javascript" src="js/toastr.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.js"></script>
  <link rel="stylesheet" href="lib/loading/css/jquery.loadingModal.css">
<?php //php
  $last_edited=filectime('css/login.css');
  echo "<link rel='stylesheet' href='css/login.css?$last_edited' type='text/css'>";
?>
  <script src="lib/loading/js/jquery.loadingModal.js"></script>
  <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1">
  <title>Recuperar Acceso</title>
</head><body>
<form method="post" id="contra" name="contra" onsubmit="return continuar();">
  <fieldset> <legend>Recuperar Acceso</legend>
  <div id="error4" class="error"></div>
  <div style="color: blue;" class="oculto" id="exito">
      Su contraseña ha sido cambiada exitosamente.
      <p style="text-align: right;">
          <button id="boton3" type="button" onclick="window.location='index.php';">Cerrar</button>
      </p>
  </div>
<?php //php
  include 'php/data_base_work.php';
  include 'php/sanitizar_cadenas.php';
  include 'php/depurar_html.php';
  depuracion($enlace);
  $corrento=1;
  if(!isset($_GET["id"]) or !isset($_GET["clave"])) {
        $corrento=0;
  }else{
        $id=entero($_GET["id"]);
        $clave=entero($_GET["clave"]);
        $query="SELECT * FROM usuarios WHERE id='$id' AND recuperar='$clave' AND recuperar!='0'";
        $result=correr_query($enlace, $query);
        $row=mysqli_fetch_array($result);
        if(!$row){
            $corrento=0;
        }
        $nombre=strtoupper($row["nombre"]);
  }
  if($corrento){
      echo "<input name='id' id='id' value='$id' type='hidden'>\n";
      echo "<input name='clave' id='clave' value='$clave' type='hidden'>\n";
?>
  <div id="contenido">
      <p>
            Ingresa una contraseña nueva para tu usuario: <?php echo $nombre; ?>
      </p>
      <p>
          <label for="nueva">Contraseña Nueva:</label><br>
          <input name="nueva" id="nueva" value="" maxlength='200' class="contra" type="password">
      </p>
      <p>
          <label for="nueva2">Escribela de nuevo:</label><br>
          <input name="nueva2" id="nueva2" value="" maxlength='200' class="contra" type="password">
          <div id="error6" class="error"></div>
      </p>
      <p class="botones">
          <button id="guardar2" type="submit" disabled>Guardar</button> <button type="button" onclick="window.location='index.php';">Cancelar</button>
      </p>
  </div>
<?php //php
	$last_edited=filectime('js/cambiar_clave.js');
    echo "<script type='text/javascript' src='js/cambiar_clave.js?$last_edited'></script>";
?>
<?php //php
  }else{
?>
  <div class="error">La liga que esta tratando de usar ya no es validad. Por favor intente recuperar su acceso de nuevo. Gracias.</div>
  <p style="text-align: right;">
      <button id="boton3" type="button" onclick="window.location='recuperar_acceso.php';">Cerrar</button>
  </p>
<?php //php
  }
?>
  </fieldset>
</form>
</body></html>
