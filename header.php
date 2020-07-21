<!--
eliminar las lineas de pruebas
descomentar los recursos que se cargan de la web
cuadro de busqueda
-->
<?php
  require './assets/functions/connection.php';
  session_start();
  if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM usuarios WHERE id ='$id'";
    $resultado = mysqli_query($mysqli,$sql) or die ('Error en el query database.');
    $fila = mysqli_fetch_array($resultado);
    mysqli_free_result($resultado);
    mysqli_close($mysqli);
  }
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description"
          content="Sin hacer clic. Sin barras de herramientas. Sólo seleccionas tus aplicaciones y listo.">


    <!-- PRUEBAS -->
    <link rel="stylesheet" href="pruebas/materialize.css">
    <link rel="stylesheet" href="pruebas/fontawesome/css/all.css">
    <script src="pruebas/jquery-3.3.1.js"></script>
    <script src="pruebas/materialize.js"></script>

    <!-- Título de la página -->
    <title>Ninite for linux</title>

    <!-- Progressive Web App -->
    <link rel="manifest" href="manifest.json">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <meta name="msapplication-TileColor" content="#880e4f">
    <meta name="msapplication-TileImage" content="mstile-144x144.png">
    <meta name="theme-color" content="#880e4f">

    <!-- Fuente Roboto --><!--
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- FontAwesome --><!--
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
          crossorigin="anonymous">

    <!-- JQuery --><!--
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>

    <!-- MaterialiceCSS --> <!--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Estilos -->
    <link href="assets/styles/main.css" type="text/css" rel="stylesheet">

    <!-- Scripts -->
    <script src="assets/scripts/main.js"></script>

  </head>
  <body>

    <!-- Barra de navegación -->
    <nav role="navigation" class="pink darken-4">
      <div class="nav-wrapper container">

        <!-- Menú en dispositivos con pantallas grandes -->
        <a id="logo-container" href="./" class="brand-logo hide-on-med-and-down">Ninite for Linux</a>
        <a href="./" class="brand-logo hide-on-large-only hide-on-small-only show-on-medium">NINITE.FL</a>
        <a href="./" class="brand-logo hide-on-med-and-up">
          <img src="assets/images/icon-72x72.png" alt="logo-ninite" style="height: 56px;">
        </a>
        <ul class="right hide-on-med-and-down">
          <?php
            if (isset($_SESSION['id'])) {
              echo "<li><a href='./dashboard.php'>
                      <i class='fas fa-user-alt fa-lg'></i>  ".strtoupper($fila['usuario'])."</a>
                    </li>";
              echo "<li><a href='./exit.php'><i class='fas fa-sign-out-alt fa-lg'></i>  SALIR</a></li>";
            } else {
              echo "<li><a href='#modal1' class='modal-trigger' id='iniciarSesion'>Iniciar sesión</a></li>";
            }
          ?>
        </ul>

        <!-- Menú en dispositivos con pantallas pequeñas -->
        <ul id="nav-mobile" class="sidenav">
          <?php
            if (isset($_SESSION['id'])) {
              echo "<li><a href='./' class='sidenav-close'><i class='fas fa-home'></i>Inicio</a></li>";
              echo "<li>
                      <a href='./contact.php' class='sidenav-close' id='contacto'><i class='fas fa-headset'></i>Contacto</a>
                    </li>";
              echo "<li><a href='./dashboard.php' class='sidenav-close'><i class='fas fa-user-alt'></i>Mi cuenta</a></li>";
              echo "<li><a href='./exit.php' class='sidenav-close'><i class='fas fa-sign-out-alt'></i>Salir</a></li>";
            } else {
              echo "<li><a href='./' class='sidenav-close'><i class='fas fa-home'></i>Inicio</a></li>";
              echo "<li><a href='./contact.php' class='sidenav-close'><i class='fas fa-headset'></i>Contacto</a></li>";
              echo "<li><a href='#modal1' class='sidenav-close modal-trigger' id='iniciarSesion'>
                      <i class='fas fa-sign-in-alt'></i>Ingresa</a>
                    </li>";
            }
          ?>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger" title="Menú"><i class="fas fa-bars"></i></a>
        <a class="sidenav-trigger right" title="Buscar"><i class="fas fa-search"></i></a>
      </div>
    </nav>
    <!-- Fin barra de navegación -->

    <!-- 'Modal' donde se muestra el sistema de login -->
    <div id="modal1" class="modal" style="border-radius: 15px; overflow-x: hidden;"></div>
