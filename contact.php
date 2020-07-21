<?php require( dirname( __FILE__ ) . '/header.php' ); ?>
  <main>
    <div class="section">

      <!-- Contacto -->
      <div class="container" id="contactoSection">

        <!-- Inicio de tarjeta -->
        <div class="card-panel">

          <!-- Cabecera de página de contacto -->
          <h3 class="hide-on-med-and-down">Si tienes dudas contáctanos</h3>
          <h4 class="hide-on-large-only hide-on-small-only show-on-medium center-align">Si tienes dudas contáctanos</h4>
          <h5 class="hide-on-med-and-up center-align">Si tienes dudas contáctanos</h5>
          <p class="flow-text hide-on-med-and-down">Puedes rellenar el siguiente formulario de contacto</p>
          <p class="flow-text hide-on-large-only center-align">Puedes rellenar el siguiente formulario de contacto</p>
          <br>

          <!-- Formulario de contacto -->
          <form role="form">
            <div class="row">
              <div class="input-field col l4 m6 s12">
                <i class="fas fa-user prefix"></i>
                <input id="nombre" type="text" class="validate" required>
                <label for="nombre">Nombre</label>
              </div>
              <div class="input-field col l4 m6 s12 hide-on-small-only">
                <i class="fas fa-phone fa-rotate-90 prefix"></i>
                <input id="telefono" type="tel" class="validate">
                <label for="telefono">Telefóno</label>
              </div>
              <div class="input-field col l4 s12">
                <i class="fas fa-envelope prefix"></i>
                <input id="correo" type="email" class="validate" required>
                <label for="correo">Correo</label>
              </div>
              <div class="input-field col l12 s12">
                <i class="fas fa-comment-alt prefix"></i>
                <textarea id="mensaje" class="materialize-textarea validate" required></textarea>
                <label for="mensaje">Mensaje</label>
              </div>
              <button class="btn-large col l4 s12 waves-effect waves-light right light-blue darken-4"
                      type="submit" name="enviar"><b>Enviar</b>
                      <i class="fas fa-paper-plane"></i>
              </button>
            </div>

          </form>
          <!-- Fin formulario de contacto -->

          <br>

          <!-- Otros medios de contacto -->
          <p class="flow-text">O bien, puedes contactar a través de los siguientes enlaces</p>
          <div class="row center-align">
            <div class="col l3 m6 s12">
              <i class="fab fa-instagram" style="color: #231f20;"></i><a href="#"> @instagram</a>
            </div>
            <div class="col l3 m6 s12">
              <i class="fab fa-facebook" style="color: #4267b2;"></i><a href="#"> facebook</a>
            </div>
            <div class="col l3 m6 s12">
              <i class="fab fa-twitter" style="color: #55acee;"></i><a href="#"> @twitter</a>
            </div>
            <div class="col l3 m6 s12">
              <i class="fab fa-skype" style="color: #00aff0;"></i><a href="#"> skype</a>
            </div>
          </div>
          <br>

        </div>
        <!-- Fin tarjeta -->

      </div>
      <!-- Fin sección 'Contacto' -->

    </div>
  </main>
<?php require( dirname( __FILE__ ) . '/footer.php' ); ?>
