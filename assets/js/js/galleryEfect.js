$(document).ready(function() {

	var $setBotones = function(id, nombre){
  		var query = 
  		"<button type='button' class='btn btn-success btn-lg wow btnPill fadeInDown' data-wow-delay='0.2s' data-ident='"+id+"'"+ 
  		"id='btn-"+id+"'>"+
         ""+nombre+""+
        "</button>";
        return query;
  	}

  	var $setImagen = function(id, ruta){
  		var query = 
  		"<div class='col-xs-4 col-md-3 imgseccion imgsec"+id+"'>"+
            "<div class='p'>"+
              "<img src='"+ruta+"' class='img-responsive img-thumbnail'>"+
            "</div>"+
          "</div>";
        return query;
  	}


	var secciones = new Array();
	$.ajax({
		url: '/portafolio/getIntoManage/getall',
		type: 'POST',
		dataType: 'JSON'
		})
		.done(function(response) {
			var $idSecc = new Array();
			$.each(response["secciones"], function(i, obj){
			  $.each(obj, function(e, secc){            
			    $("#btns").append($setBotones(secc['id'], secc['nombre']));
			    $idSecc.push(secc['id']);
			  });
			});
			
		  $.each(response['imagenes'], function(x, obj2){
		    if(obj2 != null){
				$.each(obj2, function(y, img){
			       $("#gpoGaleria").append($setImagen(img['seecionId'], img['imagenRuta']));
		      	});
		    }
		});
	});

	var $botones = $("#btns");

	$botones.on('click', '.btnPill', function(){
		$(".imgseccion").hide('slow');
		$(".imgsec"+$(this).data('ident')).show('slow');		
		$(".btnPill").removeClass('galleryActive');
		$("#btn-all").removeClass('galleryActive');
		$(this).addClass("galleryActive");
	});

	$("#btn-all").click(function(){
		$(".imgseccion").show('slow');
		$(".btnPill").removeClass('galleryActive');
		$(this).addClass("galleryActive");
	});

});