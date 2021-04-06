<?php //php
		if(isset($_POST)){
			  foreach ($_POST as $key => $value) {
    				$value=substr(strtoupper(preg_replace("/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\,\:\¡\!\¿\?\-\.\ ]+/", "", $value)),0,200);
    				$_POST[$key]=mysqli_real_escape_string($enlace, $value);
			  }
		}
		if(isset($_GET)){
			  foreach ($_GET as $key => $value) {
    				$value=substr(strtoupper(preg_replace("/[^a-zA-Zá-úÁ-Ú0-9\*\(\)\,\:\¡\!\¿\?\-\.\ ]+/", "", $value)),0,200);
    				$_GET[$key]=mysqli_real_escape_string($enlace, $value);
        }
	  }
?>
