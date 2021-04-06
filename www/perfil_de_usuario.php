<?php //PHP
	include "php/loggin.php";
	include 'php/data_base_work.php';
	$last_edited=filectime('css/login.css');
  echo "<link rel='stylesheet' href='css/login.css?$last_edited' type='text/css'>";
?>
  <script type="text/javascript" src="js/jquery.validate.js"></script>
  <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1">
  <title>Perfil de Usuario</title>
</head><body>
<?php //php
  if(!isset($_SESSION['acceso'])){
?>
<form method="get" id="pass" name="pass" onsubmit="return continuar();">
  <fieldset> <legend>Contraseña Actual</legend>
      <p>
          <label for="clave">Por favor proporcione su contraseña para poder entrar a esta sección:</label><br>
      </p>
      <p>
          <input name="clave" id="clave" class="required" autocomplete="off" type="password">
          <div id="error1" class="error"></div>
      </p>
      <p class="botones">
          <button id="entrar" type="submit">Entrar</button> <button type="button" onclick="window.location='index.php';">Cancelar</button>
      </p>
  </fieldset>
</form>
<?php //php
	      $last_edited=filectime('js/perfil_entrar.js');
          echo "<script type='text/javascript' src='js/perfil_entrar.js?$last_edited'></script>";
  }else{

  $id=$_SESSION['id'];
	$query="SELECT * FROM usuarios WHERE id='$id'";
	$result=correr_query($enlace, $query);
	$row=mysqli_fetch_array($result);
  $nombre=$row['nombre'];
  $nombre=strtoupper($nombre);
  $creado=$row['creado'];
  $email=$row['email'];
  $cifrado="0";
  if($email != "" && ! filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email="CIFRADO";
        $cifrado="1";
  }
  $grupo=$row['grupo'];
  $solo_este=$row['solo_este'];
?>
<fieldset id="exito">
  <button id="cerrar" class="cancelar" onclick="window.location='index.php';">Cerrar</button>
  <b>Usuario:</b> <?php echo $nombre; ?>
  <div><b>Fecha de Creación:</b> <?php echo $creado; ?></div>
</fieldset>
<form method="post" id="info" name="info" onsubmit="return continuar();">
<fieldset> <legend>Información Personal</legend>
  <p id="error4" class="error"></p>
  <p>
      <label for="email">Correo Electrónico:</label><br>
      <?php //php
          if($email){ 
                if(!$cifrado){
                      echo "<input name='email' id='email' class='required' value='$email' maxlength='200' type='text'>"; 
                }else{
                      echo "<input name='email' id='email' class='sin_def cifrado required' value='Cifrado (Cambiar)' maxlength='200' type='text'>";
                }
          }else{ 
?>
                <input name="email" id="email" class="sin_def required" value="(Opcional)" maxlength='200' type="text">
<?php //php
          } 
?>
      <div id="error8" class="error"></div>
      <?php if($email){ echo "<button id='borrar1' class='borrar' type='button'>Borrar</button>"; }else{ ?><button id="borrar1" class="borrar oculto" type="button">Borrar</button><?php } ?>
      <a href='javascript:void(0);' id="ver_mas1" class="ver_mas">más info >></a>
      <span id="mas_info1"  class="oculto">
          En caso de que pierda su contraseña, le enviaremos un mensaje a este correo para que pueda retomar el acceso.
          <a href='javascript:void(0);' id="ver_menos1" class="ver_menos">&#60;&#60; menos info</a>
      </span>
  </p>
  <div id="email2_div" style="display:none;">
      <label for="email2">Reescriba su correo:</label><br>
      <input name="email2" id="email2" class="" value="" maxlength='200' type="text">
      <div id="error9" class="error"></div>
  </div>
  <p> 
<?php //php
      if($email){
            $checado="";
            if($solo_este){ $checado=" checked"; }
            echo "<input name='solo_este' id='solo_este' type='checkbox'$checado>
                      <span id='solo_este_txt'>"; 
            
      }else{ 
?>
            <input name="solo_este" id="solo_este" type="checkbox" disabled>
              <span id="solo_este_txt" style="opacity: 0.3">
<?php 
      }
?>
          Establecer como única opción para recuperar acceso.
          <a href='javascript:void(0);' id="ver_mas2"  class="ver_mas oculto">más info >></a>
          <span id="mas_info2"  class="oculto">
                Si llegase a perder su contraseña es posible recuperar su acceso mediante dos métodos. Uno es proporcionando su correo electrónico para enviarle un enlace, y el otro es proporcionar su nombre de usuario y fecha en que se creó. Debido a que este ultima opción pudiese ser adivinada, puede ser potencialmente menos segura.
                <a href='javascript:void(0);' id="ver_menos2" class="ver_menos">&#60;&#60; menos info</a>
          </span>
      </span>
  </p>
  <p> 
<?php //php
      if($email){
            $checado="";
            if($cifrado){ $checado=" checked"; }
            echo "<input name='cifrado' id='cifrado' type='checkbox'$checado>
            <span id='cifrado_txt'>
            ";             
      }else{ 
?>
            <input name="cifrado" id="cifrado" type="checkbox" disabled>
            <span id="cifrado_txt" style="opacity: 0.3">
<?php 
      }
?>
          Cifrar correo y no me contactes por favor.
          <a href='javascript:void(0);' id="ver_mas4"  class="ver_mas oculto">más info >></a>
          <span id="mas_info4"  class="oculto">
                Si decide compartir con nosotros su correo electrónico, es posible que aprovechemos la oportunidad para contactarnos con ustedes ocasionalmente, de manera que podamos notificarle de algún cambio importante que pueda afectar su inventario o fondo de literatura. Sin embargo si no desea recibir ningún mensaje de nuestra parte puede elegir cifrar su correo, de manera que pueda ser usado solo para recuperar su acceso. Todos los usuarios serán notificados de cambios importantes directamente al acceder al programa, por lo que recibirlos por correo no es esencial.
                <a href='javascript:void(0);' id="ver_menos4" class="ver_menos">&#60;&#60; menos info</a>
          </span>
      </span>
  </p>
  <p>
      <label for="grupo">Nombre del Grupo:</label><br>
      <?php if($grupo){ echo "<input name='grupo' id='grupo' value='$grupo' class='required' maxlength='200' type='text'>"; }else{ ?><input name="grupo" id="grupo" class="sin_def required" value="(Opcional)" maxlength='200' type="text"><?php } ?>
      <?php if($grupo){ echo "<button id='borrar2' class='borrar' type='button'>Borrar</button>"; }else{ ?><button id="borrar2" class="borrar oculto" type="button">Borrar</button><?php } ?>
      <a href='javascript:void(0);' id="ver_mas3" class="ver_mas">más info >></a>
      <span id="mas_info3"  class="oculto">
            Este nombre se mostrara en los informes de secretario, sin embargo si no se desea proporcionar este dato, es posible escribirlo antes de imprimir, o bien, después de imprimir con un lápiz o pluma.
            <a href='javascript:void(0);' id="ver_menos3" class="ver_menos">&#60;&#60; menos info</a>
      </span>
  </p>
<?php //php
	    echo "<input id='usuario' type='hidden' value='$nombre'>";
?>
<!--
  <p>
      <label for="clave">Contraseña Actual:</label><br>
      <input name="clave" id="clave" type="password">
      <div id="error5" class="error"></div>
  </p>
-->
  <p class="botones">
      <button id="guardar1" type="submit" disabled>Guardar</button> <button type="button" onclick="window.location='index.php';">Cancelar</button>
  </p>
</fieldset>
</form>
<form method="post" id="contra" name="contra" onsubmit="return continuar2();">
<fieldset> <legend>Cambio de Contraseña</legend>
  <p id="error4" class="error"></p>
<!--
  <p>
      <label for="actual2">Contraseña Actual:</label><br>
      <input name="actual2" id="actual2" value="" maxlength='200' type="password">
      <div id="error7" class="error"></div>
  </p>
-->
  <p>
      <label for="nueva">Contraseña Nueva:</label><br>
      <input name="nueva" id="nueva" value="" maxlength='200' type="password">
  </p>
  <p>
      <label for="nueva2">Escribela de nuevo:</label><br>
      <input name="nueva2" id="nueva2" value="" maxlength='200' type="password">
      <div id="error6" class="error"></div>
  </p>
  <p class="botones">
      <button id="guardar2" type="submit" disabled>Guardar</button> <button type="button" onclick="window.location='index.php';">Cancelar</button>
  </p>
</fieldset>
</form>
<script type='text/javascript'>
    email_original="<?php echo $email; ?>"
    email_original=email_original.toLowerCase()
    grupo_original="<?php echo $grupo; ?>"
    grupo_original=grupo_original.toUpperCase()
    solo_este_original="<?php echo $solo_este; ?>"
    cifrado_original="<?php echo $cifrado; ?>"
</script>
<?php //php
	$last_edited=filectime('js/perfil_usuario.js');
    echo "<script type='text/javascript' src='js/perfil_usuario.js?$last_edited'></script>";
  }
?>
</body></html>
