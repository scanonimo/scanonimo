<?php
  if (is_file('../var/data_base_info.php'))
  {
    	include '../var/data_base_info.php';
  }else{
    	include 'var/data_base_info.php';
  }
  if(!function_exists("conexion_mysql")){
      function conexion_mysql($usuario, $password,$base_de_datos,$ubicacion){
        $enlace = mysqli_connect($ubicacion, $usuario, $password, $base_de_datos);
        if(mysqli_connect_error()){
            $mensaje_de_error=mysqli_connect_error();
            $alert = "Error Encontrado
      Mensaje de error: $mensaje_de_error";
            $to = $email_error;
            $browser_str = $_SERVER['HTTP_USER_AGENT'];
            $browser_str = substr(preg_replace("/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\=\[\]\,\:\¡\!\¿\?\-\n\.\ ]+/", "", $browser_str),0,5000);
            $subject = 'Error en la conexión con la BD';
            $message = "$alert
      Información del Navegador
      $browser_str";
            $message = substr(preg_replace("/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\=\[\]\,\:\¡\!\¿\?\-\n\.\ ]+/", "", $message),0,5000);
            if(mail($to, $subject, $message)){
                echo "<h1>Error en la base de datos</h1>
                <p>Hemos encontrado un error al intentar conectarnos a nuestra base de datos. Hemos enviado un correo al administrador para avisarle del error. El error encontrado es el siguiente:</p>
                <p>$mensaje_de_error</p>";          
            }else{
                echo "<h1>Error en la base de datos</h1>
                <p>Hemos encontrado un error al intentar conectarnos a nuestra base de datos. Desafortunadamente no hemos podido contactar al administrador. Si tiene alguna manera de contactarlo, por favor envíele este mensaje:</p>
                <p>$mensaje_de_error</p>";          
            }
            exit;
        }
        if (!$enlace) {
            $error_enviar='Error de Conexión (' . mysqli_connect_errno() . ') '
              . mysqli_connect_error();
                customError("",$error_enviar,"","","");
        }
        return $enlace;
      }
  }
  $enlace=conexion_mysql($usuario,$password,$base_de_datos,$ubicacion);
  if(!function_exists("correr_query")){
        function correr_query($enlace, $query){
          mysqli_query($enlace, "SET NAMES 'utf8'");
          $result=mysqli_query($enlace, $query);
          if (!$result) {
                $mensaje = 'Consulta no válida: ' . mysqli_error($enlace) . "\n";
                customError("",$mensaje,"","","");
          }
          return $result;
        }
  }
  if(!function_exists("email_check")){
    function depuracion($enlace){
      if(isset($_POST)){
          foreach ($_POST as $key => $value) {
          $cadena=$value;
          $cadena=str_replace("<","&lt;",$cadena);
          $cadena=str_replace(">","&gt;",$cadena);
          if(strpos($cadena, "\r")){
	          $cadena=str_replace("\r","<br>",$cadena);
          }else{
	          $cadena=str_replace("\n","<br>",$cadena);
          }
          $cadena=mysqli_real_escape_string($enlace, $cadena);
          $_POST[$key]=$cadena;
          }
      }
    }
    if(isset($_GET)){
        //This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
        $cadena=$value;
        $cadena=str_replace("<","&lt;",$cadena);
        $cadena=str_replace(">","&gt;",$cadena);
        if(strpos($cadena, "\r")){
	        $cadena=str_replace("\r","<br>",$cadena);
        }else{
	        $cadena=str_replace("\n","<br>",$cadena);
        }
        $cadena=mysqli_real_escape_string($enlace, $cadena);
        $_GET[$key]=$cadena;
        }
    }
  }
  if(!function_exists("es_numerico")){
    function es_numerico($numero){
        if(!is_numeric($numero)){
            $mensaje="Que pena, esto no se supone que pasara. Por favor comunícate con nosotros y notifícanos este error. Gracias (funcion es_numerico).";
            customError("",$mensaje,"","","");
        }
        return $numero;
    }
  }
  if(!function_exists("depurar_cadena")){
    function depurar_cadena($cadena,$longitud){
        global $enlace;
        $cadena=substr(preg_replace("/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\=\[\]\,\:\¡\!\¿\?\-\.\ ]+/", "", $cadena),0,$longitud);
        $cadena=mysqli_real_escape_string($enlace, $cadena);
        return $cadena;
    }
  }
  if(!function_exists("entero")){
    function entero($numero){
      	if(!is_numeric($numero) && $numero != ""){
            $mensaje = "No es numerico.";
            customError("",$mensaje,"","","");
        }
        $numero=preg_replace("/[\-]+/", "", $numero);
        return intval($numero);
    }
  } 
  if(!function_exists("decimales")){
    function decimales($numero){
        if(!is_numeric($numero) && $numero != ""){
            $mensaje = "No es numerico.";
            customError("",$mensaje,"","","");
        }
        $numero=preg_replace("/[\-]+/", "", $numero);
        return floor($numero * 100) / 100;
    }
  }
  if(!function_exists("email_check")){
            function email_check($email_env){
                if(!filter_var($email_env, FILTER_VALIDATE_EMAIL)) {
                    $mensaje = "No es un email.";
                    customError("",$mensaje,"","","");
                }
            }
  }
?>
