<!-- Conexión a la base de datos-->
<?php require './assets/functions/connection.php'; ?>

<!-- Aplicaciones -->
<div class="container">

  <!-- Inicio de tarjeta -->
  <div class="card-panel">

    <!-- Cabecera de página de aplicaciones -->
    <h4 class="hide-on-med-and-down"><b>PASO 1:</b> Elige las aplicaciones a instalar.</h4>
    <div class="center-align">
      <h5 class="hide-on-large-only hide-on-small-only show-on-medium"><b>PASO 1:</b> Elige las aplicaciones a instalar.</h5>
      <h6 class="hide-on-med-and-up">Paso 1: Elige las aplicaciones a instalar.</h6>
    </div>

    <!-- Formulario de aplicaciones -->
    <form role="form" name="Aplicaciones" id="Aplicaciones" method="post">

      <!-- Listado de 'checkbox'-->
      <div id="listadoCheckbox">
        <div class='row'>

          <!-- Visualización en dispositivos con pantallas grande -->
          <?php
            $contador = 0;

      			/* Función que devuelve el número total de elementos de la tabla categoría */
      			if ($result = mysqli_query($mysqli, "SELECT * FROM categoria")) {
      			  $numero_categoria = mysqli_num_rows($result);
      			  mysqli_free_result($result);
      			}
            echo "<div class='hide-on-med-and-down'>";
            foreach ($mysqli->query('SELECT * FROM categoria') as $aplicacion) {
              if ($contador == 0) { echo "<div class='col l3'>"; $contador++; }
              else { $contador++; }
              echo "<h5 class='header'>".$aplicacion['nombre_categoria']."</h5>";
              $id_cat = $aplicacion['id'];
              $query_app_cat = "SELECT * FROM aplicacion_categoria WHERE id_categoria = '$id_cat'";
              $resultado_query_app_cat = $mysqli->query($query_app_cat);
              while($aplicacion = mysqli_fetch_array($resultado_query_app_cat)) {
                $id_app = $aplicacion['id_aplicacion'];
                $query_app = "SELECT * FROM aplicaciones WHERE id = '$id_app'";
                $resultado_query_app = $mysqli->query($query_app);
                while($aplicacion = mysqli_fetch_array($resultado_query_app)) {
                  echo "<label>
                          <input type='checkbox' onclick='activarBoton(); concepto()'
                                 value='".$aplicacion['nombre_aplicacion']."'>
                            <span>".$aplicacion['nombre_aplicacion']."</span>
                        </label><br>";
                }
              }
              if ($contador == round($numero_categoria/3)) { echo "</div>"; $contador = 0; }
            }
            echo "</div></div>";
          ?>
          <!-- Fin visualización en dispositivos con pantallas grande -->

          <!-- Visualización en dispositivos con pantallas medianas -->
          <?php
            $contador = 0;
            echo "<div class='col m6'><ul class='collapsible hide-on-large-only hide-on-small-only show-on-medium'>";
            foreach ($mysqli->query('SELECT * FROM categoria') as $aplicacion) {
              if ($contador == -1) {
                echo "<div class='col m6'><ul class='collapsible hide-on-large-only hide-on-small-only show-on-medium'>";
                $contador++;
              }
              $id_cat = $aplicacion['id'];

              /* Función que devuelve el número total de aplicaciones de cada categoría */
              if ($result = mysqli_query($mysqli, "SELECT * FROM aplicacion_categoria WHERE id_categoria = '$id_cat'")) {
                $numero_aplicacion = mysqli_num_rows($result);
                mysqli_free_result($result);
              }

			        echo "<li>
                      <div class='collapsible-header'>
                        ".$aplicacion['nombre_categoria']."
                        <span class='badge'>".$numero_aplicacion."</span>
                      </div>
                      <div class='collapsible-body'>";

                        $query_app_cat = "SELECT * FROM aplicacion_categoria WHERE id_categoria = '$id_cat'";
                        $resultado_query_app_cat = $mysqli->query($query_app_cat);
                        while($aplicacion = mysqli_fetch_array($resultado_query_app_cat)) {
                          $id_app = $aplicacion['id_aplicacion'];
                          $query_app = "SELECT * FROM aplicaciones WHERE id = '$id_app'";
                          $resultado_query_app = $mysqli->query($query_app);
                          while($aplicacion = mysqli_fetch_array($resultado_query_app)) {
                            echo "<label>
                                    <input type='checkbox' onclick='activarBoton(); concepto()'
                                           value='".$aplicacion['nombre_aplicacion']."'>
                                      <span>".$aplicacion['nombre_aplicacion']."</span>
                                  </label><br>";
                          }
                        }
                      echo "</div>
                    </li>";
              if ($contador == (($numero_categoria/2)-1)) { echo "</ul></div>"; $contador = -1; }
              else { $contador++; }
            }
            echo "</ul></div>";
          ?>
          <!-- Fin visualización en dispositivos con pantallas medianas -->

          <!-- Visualización en dispositivos con pantallas pequeñas -->
          <?php
            echo "<ul class='collapsible hide-on-med-and-up'>";
            foreach ($mysqli->query('SELECT * FROM categoria') as $aplicacion) {
              $id_cat = $aplicacion['id'];

              /* Función que devuelve el número total de aplicaciones de cada categoría */
              if ($result = mysqli_query($mysqli, "SELECT * FROM aplicacion_categoria WHERE id_categoria = '$id_cat'")) {
                $numero_aplicacion = mysqli_num_rows($result);
                mysqli_free_result($result);
              }

              echo "<li>
                      <div class='collapsible-header'>
                        ".$aplicacion['nombre_categoria']."
                        <span class='badge'>".$numero_aplicacion."</span>
                      </div>
                      <div class='collapsible-body'>";
                        $query_app_cat = "SELECT * FROM aplicacion_categoria WHERE id_categoria = '$id_cat'";
                        $resultado_query_app_cat = $mysqli->query($query_app_cat);
                        while($aplicacion = mysqli_fetch_array($resultado_query_app_cat)) {
                          $id_app = $aplicacion['id_aplicacion'];
                          $query_app = "SELECT * FROM aplicaciones WHERE id = '$id_app'";
                          $resultado_query_app = $mysqli->query($query_app);
                          while($aplicacion = mysqli_fetch_array($resultado_query_app)) {
                            echo "<label>
                                    <input type='checkbox' onclick='activarBoton(); concepto()'
                                           value='".$aplicacion['nombre_aplicacion']."'>
                                      <span>".$aplicacion['nombre_aplicacion']."</span>
                                  </label><br>";
                          }
                        }
                      echo "</div>
                    </li>";
            }
            echo "</ul>";
          ?>
          <!-- Fin visualización en dispositivos con pantallas pequeñas -->

        </div>

        <!-- Area donde se guardan las aplicaciones seleccionadas -->
        <textarea id="listadoAplicacion" name="listadoAplicacion" hidden readonly></textarea>

        <!-- Botón siguiente -->
        <center>
          <button class="btn waves-effect waves-light light-blue darken-4"
                  type="submit" id="siguiente"
                  disabled>Siguiente
          </button>
        </center>
      </div>

    </form>
    <!-- Fin formulario de aplicaciones -->

  </div>
  <!-- Fin tarjeta -->

</div>
<!-- Fin sección 'Aplicaciones' -->

<script type="text/javascript">
  function activarBoton() {
    var estado = document.getElementsByTagName("input");
  	for (var i = 0; i < estado.length; i++) {
  	   if(estado[i].checked==true) {
         document.getElementById("siguiente").disabled = false;
         break;
       }
  		else
        document.getElementById("siguiente").disabled = true;
  	}
  }
  function concepto() {
    var string = "", boxes = document.getElementById("listadoCheckbox").getElementsByTagName("input");
    for (var i = 0; i < boxes.length; i++)
      if (boxes[i].checked)
        string += boxes[i].value + ", ";
    document.getElementById("listadoAplicacion").value = string.replace(/\,\x20$/, "");
  }
  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
  $('#Aplicaciones').submit(function(event){
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "distribution.php",
      data: parametros,
      success: function(data) {
        $('#cuerpo').html(data);
      }
    });
    event.preventDefault();
  });
</script>
