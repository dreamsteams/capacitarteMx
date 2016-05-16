$(document).ready(function(){

	$.ajax({
		'url' : '/fotoPerfil/getAllUser/get',
		'type' : 'POST',
		'dataType' : 'JSON'
	}).done(function(response){
		$(".img-user").css({
			'background' : "url(../../../"+response['fotoPortada'][0].imagenPortada+")",
			'background-size' : 'cover',
			'background-position' : 'center'
		});
		$("#imgPerfil").attr('src', '/'+response['fotoPerfil'][0].imagenPerfil);
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
	$("#changePerfil").click(function(){
		$("#filePerfilCircle").trigger('click');
	});

	$("#filePerfilCircle").change(function(){
		var formData = new FormData($("#formPerfilCircle")[0]);

		$.ajax({
			url : '/fotoPerfil/imagenPerfilSave/save',
			type : 'POST',
			dataType : 'JSON',
			data: formData,
			cache: false,
			contentType: false,
			processData: false
		})
		.done(function(response){
			if(response.status == 'success'){
				$("#imgPerfil").attr('src', '/'+response.imagenRuta);
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
