<!-- Descarga -->
<div class="container">

  <!-- Inicio de la tarjeta -->
  <div class="card-panel">

    <!-- Cabecera de página de descarga -->
    <h4 class="hide-on-med-and-down"><b>PASO 3:</b> Descarga y sigue las instrucciones.</h4>
    <div class="center-align">
      <h5 class="hide-on-large-only hide-on-small-only show-on-medium"><b>PASO 3:</b> Descarga y sigue las instrucciones.</h5>
      <h6 class="hide-on-med-and-up">Paso 3: Descarga y sigue las instrucciones.</h6>
    </div>

    <!-- Area donde se guardan las aplicaciones seleccionadas -->
    <textarea id="textoGuardar" hidden readonly>
      <?php
        $listadoAplicacion = $_POST["listadoAplicacion"];
        switch ($_POST["listadoSelect"]) {
          case '1': $distribucion = "Debian"; break;
          case '2': $distribucion = "Fedora"; break;
          case '3': $distribucion = "Ubuntu"; break;
        }
        echo "\nDISTRIBUCIÓN: ".$distribucion.".\nLISTA DE APLICACIONES: ".$listadoAplicacion.".";
      ?>
    </textarea>
    <br>

    <!-- Botón siguiente -->
    <center>
      <button class="btn waves-effect waves-light light-blue darken-4"
              type="submit" id="siguiente" onclick="guardarTexto()">Descargar
      </button>
    </center>

  </div>
  <!-- Fin tarjeta -->

</div>
<!-- Fin sección 'Descarga' -->

<script type="text/javascript">
  function guardarTexto() {
    var textoEscribir = document.getElementById("textoGuardar").value;
    var archivoBlob = new Blob([textoEscribir], {type:'text/plain'});
    var nombreArchivo = "fichero.txt";
    var linkDescarga = document.createElement("a");
    linkDescarga.download = nombreArchivo;
    linkDescarga.innerHTML = "My Hidden Link";
    window.URL = window.URL || window.webkitURL;
    linkDescarga.href = window.URL.createObjectURL(archivoBlob);
    linkDescarga.onclick = destruirElemento;
    linkDescarga.style.display = "none";
    document.body.appendChild(linkDescarga);
    linkDescarga.click();
  }
  function destruirElemento(event) {
    document.body.removeChild(event.target);
  }
</script>
