<?php
  /* Datos de conexión a la base de datos */
  $db_host = "localhost";
  $db_user = "root";
  $db_pass = "";
  $db_name = "ninite";

  $mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
  if($mysqli->connect_errno) {
    echo "Falló al conectar".$mysqli->connect_errno;
    exit();
  }
?>
