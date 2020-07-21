$(document).ready(function(){
  $('.sidenav').sidenav();
  $('.modal').modal();
});

$(document).on('click', '#iniciarSesion', function(){
  $.ajax({
    url:"login.php",
	  success:function(data){
      $('#modal1').html(data);
	   }
  });
});

if('serviceWorker' in navigator) {
  navigator.serviceWorker
          .register('service-worker.js')
          .then(function(registration) { console.log('La service worker se registró correctamente.'); })
          .catch(function(err) { console.log('El registro de la service worker falló: ', err); });
}