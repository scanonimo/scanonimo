<?php
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
			$_POST[$key]=$cadena;
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
			$_GET[$key]=$cadena;
		  }
	}
?>
