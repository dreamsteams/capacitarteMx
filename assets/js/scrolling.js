$(document).ready(function() {

  var alturaInicio    = $("#inicio").height();
  var alturaInfo      = $("#informacion").height();
  var alturaGaleria   = $("#galeria").height();
  var alturaEquipo    = $("#equipo").height();
  var alturaNow = 0;

  var $cuerpo = $("html, body");

  $(".nav-inicio").click(function() {
    alturaNow = 0;
    $cuerpo.animate({scrollTop : 0}, 'slow');
  });

  $("#nav-nosotros").click(function() {
    var altura = alturaInicio;
    alturaNow = altura;
    $cuerpo.animate({scrollTop : altura}, 'slow');
  });

  $("#nav-portafolio").click(function(){
    var altura = (alturaInicio + alturaInfo + 135);
    alturaNow = altura;
    $cuerpo.animate({scrollTop : altura}, 'slow');
  });

  $("#nav-equipo").click(function(){
    var altura = (alturaInicio + alturaInfo + alturaGaleria + 270);
    alturaNow = altura;
    $cuerpo.animate({scrollTop : altura}, 'slow');
  });

  $("#nav-contacto").click(function(){
    var altura = (alturaInicio + alturaInfo + alturaGaleria + alturaEquipo + 290);
    alturaNow = altura;
    $cuerpo.animate({scrollTop : altura}, 'slow');
  });

});
