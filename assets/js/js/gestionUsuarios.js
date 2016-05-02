$(document).ready(function(){

	var $tabla = $('#tabla-profesores');

	var usuario = {
		getAll : function(){
			$.ajax({
				url : '/usuario/mostrar/mostrar',
				type : 'POST',
				dataType : 'JSON'
			})
			.done(function(response){
				if(response.length != 0){
			      var datos = [];
			      $.each(response, function(index, obj){
			        datos.push({
			          'nombre' : response[index].nombre+" "+response[index].apellido_paterno+" "+response[index].apellido_materno,
			          'nombre_user' : response[index].nombre,
			          'apellido_paterno' : response[index].apellido_paterno,
			          'apellido_materno' : response[index].apellido_materno,
			          'email' : response[index].email,
			          'id' : response[index].id
			        });
			      });			      
			      $('#tabla-profesores').bootstrapTable({
			        data : datos
			      });

			    }
			})
			.fail(function(error){
				console.log(error);
			});
		},
		setUpdate : function(id, nombre, ape_p, ape_m, email){
			$("#txtNombre").val(nombre);
			$("#txtApellidoP").val(ape_p);
			$("#txtApellidoM").val(ape_m);
			$("#txtEmail").val(email);
			$("#btnFormOk").data('type', id);
			$("#modalUser").modal('show');
		},
		update : function(id){
			$("#formularioUsers").validate({
                rules:{
                    txtNombre:{
                        required:true
                    },
                    txtApellidoP:{
                        required:true
                    },
                    txtEmail:{
                        email:true,
                        required:true
                    }
                }
            });

			if($("#formularioUsers").valid()){
				var datos = {
					id : id, 
					nombre : $("#txtNombre").val(),
					apellido_paterno :	$("#txtApellidoP").val(),
					apellido_materno :	$("#txtApellidoM").val(),
					email :	$("#txtEmail").val()
				}
				$("#btnFormOk").modal('hide');
				$.ajax({
					url : '/usuario/updateUser/update',
					type : 'POST',
					dataType : 'JSON',
					data : datos
				})
				.done(function(response){				
					window.location.href = response[0];
				})
				.fail(function(error){
					console.log(error);
				});
			}
		},
		remove : function($id){
			alertify.confirm("¿Esta usted seguro de eliminar el usuario?", function (e) {
				if (e) {
					var datos = {
						id : $id
					}			
					$.ajax({
						url : '/usuario/removeUser/remove',
						type : 'POST',
						dataType : 'JSON',
						data : datos
					})
					.done(function(response){										
						window.location.href = response[0];
						// alertify.success("Eliminado correctamente. Espere un momento.");
					})
					.fail(function(error){
						console.log(error);
					});					
				} else {
					// alertify.error("Se ha cancelado la operación");
				}
			});
		}
	}

	// Traemos a todos los usuarios
	// y los colocamos en la table
	// de forma dinamica
	usuario.getAll();

	// Variable auxiliar para 
	// guardar datos de identificacion
	var aux;

	// Click en el boton de actualizar
	$("#actualizar").click(function(){		
		if($tabla.bootstrapTable('getSelections').length != 0){			
			aux = $tabla.bootstrapTable('getSelections')[0].id;
			var nombre = $tabla.bootstrapTable('getSelections')[0].nombre_user;
			var apep = $tabla.bootstrapTable('getSelections')[0].apellido_paterno;
			var apem = $tabla.bootstrapTable('getSelections')[0].apellido_materno;
			var email = $tabla.bootstrapTable('getSelections')[0].email;
			usuario.setUpdate(aux, nombre, apep, apem, email);
		}
		else{
			alertify.error("No se ha seleccionado ningun usuario");
		}
	});

	// Click en el boton de eliminar
	$("#eliminar").click(function(){
		if($tabla.bootstrapTable('getSelections').length != 0){
			var id = $tabla.bootstrapTable('getSelections')[0].id;
			usuario.remove(id);			
		}
		else{
			alertify.error("No se ha seleccionado ningun usuario");
		}
	});

	// Click en el boton de guardar en el modal
	$("#btnFormOk").click(function(){
		aux = $(this).data('type');
		usuario.update(aux);
	});
});







