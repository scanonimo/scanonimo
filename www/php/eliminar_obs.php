<?php //php
  if($eliminar_obs != '0'){
      $query = "UPDATE consulta SET eliminar_obs='0' WHERE usuario='$usuario_id'";
      correr_query($enlace, $query);
      if($eliminar_obs == '2'){
          $query = "UPDATE inventario SET obsequiados='0' WHERE usuario='$usuario_id'";
          correr_query($enlace, $query);
          $query = "UPDATE libros_per SET regalados='0' WHERE usuario='$usuario_id'";
      
      }
      correr_query($enlace, $query);
      $query = "DELETE FROM inventario WHERE obsequiados=0 AND piezas=0 AND usuario='$usuario_id'";
      correr_query($enlace, $query);
  }
?>
