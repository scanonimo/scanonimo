<?php //php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	if(!isset($_SESSION['usuario'])){
		echo "Error";
		exit;
	}else{
		if($_SESSION['tipo']!="1"){
			echo "Error";
			exit;
		}
	}
    if (is_file('../php/php_error_catcher.php')){
          include '../php/php_error_catcher.php';
    }else{
          if (is_file('php/php_error_catcher.php')){
                include 'php/php_error_catcher.php';
          }else{
                include 'php_error_catcher.php';
          }
    }
?>
