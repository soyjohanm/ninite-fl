<!-- Conexión a la base de datos-->
<?php require './assets/functions/connection.php'; ?>

<!-- Distribución -->
<div class="container">

  <!-- Inicio de la tarjeta -->
  <div class="card-panel">

    <!-- Cabecera de página de aplicaciones -->
    <h4 class="hide-on-med-and-down"><b>PASO 2:</b> Elige tu distribución.</h4>
    <div class="center-align">
      <h5 class="hide-on-large-only hide-on-small-only show-on-medium"><b>PASO 2:</b> Elige tu distribución.</h5>
      <h6 class="hide-on-med-and-up">Paso 2: Elige tu distribución.</h6>
    </div>

    <!-- Formulario de distribución -->
    <form role="form" name="Distribucion" id="Distribucion" method="post">

      <!-- Listado de las distribuciones -->
      <select name="listadoSelect" id="listadoSelect">
        <?php
          $listadoAplicacion = $_POST["listadoAplicacion"];
          foreach ($mysqli->query('SELECT * FROM distribucion') as $distribucion) {
            echo "<option value='".$distribucion['id']."'>".$distribucion['nombre_distribucion']."</option>";
          }
        ?>
      </select>

      <!-- Area donde se guardan las aplicaciones seleccionadas -->
      <textarea id="listadoAplicacion" name="listadoAplicacion" hidden readonly><?php echo $listadoAplicacion; ?></textarea>
      <br>

      <!-- Botón siguiente -->
      <center>
        <button class="btn waves-effect waves-light light-blue darken-4"
                type="submit">Siguiente
        </button>
      </center>
    </form>
    <!-- Fin formulario de distribución -->

  </div>
  <!-- Fin tarjeta -->

</div>
<!-- Fin sección 'Distribución' -->

<script type="text/javascript">
  $(document).ready(function(){
    $('select').formSelect();
  });
  $('#Distribucion').submit(function(event){
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "download.php",
      data: parametros,
      success: function(data) {
        $('#cuerpo').html(data);
      }
    });
    event.preventDefault();
  });
</script>
