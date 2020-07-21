<!-- Cuerpo del formulario de registro -->
<div class="modal-content">
  <center>
    <span class="right modal-close" title="Cerrar"><i class="fas fa-times"></i></span>
    <img class="hide-on-small-only" src="assets/images/icon-128x128.png" alt="logo-ninite">
  </center><br>

  <!-- Formulario de registro -->
  <form role="form" id="formularioRegistro" name="formularioRegistro" method="post" autocomplete="off">
    <div class="row">
      <div class="col l6 m6 s12">
        <div class="input-field">
          <i class="fas fa-user prefix"></i>
          <input class="validate" type="text" name="usuario" id="usuario" pattern="[a-zA-Z0-9]+" required>
          <label for="usuario">Usuario</label>
          <span class="helper-text" data-error="Sin espacios vacíos." id="resultadoUsuario"></span>
        </div>
      </div>
      <div class="col l6 m6 s12">
        <div class="input-field">
          <i class="fas fa-envelope prefix"></i>
          <input class="validate" type="email" name="correo" id="correo" required>
          <label for="correo">Correo</label>
          <span class="helper-text" data-error="Formato inválido."></span>
        </div>
      </div>
      <div class="col l6 m6 s12">
        <div class="input-field">
          <i class="fas fa-unlock prefix"></i>
          <input class="validate" type="password" name="clave" id="clave" minlength="8" autocomplete="new-password" required>
          <label for="class">Contraseña</label>
          <span class="helper-text" data-error="Mínimo 8 caracteres."></span>
        </div>
      </div>
      <div class="col l6 m6 s12">
        <div class="input-field">
          <i class="fas fa-unlock prefix"></i>
          <input class="validate" type="password" name="clave2" id="clave2" minlength="8" autocomplete="new-password">
          <label for="class">Reingrese contraseña</label>
          <span class="helper-text" id="resultadoClave"></span>
        </div>
      </div>
    </div>
    <center>
      <div class="row" id="resultado">
        <button type="submit"
                class="col s12 btn btn-large waves-effect light-blue darken-4">Registrarse
        </button>
      </div>
    </center>
  </form>
  <!-- Fin formulario de registro -->

</div>
<!-- Fin cuerpo del formulario de registro -->

<!-- Pie de página del formulario -->
<div class="modal-footer" style="background-color:#f2f2f2;">
  <center>
    <a href="#" id="iniciar" class="btn-flat hide-on-small-only">¿Tienes cuenta? Inicia sesión</a>
    <a href="#" id="iniciar" class="btn-flat hide-on-med-and-up">Inicia sesión</a>
  </center>
</div>
<!-- Fin pie de página del formulario -->

<script>
  $(document).ready(function(){
    $('#usuario').keyup(function(){
      $.post("assets/functions/functions.php", {
        usuario: $('#usuario').val()
      }, function(response){
        $('#resultadoUsuario').fadeOut();
        setTimeout("finishAjax('resultadoUsuario', '"+escape(response)+"')", 400);
      });
      return false;
    });
  });
  $(document).ready(function(){
    $('#clave2').keyup(function(){
      $.post("assets/functions/functions.php", {
        clave: $('#clave').val(),
        clave2: $('#clave2').val()
      }, function(response){
        $('#resultadoClave').fadeOut();
        setTimeout("finishAjax('resultadoClave', '"+escape(response)+"')", 400);
      });
      return false;
    });
  });
  function finishAjax(id, response) {
    $('#'+id).html(unescape(response));
    $('#'+id).fadeIn();
  }
  $('#formularioRegistro').submit(function(event) {
    var parametros = $(this).serialize() + '&funcion=inserta';
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
</script>
