<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' or true) {
    // La solicitud se hizo a través de Ajax
  if($_SERVER['HTTP_HOST'] == 'localhost' or true) {
    include('selenium.php');
  } else {
    // La solicitud no se hizo desde el mismo servidor
    header('HTTP/1.0 403 Forbidden');
    die('Acceso denegado');
  }
} else {
  // La solicitud no se hizo a través de Ajax
  header('HTTP/1.0 403 Forbidden');
  die('Acceso denegado1');
}


?>
