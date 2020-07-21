<!-- Cuerpo del formulario de inicio de sesión -->
<div class="modal-content">
  <center>
    <span class="right modal-close" title="Cerrar"><i class="fas fa-times"></i></span>
    <img class="hide-on-small-only" src="assets/images/icon-128x128.png" alt="logo-ninite">
  </center><br>
  <div class="container">

    <!-- Formulario de inicio de sesión -->
    <form role="form" id="formularioInicio" name="formularioInicio" method="post">
      <div class="input-field">
        <i class="fas fa-user prefix"></i>
        <input class="validate" type="text" name="usuario" id="usuario" required>
        <label for="usuario">Correo o usuario</label>
      </div>
      <div class="input-field ">
        <i class="fas fa-unlock prefix"></i>
        <input class="validate" type="password" name="clave" id="clave" required>
        <label for="clave">Contraseña</label>
      </div>
      <div>
        <label style="float: right;"><a href="#" id="olvidar"><b>¿Olvidó su contraseña?</b></a></label><br>
      </div>
      <center>
        <div class="row" id="resultado">
          <button type="submit"
                  class="col s12 btn btn-large waves-effect light-blue darken-4">Iniciar sesión
          </button>
        </div>
      </center>
    </form>
    <!-- Fin formulario de inicio de sesión-->

  </div>
</div>
<!-- Fin cuerpo del formulario de inicio de sesión -->

<!-- Pie de página del formulario -->
<div class="modal-footer" style="background-color:#f2f2f2;">
  <center>
    <a href="#" id="registrar" class="btn-flat hide-on-small-only">¿No tienes cuenta? Regístrate!</a>
    <a href="#" id="registrar" class="btn-flat hide-on-med-and-up">Regístrate</a>
  </center>
</div>
<!-- Fin pie de página del formulario -->

<script>
  $('#formularioInicio').submit(function(event) {
    var parametros = $(this).serialize() + '&funcion=verifica';
    $.ajax({
      type: "POST",
      url: "assets/functions/functions.php",
      data: parametros,
      success: function(data) {
        $('#resultado').html(data);
      }
    });
    event.preventDefault();
  });
  $(document).on('click', '#olvidar', function() {
    $.ajax({
      url:"forget.php",
      success:function(data){
        $('#modal1').html(data);
      }
    });
  });
  $(document).on('click', '#registrar', function() {
    $.ajax({
      url:"register.php",
      success:function(data){
        $('#modal1').html(data);
      }
    });
  });
</script>
