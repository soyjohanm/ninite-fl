<?php
  require( dirname( __FILE__ ) . '/header.php' );

  /* Verifica si el usuario inició o no sesión */
  if(!isset($_SESSION['id'])) {
    ?> <script>window.location="./index.php";</script> <?php
  }

  /* Conexión a la base de datos */
  require './assets/functions/connection.php';
?>
  <main >
    <div class="section">

      <!-- Administrador -->
      <?php if ($fila['tipo'] == 1) { ?>

        <!-- Tablero administrador -->
        <div class="container">

          <!-- Inicio de tarjeta -->
          <div class="card-panel">
            <div class="row">

              <!-- Pestañas para manejar la información del programa -->
              <ul class="tabs tabs-fixed-width">
                <li class="tab col l6 m6 s6"><a href="#usuarios">USUARIOS</a></li>
                <li class="tab col l6 m6 s6"><a href="#encuestas">ENCUESTA</a></li>
              </ul>

              <!-- Cuerpo de pestaña 'USUARIOS' -->
              <div id="usuarios" class="col l12 m12 s12">
                <table class="highlight">
                  <thead>
                    <tr>
                      <th>USUARIO</th>
                      <th class="hide-on-small-only">CORREO</th>
                      <th class="hide-on-small-only">CONTRASEÑA</th>
                      <th class="center-align">ACCIÓN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($mysqli->query('SELECT * FROM usuarios') as $usuarios) {
                        echo "<tr id='".$usuarios['id']."'>
                                <td>".$usuarios['usuario']."</td>
                                <td class='hide-on-small-only'>".$usuarios['correo']."</td>
                                <td class='hide-on-small-only'>".$usuarios['password']."</td>
                                <td class='hide'>".$usuarios['id']."</td>
                                <td class='center-align'>
                                  <a class='btn-flat hide-on-small-only' id='promoverUsuario' title='Promover a administrador'>
                                    <i class='fas fa-user-tie'></i>
                                  </a>
                                  <a class='btn-flat hide-on-med-and-up' id='promoverUsuario'>Promover</a>
                                  <a class='btn-flat hide-on-small-only' id='eliminarUsuario' title='Eliminar'>
                                    <i class='fas fa-user-times'></i>
                                  </a>
                                  <a class='btn-flat hide-on-med-and-up' id='eliminarUsuario'>Eliminar</a>
                                </td>";
                              echo "</tr>";
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- Fin cuerpo de pestaña 'USUARIOS' -->

              <!-- Cuerpo de pestaña 'ENCUESTAS' -->
              <div id="encuestas" class="col l12 m12 s12">
                <table class="highlight">
                  <thead>
                    <tr>
                      <th class="center-align">APLICACIÓN</th>
                      <th class="center-align hide-on-small-only">VOTOS</th>
                      <th class="center-align">CATEGORÍA</th>
                      <th class="center-align">ACCIÓN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($mysqli->query('SELECT * FROM encuesta ORDER BY votos DESC') as $encuesta) {
                        echo "<tr id='".$encuesta['id']."'>
                                <td class='center-align'>".$encuesta['encuesta_aplicacion']."</td>
                                <td class='center-align hide-on-small-only'>".$encuesta['votos']."</td>
                                <td class='center-align'>
                                  <div class='input-field'>
                                    <select name='categoria' id='categoria".$encuesta['id']."'>
                                      <option value='' disabled selected>Categoría</option>";
                                      foreach ($mysqli->query('SELECT * FROM categoria') as $categoria) {
                                        echo "<option value='".$categoria['id']."'>".$categoria['nombre_categoria']."</option>";
                                      }
                              echo "</select>
                                  </div>
                                </td>
                                <td class='hide'>".$encuesta['id']."</td>
                                <td class='center-align'>
                                  <a class='btn-flat' id='agregarEncuesta' title='Añadir a la lista'>
                                    <i class='fas fa-plus-circle'></i>
                                  </a>
                                </td>";
                        echo "</tr>";
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- Fin cuerpo de pestaña 'ENCUESTAS' -->

            </div>
          </div>
          <!-- Fin tarjeta -->

        </div>
        <!-- Fin tablero administrador -->

      <?php } ?>
      <!-- Fin administrador -->

      <!-- Usuario -->
      <?php if ($fila['tipo'] == 2) { ?>

        <!-- Tablero usuario -->
        <div class="container">

          <!-- Inicio de tarjeta -->
          <div class="card-panel">
            <p class="flow-text center-align">¡Hola <b><?php echo strtoupper($fila['usuario']); ?></b> es un placer tenerte aquí!</p><hr>
            <p>Seleccione su aplicación favorita, y nosotros la añadiremos a la lista.</p>

            <!-- Lista de aplicaciones que se encuentran en la encuesta -->
            <div class="row">
              <?php
                $contador = 0;
                foreach ($mysqli->query('SELECT * FROM encuesta') as $encuesta) {
                  if ($contador == 0) { echo "<div class='col l4 m6 s12'>"; $contador++; }
                  else { $contador++; } ?>
                  <table class="highlight">
                    <tbody>
                      <tr id=<?php echo $encuesta['id']; ?>>
                        <td><?php echo $encuesta['encuesta_aplicacion']; ?></td>
                        <td class="hide"><?php echo $encuesta['id']; ?></td>
                        <td class="right">
                          <span id="count"><?php echo $encuesta['votos']; ?></span>
                          <a class='btn-flat' title='Votar' id='votar'><i class="fas fa-heart"></i></a>
                          <?php
                            $votos = 0;
                            foreach ($mysqli->query("SELECT * FROM encuesta_usuario WHERE id_usuario='$id'") as $encuesta_usuario) {
                              if ($encuesta_usuario['id_encuesta'] == $encuesta['id']) { $votos++; }
                            }
                            if ($votos > 0) { echo "<a class='btn-flat' title='Eliminar' id='eliminarVoto'>
                                                      <i class='fas fa-trash-alt'></i>
                                                    </a>"; }
                            else { echo "<a class='btn-flat disabled' title='Usted no votó por esta aplicación'>
                                                        <i class='fas fa-trash-alt'></i></a>"; }
                          ?>
                        </div>
                        </td>
                      </tr>
                </tbody>
              </table>
              <?php if ($contador == 4) { echo "</div>"; $contador = 0; } } ?>
              <?php if ($contador != 0) { echo "</div>"; } ?>
            </div><br>

            <!-- Formulario para añadir nueva aplicación a la encuesta -->
            <div class="container">
              <p>¿La aplicación que quieres no se encuentra en la lista? ¡Añádela!</p>
              <form role="form" name="agregaEncuesta" id="agregaEncuesta" method="post">
                <div class="row">
                  <div class="col l10 m10 s8 input-field">
                    <input autocomplete="off" id="nombreAplicacion" name="nombreAplicacion" type="text" onkeyup="autocompletar()" required>
                    <label for="nombreAplicacion">Ingrese aplicación</label>
                    <ul id="lista" hidden></ul>
                  </div>
                  <div class="col l2 m2 s4">
                    <button type="submit" class="waves-effect waves-light btn-large light-blue darken-4">
                      <i class="fas fa-check-square"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- Fin tarjeta -->

        </div>
        <!-- Fin tablero usuario -->

      <?php } ?>
      <!-- Fin usuario -->

    </div>
  </main>
  <script>
    $(document).ready(function(){
      $('.tabs').tabs();
      $('select').formSelect();
    });
    $(document).on('click', '#promoverUsuario', function() {
      var currentRow = $(this).closest("tr");
      var nombreUser = currentRow.find("td:eq(0)").text();
      var idUser = currentRow.find("td:eq(3)").text();
      var objeto = {
        nombreUser : currentRow.find("td:eq(0)").text(),
        idUser : currentRow.find("td:eq(3)").text(),
        funcion : "promoverUsuario"
      };
      $.ajax({
        type: 'POST',
        url: "assets/functions/functions.php",
        data: objeto,
        success:function(data){
          M.toast({html: data});
        }
      });
    });
    $(document).on('click', '#eliminarUsuario', function() {
      var currentRow = $(this).closest("tr");
      var idUser = currentRow.find("td:eq(3)").text();
      var objeto = {
        idUser : currentRow.find("td:eq(3)").text(),
        funcion : "eliminarUsuario"
      };
      $.ajax({
        type: 'POST',
        url: "assets/functions/functions.php",
        data: objeto,
        success:function(data){
          M.toast({html: data});
          setTimeout(function(){location.reload()}, 2000);
        }
      });
    });
    $(document).on('click', '#agregarEncuesta', function() {
      var currentRow = $(this).closest("tr");
      var idPoll = currentRow.find("td:eq(3)").text();
      var categoria = $("#categoria"+idPoll).val();
      var nombrePoll = currentRow.find("td:eq(0)").text();
      var objeto = {
        idPoll : currentRow.find("td:eq(3)").text(),
        categoria : $("#categoria"+idPoll).val(),
        nombrePoll : currentRow.find("td:eq(0)").text(),
        funcion : "agregarEncuesta"
      };
      $.ajax({
        type: 'POST',
        url: "assets/functions/functions.php",
        data: objeto,
        success:function(data){
          M.toast({html: data});
          setTimeout(function(){location.reload()}, 2000);
        }
      });
    });
    $(document).on('click', '#votar', function() {
      var currentRow = $(this).closest("tr");
      var nombreApp = currentRow.find("td:eq(0)").text();
      var votoApp = currentRow.find("td:eq(2)").text();
      var objeto = {
        nombreApp : currentRow.find("td:eq(0)").text(),
        votoApp : currentRow.find("td:eq(2)").text(),
        funcion : "emitirVoto"
      };
      $.ajax({
        type: 'POST',
        url: "assets/functions/functions.php",
        data: objeto,
        success:function(data){
          M.toast({html: data});
          setTimeout(function(){location.reload()}, 2000);
        }
      });
    });
    $(document).on('click', '#eliminarVoto', function() {
      var currentRow = $(this).closest("tr");
      var idVoto = currentRow.find("td:eq(1)").text();
      var votoApp = currentRow.find("td:eq(2)").text();
      var objeto = {
        idVoto : currentRow.find("td:eq(1)").text(),
        votoApp : currentRow.find("td:eq(2)").text(),
        funcion : "eliminarVoto"
      };
      $.ajax({
        type: 'POST',
        url: "assets/functions/functions.php",
        data: objeto,
        success:function(data){
          M.toast({html: data});
          setTimeout(function(){location.reload()}, 2000);
        }
      });
    });
    $('#agregaEncuesta').submit(function(event) {
      var parametros = $(this).serialize() + '&funcion=agregaEncuenta';
      $.ajax({
        type: "POST",
        url: "assets/functions/functions.php",
        data: parametros,
        success: function(data) {
          M.toast({html: data});
        }
      });
      event.preventDefault();
    });
    function autocompletar() {
      var minimo_letras = 0;
      var palabra = $('#nombreAplicacion').val();
      var objeto = { palabra : $('#nombreAplicacion').val(), funcion : "buscarPalabra" };
      if (palabra.length > minimo_letras) {
        $.ajax({
    			type: 'POST',
          url: "assets/functions/functions.php",
    			data: objeto,
    			success:function(data){
    				$('#lista').show();
    				$('#lista').html(data);
    			}
    		});
      }
      else { $('#lista').hide(); }
    }
    function set_item(opciones) {
    	$('#nombreAplicacion').val(opciones);
    	$('#lista').hide();
    }
  </script>
<?php require( dirname( __FILE__ ) . '/footer.php' ); ?>
