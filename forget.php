<!-- Cuerpo del formulario de recuperar contraseña -->
<div class="modal-content">
  <center>
    <span class="right modal-close" title="Cerrar"><i class="fas fa-times"></i></span>
    <img class="hide-on-small-only" src="assets/images/icon-128x128.png" alt="logo-ninite">
  </center><br>
  <div class="container">

    <!-- Formulario de recuperar contraseña -->
    <form role="form" id="formularioOlvido" name="formularioOlvido" method="post">
      <div class="input-field">
        <i class="fas fa-user prefix"></i>
        <input class="validate" type="text" name="usuario" id="usuario" required>
        <label for="usuario">Usuario</label>
      </div>
      <div class="input-field">
        <i class="fas fa-envelope prefix"></i>
        <input class="validate" type="email" name="correo" id="correo" required>
        <label for="correo">Correo</label>
        <span class="helper-text" data-error="Formato inválido."></span>
      </div>
      <center>
        <div class="row" id="resultado">
          <button type="submit"
                  class="col s12 btn btn-large waves-effect light-blue darken-4">Recuperar
          </button>
        </div>
      </center>
    </form>
    <!-- Fin formulario de registro -->

  </div>
</div>
<!-- Fin cuerpo del formulario de recuperar contraseña -->

<!-- Pie de página del formulario -->
<div class="modal-footer" style="background-color:#f2f2f2;">
  <a href="#" id="iniciar" class="btn-flat left hide-on-small-only">¿Tienes cuenta? Inicia sesión</a>
  <a href="#" id="registrar" class="btn-flat right hide-on-small-only">¿No tienes cuenta? Regístrate</a>
  <center>
    <a href="#" id="iniciar" class="btn-flat hide-on-med-and-up">Inicia sesión</a>
    <a href="#" id="registrar" class="btn-flat hide-on-med-and-up">Regístrate</a>
  </center>
</div>
<!-- Fin pie de página del formulario -->

<script>
  $('#formularioOlvido').submit(function(event) {
    var parametros = $(this).serialize() + '&funcion=recupera';
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
  $(document).on('click', '#iniciar', function(){
    $.ajax({
      url:"login.php",
      method:"POST",
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
