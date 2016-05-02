$(document).ready(function(){

	$.ajax({
		'url' : '/fotoPerfil/getAllUser/get',
		'type' : 'POST',
		'dataType' : 'JSON'
	})
	.done(function(response){
		$.each(response, function(index, objeto){
			$(".img-user").css({
				'background' : "url(../../../"+objeto.imagenPortada+")",
				'background-size' : 'cover',
				'background-position' : 'center'					
			});
		});
	});


	$("#changePortada").click(function(){
		$("#filePerfil").trigger('click');
	});

	$("#filePerfil").change(function(){		
		var formData = new FormData($("#formPerfil")[0]);

		$.ajax({
			url : '/fotoPerfil/imagenSave/save',
			type : 'POST',
			dataType : 'JSON',
			data: formData,
			cache: false,
			contentType: false,
			processData: false
		})
		.done(function(response){	
			console.log(response);
			if(response.status == 'success'){
				$(".img-user").css({
					'background' : "url(../../../"+response.imagenRuta+")",
					'background-size' : 'cover',
					'background-position' : 'center'					
				});
				alertify.success('Imagen de portada actualizada');
			}
			else if(response.status == 'invalid'){
				alertify.error('Error, el archivo no es una imagen valida');
			}
		})
		.always(function(){

		});
		$(this).val('');
	});

});