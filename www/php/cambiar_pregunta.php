<?php //PHP
  $texto="";
  session_start();
  function new_question() {
        global $texto;
        $azar=rand(0, 2);
        if(isset($_SESSION['pregunta'])){
            while($_SESSION['pregunta'] == $azar){
                $azar=rand(0, 2);
            }
        }
        $_SESSION['pregunta']=$azar;
        $pregunta=$_SESSION['pregunta'];
        switch ($pregunta) {
            case 0:
                $texto="Escriba las iniciales de las oficinas de Al-Anon a nivel mundial:";
                break;
            case 1:
                $texto="Escriba las iniciales de las oficinas de Al-Anon en México:";
                break;
            case 2:
                $texto="Las tres primeras letras de los legados en el triangulo de Al-Anon son (UNI)dad, (SER)vicio y por ultimo:";
                break;
        }
  }
  new_question();
  echo "1;$texto";
  exit;
?>
