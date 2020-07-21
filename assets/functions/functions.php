<?php
  require 'connection.php';

  /* Verifica si el nombre de usuario está ya en uso */
  if(!empty($_POST['usuario']) && empty($_POST['funcion'])) {
    $usuario = $_POST['usuario'];
    $nombreUsql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $nombreUes = mysqli_query($mysqli, $nombreUsql);
    $count = mysqli_num_rows($nombreUes);
    if ($count == 1) {
       echo  "<span class='red-text'>Nombre de usuario no disponible.<span>";
    } else {
       echo  "<span class='green-text'>Nombre de usuario disponible.<span>";
    }
    mysqli_close($mysqli);
  }

  /* Verifica si las contraseñas ingresadas coinciden */
  if (!empty($_POST['clave']) && !empty($_POST['clave2']) && empty($_POST['funcion'])) {
    $clave = $_POST['clave'];
    $clave2 = $_POST['clave2'];
    if (strcmp($clave,$clave2) !== 0) {
      echo  "<span class='red-text'>Las contraseñas no coinciden.<span>";
    }
  }

  if(isset($_POST['funcion']) && !empty($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch($funcion) {

      /* Inserta un nuevo usuario en la BD */
      case 'inserta':
        $usuario = $_POST['usuario'];
        $correo = $_POST['correo'];
        $clave = $_POST['clave'];
        $clave2 = $_POST['clave2'];

        /* Tipo: 1=ADMINISTRADOR, 2=USUARIO(DEFAULT) */
        $tipo = 2;
        if (strcmp($clave,$clave2) !== 0) {
          echo "<p'>Ha ocurrido un error, vuelva a intentarlo.<br>
                  Por favor verifique que las contraseñas coincidan.<p>";
          exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
          $buscarUsuario = "SELECT * from usuarios WHERE usuario='$usuario'";
          $resultado = $mysqli->query($buscarUsuario);
          $contador = mysqli_num_rows($resultado);
          if ($contador == 1) {
            echo "<p>Ha ocurrido un error, vuelva a intentarlo.<br>
                    Por favor verifique que el nombre de usuario esté disponible.<p>";
            exit;
          }
          $query = "INSERT INTO usuarios (id, usuario, correo, password, tipo)
                    VALUES (NULL, '$usuario', '$correo', '$clave', '$tipo')";
          if (mysqli_query($mysqli,$query)) {
            echo "<p>Registro insertado correctamente.<br>
                    Ahora puede iniciar sesión con sus credenciales</p>";
          } else {
            echo "Error: ".$query."<br>".mysqli_error($mysqli);
          }
        }
        mysqli_close($mysqli);
      break;

      /* Verifica que el usurio ingresado exista e inicia sesión */
      case 'verifica':
        session_start();
        if (isset($_SESSION["id"])) {
          ?> <script>window.location="./dashboard.php";</script> <?php
          echo "<p>Será redireccionado a su perfil. Por favor espere.<p>";
          exit;
        } else {
          $error = array();
          if (!empty($_POST)) {
            $nombre = $_POST['usuario'];
            $clave = $_POST['clave'];
            $error[] = login($nombre,$clave);
            if (count($error)>0) { foreach ($error as $error) { echo $error; } }
          }
        }
      break;

      /* Muestra la contraseña si los datos ingresados se encuentran en la BD */
      case 'recupera':
        $usuario = $_POST['usuario'];
        $correo = $_POST['correo'];
        $buscar = "SELECT * FROM usuarios WHERE usuario='$usuario' && correo='$correo'";
        $resultado = mysqli_query($mysqli,$buscar) or die ('Error en el query database.');
        $fila = mysqli_fetch_array($resultado);
        if (!empty($fila['password'])) {
          echo "<p'>Su contraseña es: <b>".$fila['password']."</b>.</p>"; }
        else { echo "<p>Los datos ingresados no se encuentran en la base de datos.</p>"; }
        mysqli_close($mysqli);
      break;

      /* Verifica si una aplicación se encuentra en la BD y la muestra */
      case 'buscarPalabra':
        function conexion() {
          return new PDO('mysql:host=localhost;dbname=ninite', 'root', '',
                          array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                          PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }
        $pdo = conexion();
        $keyword = '%'.$_POST['palabra'].'%';
        $sql = "SELECT * FROM encuesta WHERE encuesta_aplicacion LIKE (:keyword) ORDER BY id ASC LIMIT 0, 3";
        $query = $pdo->prepare($sql);
        $query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $query->execute();
        $lista = $query->fetchAll();
        foreach ($lista as $milista) {
        	$encuesta_aplicacion = $milista['encuesta_aplicacion'];
          echo '<li class="collection-item"
                    onclick="set_item(\''.str_replace("'", "\'", $milista['encuesta_aplicacion']).'\')">'.$encuesta_aplicacion.'</li>';
        }
        mysqli_close($mysqli);
      break;

      /* Agrega una nueva aplicación a la encuesta */
      case 'agregaEncuenta':
        $cantidadMaxVotos = 10;
        session_start();
        $id = $_SESSION['id'];
        $nombreAplicacion = $_POST['nombreAplicacion'];
        foreach ($mysqli->query("SELECT * FROM encuesta WHERE encuesta_aplicacion='$nombreAplicacion'") as $encuesta) {
          echo "<p>La aplicación ya se encuentra en la lista, por favor ingrese otra.</p>";
          exit;
        }
        $totalAppPostuladas = 0;
        foreach ($mysqli->query("SELECT * FROM encuesta WHERE postulador='$id'") as $encuesta) {
          ++$totalAppPostuladas;
        }
        if ($totalAppPostuladas > $cantidadMaxVotos) {
          echo "<p>Usted ya postuló demasiadas aplicaciones.</p>";
          exit;
        }
        $query = "INSERT INTO encuesta (id, encuesta_aplicacion, votos, postulador)
                  VALUES (NULL, '$nombreAplicacion', '0', '$id')";
        if (mysqli_query($mysqli, $query)) {
          echo "<p>Los datos se anexaron correctamente.</p>";
          echo "<meta http-equiv='refresh' content='1'>"; }
        else { echo "Error: ".$query."<br>".mysqli_error($mysqli); }
        mysqli_close($mysqli);
      break;

      /* Transforma la cuenta del usuario a administrador */
      case 'promoverUsuario':
        $idUser = $_POST['idUser'];
        $sql = "UPDATE usuarios SET tipo=1 WHERE id='$idUser'";
        $resultado = $mysqli->query($sql) or die ('Error en el query database');
        if ($resultado) { echo $_POST['nombreUser']." ahora es un administrador."; }
        else { echo "Ha ocurrido un error. No se pudo actualizar el registro."; }
        mysqli_close( $mysqli );
      break;

      /* Transforma la cuenta del usuario a administrador */
      case 'eliminarUsuario':
        $idUser = $_POST['idUser'];
        $sql = "DELETE FROM encuesta_usuario WHERE id_usuario = '$idUser'";
        $resultado = $mysqli->query($sql) or die ('Error en el query database');
        $sql = "DELETE FROM usuarios WHERE id = '$idUser'";
        $resultado = $mysqli->query($sql) or die ('Error en el query database');
        if ($resultado) { echo "El registro fué eliminado de manera exitosa."; }
        else { echo "Ha ocurrido un error. No se pudo eliminar el registro."; }
        mysqli_close( $mysqli );
      break;

      /* Añadir encuesta a la lista principal de aplicaciones */
      case 'agregarEncuesta':
        $idPoll = $_POST['idPoll'];
        $nombrePoll = $_POST['nombrePoll'];
        $categoria = $_POST['categoria'];
        if ($categoria) {
          /* Inserta la aplicación en la lista */
          $sql = "INSERT INTO aplicaciones (id, nombre_aplicacion) VALUES (NULL, '$nombrePoll')";
          $resultado = $mysqli->query($sql) or die ('Error en el query database');
          $encuesta = $mysqli->insert_id;
          /* Relaciona la aplicación con su categoría */
          $sql = "INSERT INTO aplicacion_categoria (id_aplicacion, id_categoria) VALUES ('".$encuesta."','".$categoria."')";
          $resultado = $mysqli->query($sql) or die ('Error en el query database');
          /* Relaciona la aplicación con su distribución */
          $sql = "INSERT INTO aplicacion_distribucion (id_aplicacion, id_distribucion) VALUES ('".$encuesta."','1')";
          $resultado = $mysqli->query($sql) or die ('Error en el query database');
          /* Elimina los votos recibidos en la encuesta */
          $sql = "DELETE FROM encuesta_usuario WHERE id_encuesta = '$idPoll'";
          $resultado = $mysqli->query($sql) or die ('Error en el query database');
          /* Elimina la aplicación de la lista de encuesta */
          $sql = "DELETE FROM encuesta WHERE id = '$idPoll'";
          $resultado = $mysqli->query($sql) or die ('Error en el query database');
          echo "La aplicación ".$nombrePoll." fué añadida a la lista.";
        } else {
          echo "Por favor seleccione una categoría.";
        }
      break;

      /* Añade el voto que emitió el usuario a la BD */
      case 'emitirVoto':
        session_start();
        $id = $_SESSION['id'];
        $nombreApp = $_POST['nombreApp'];
        $votoApp = (int)($_POST['votoApp'])+1;
        foreach ($mysqli->query("SELECT * FROM encuesta WHERE encuesta_aplicacion='$nombreApp'") as $encuesta) {
          $idEncuesta = $encuesta['id'];
          break;
        }
        $contador = 0;
        foreach ($mysqli->query("SELECT * FROM encuesta_usuario WHERE id_usuario='$id'") as $encuesta_usuario) {
          if ($encuesta_usuario['id_encuesta'] == $idEncuesta) { $contador++; }
        }
        if ($contador > 0) {
          echo "<p>El voto no será contabilizado. Usted ya votó por esta aplicación.</p>";
          exit; }
        else {
          $sql = "INSERT INTO encuesta_usuario (id_encuesta, id_usuario) VALUES ('".$idEncuesta."','".$id."')";
          $mysqli->query($sql);
          $query = "UPDATE encuesta SET votos='$votoApp' WHERE encuesta_aplicacion='$nombreApp'";
          if ($mysqli->query($query) === TRUE) { echo "<p>Tu voto fue añadido correctamente.</p>"; }
          else { echo "Error: ". $query."<br>".mysqli_error($mysqli); }
        }
        mysqli_close($mysqli);
      break;

      /* Eliminar un voto que emitido por el usuario en la BD */
      case 'eliminarVoto':
        session_start();
        $id = $_SESSION['id'];
        $idVoto = $_POST['idVoto'];
        $votoApp = (int)($_POST['votoApp'])-1;
        $sql = "DELETE FROM encuesta_usuario WHERE id_usuario = '$id' AND id_encuesta = '$idVoto'";
        $resultado = $mysqli->query($sql) or die ('Error en el query database');
        $sql = "UPDATE encuesta SET votos='$votoApp' WHERE id='$idVoto'";
        $resultado = $mysqli->query($sql) or die ('Error en el query database');
        if ($resultado) {
          echo "El registro fué eliminado de manera exitosa.";
        } else { echo "Ha ocurrido un error. No se pudo eliminar el registro."; }
        mysqli_close($mysqli);
      break;
    }
  }

  function login($usuario, $password) {
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT id, password FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
    $stmt->bind_param("ss", $usuario, $usuario);
    $stmt->execute();
    $stmt->store_result();
    $row=$stmt->num_rows;
    if ($row > 0) {
      $stmt->bind_result($id,$passwd);
      $stmt->fetch();
      if (strcmp($password,$passwd) == 0) {
        $_SESSION['id'] = $id;
        ?> <script>window.location="./dashboard.php";</script> <?php
        echo "<p>Será redireccionado a su perfil. Por favor espere.<p>";
        mysqli_close($mysqli);
        exit;
      } else { $error = "La contraseña es incorrecta."; }
    } else { $error = "El nombre de usuario o correo electrónico no existe."; }
    mysqli_close($mysqli);
    return $error;
  }
?>
