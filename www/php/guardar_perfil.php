<?php //PHP
	include 'restringido.php';
  if(!isset($_SESSION['acceso'])){
      echo "Error";
      exit;
  }
	include 'data_base_work.php';
  $_POST["email"]=strtolower($_POST["email"]);
	$_POST["grupo"]=depurar_cadena($_POST["grupo"],200);
	$usuario_id=$_SESSION['id'];
	$query="SELECT password, email FROM usuarios WHERE id='$usuario_id'";
	$result=correr_query($enlace, $query);
	$row=mysqli_fetch_array($result);
  $email_original=$row['email'];
  $cifrado_original="0";
  $dejalo_igual=false;
  if($email_original != "" && !filter_var($email_original, FILTER_VALIDATE_EMAIL)){
        $cifrado_original="1";
  }
    if(is_numeric($_POST['solo_este'])){ 
          $solo_este=$_POST['solo_este']; 
    };
    if(is_numeric($_POST['cifrado'])){ 
          $cifrado=$_POST['cifrado']; 
    };
    if(!$cifrado_original){
            if($_POST["email"] != ""){
	              if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    echo "1";
                    exit;
                }
            }else{
                $cifrado="0";
                $solo_este="0";
            }
    }else{
            if($_POST["email"] == ""){
                  $dejalo_igual=true;
            }
    }
    if($cifrado && $_POST["email"] != ""){
          $_POST["email"]=password_hash($_POST['email'], PASSWORD_DEFAULT);
    }
/*
    if(! password_verify($_POST['clave'],$row['password'])){
        echo "2";
        exit;
    }
*/
  if($_POST["email"] != "" && $cifrado == 0){
        $query="SELECT * FROM usuarios WHERE email='".$_POST["email"]."'";
        $result=correr_query($enlace, $query);
        $row=mysqli_fetch_array($result);
        if($row){
            if($row["id"] != $usuario_id) {
                echo "3";
                exit;
            }
        }
  }
  $cambio="";
  if(!$dejalo_igual){
      $cambio=" email='".$_POST["email"]."', ";
  }
  $query="UPDATE usuarios SET$cambio grupo='".$_POST["grupo"]."', solo_este='$solo_este' WHERE id='$usuario_id'";
  correr_query($enlace, $query);
  echo "4";
?>
