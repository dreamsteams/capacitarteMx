$(document).ready(function() {
  var $btnAll = $("#btn-all");
  var $btnRojo = $("#btn-rojo");
  var $btnAzul = $("#btn-azul");
  var $btnVerde = $("#btn-verde");

  $("#btns button").click(function(event) {
    $("#btns button").removeClass('galleryActive');
    $(this).addClass('galleryActive');
  });

  $btnAll.click(function(event) {
    $(".divp2").show('slow');
    $(".divp3").show('slow');
    $(".divp1").show('slow');
  });

  $btnRojo.click(function(event) {
    $(".divp2").hide('slow');
    $(".divp3").hide('slow');
    $(".divp1").show('slow');
  });

  $btnAzul.click(function(event) {
    $(".divp1").hide('slow');
    $(".divp3").hide('slow');
    $(".divp2").show('slow');
  });

  $btnVerde.click(function(event) {
    $(".divp1").hide('slow');
    $(".divp2").hide('slow');
    $(".divp3").show('slow');
  });
});
