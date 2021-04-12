<?php //php
      setlocale(LC_MONETARY, "jajajaj");
      $total_importe=money_format("$%!i",1000);
      echo $total_importe;
?>
