<?php //PHP
	include 'data_base_work.php';
    if(!isset($_POST["id"]) or !isset($_POST["clave"]) or !isset($_POST["nueva"])) {
        exit;
    }
    $nueva=$_POST['nueva'];
    $clave=es_numerico($_POST['clave']);
	$usuario_id=es_numerico($_POST['id']);
    $nueva=password_hash($nueva, PASSWORD_DEFAULT);
    $query="UPDATE usuarios SET password='$nueva', recuperar='0' WHERE id='$usuario_id' AND recuperar='$clave'";
    correr_query($enlace, $query);
    echo "1";
?>
