    <!-- Pie de página -->
    <footer class="page-footer blue-grey darken-4">
      <div class="container">
        <div class="row">
          <div class="col l9 m9 s12">
            <h5 class="white-text">NINITE FOR LINUX</h5>
            <p class="grey-text text-lighten-4">
              Sin hacer clic.<br>
              Sin barras de herramientas.<br>
              Sólo seleccionas tus aplicaciones y listo.
            </p>
          </div>
          <div class="col l3 m3 s12">
            <h5 class="white-text">MAPA</h5>
            <ul>
              <li><a href="./" class="white-text">Inicio</a></li>
              <li><a href="./contact.php" class="white-text" id="contacto">Contacto</a></li>
              <?php
                if (isset($_SESSION['id'])) {
                  echo "<li><a href='./exit.php' class='white-text'>Salir</a></li>";
                }
              ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
          <a href="http://www.johansolano.tk" target="_blank" class="grey-text text-lighten-4"><center>&copy; 2018 <strong>Johan Solano</strong></center></a>
        </div>
      </div>
    </footer>
    <!-- Fin del pie de página -->

  </body>
  <!-- Fin de la etiqueta 'body' -->

</html>
<!-- Fin de la etiqueta 'html' -->
