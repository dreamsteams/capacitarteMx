$(document).ready(function(){

  var $portafolio = {
    getAll : function(){
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
            $("#zonaSecciones").append($portafolio.seccion.get(secc['nombre'], secc['id']));            
            $idSecc.push(secc['id']);
          });
        });

        $.each($idSecc, function(index, id){          
          $.each(response['imagenes'], function(x, obj2){ 
            if(obj2 != null){
              $.each(obj2, function(y, img){
                if(id == img['seecionId']){
                  $("#"+id).append($portafolio.imagen.setImagen("/"+img['imagenRuta'], img['imagenId']));
                }
              });
            }
          });
        });
      });
    },
    seccion : {
      get : function(nombre, id){
        var newSecc =
        "<div class='row seccionPortafolio' data-id-seccion='"+id+"' id='secc"+id+"'>"+
          "<h5 class='section_name'><b id='title"+id+"'>"+nombre+"</b></h5>"+
          "<button type='button' class='btn btn-info btnAddImagen' data-id-seccion='"+id+"'>Agregar imagen</button>"+
          "<div class='contenidos' id='"+id+"'>"+
          "</div>"+
          "<div class='row'>"+
          "<br>"+
          "<div class='col-md-12 text-right'>"+
            "<i class='fa fa-refresh adminBtns adminBtnsRefresh' data-id-seccion='"+id+"' id='secUpdate"+id+"' data-name-seccion='"+nombre+"'></i>"+
            "&nbsp;"+
            "<i class='fa fa-trash adminBtns adminBtnsDelete' data-id-seccion='"+id+"'></i>"+
          "</div>"+
        "</div>"+
        "</div>";
        // return newSecc;
        $("#tabla tbody").append(newSecc);
      },
      resetForm : function(){
        $("#txtNombre").val("");
      },
      agregar : function(){
        $("#modalAdd").modal('show');
      },
      guardar : function(nombre){
        var datos = {
          nombre : nombre
        };
        $.ajax({
          url: '/portafolio/sectionSave/save',
          type: 'POST',
          dataType : 'JSON',
          data: datos
        })
        .done(function(response) {
          alertify.success("¡Sección creada correctamente!");
          $("#zonaSecciones").append($portafolio.seccion.get(nombre, response[1][0].Last));
          $portafolio.seccion.resetForm();
        });        
      },
      eliminar : function(id){
        alertify.confirm("¿Esta usted seguro de eliminar la sección del portafolio?", function (e) {
        if (e) {
          var datos = {
            id : id
          };
          $.ajax({
            url: '/portafolio/sectionDelete/delete',
            type: 'POST',
            dataType : 'JSON',
            data: datos
          })
          .done(function(response) {
            if(response[0] == "success"){
              $("#secc"+id).hide('slow', function(){
                alertify.success("¡Sección eliminada correctamente!");
                $(this).remove();
              });
            }
          });
        } else {
            alertify.error("Se ha cancelado la operación");
          }
        });
      },
      actualizar : function(id, nombre){        
        var datos = {
          id : id,
          nombre : nombre
        };
        $.ajax({
          url: '/portafolio/sectionUpdate/update',
          type: 'POST',
          dataType : 'JSON',
          data: datos
        })
        .done(function(response) {
          if(response[0] == "success"){
            alertify.success("¡Sección actualizada correctamente!");
            $("#secUpdate"+id).data("name-seccion", nombre);
            $("#title"+id).html(nombre);
          }
        });
      }, 
      cancelar : function(){
        this.resetForm();
      }
    },
    imagen : {
      setImagen : function(dir, id){
        var query =        
          "<div class='col-sm-4 img-box' id='img"+id+"'>"+
            "<span class='fa fa-trash fa-2x remove-btn' data-imagen='"+id+"'></span>"+
            "<img src='"+dir+"' class='img-responsive img-thumbnail' />"+
          "</div>";
        return query;
      },
      agregar : function(){
        $("#foto").trigger("click");
      },
      guardar : function(id){
        var formData = new FormData($("#formFoto")[0]);
        formData.append('id', id);
        $.ajax({
          url: "/portafolio/imagenSave/save",
          type: 'POST',
          data: formData,          
          dataType: 'JSON',
          cache: false,
          contentType: false,
          processData: false
        })
        .done(function(response){          
          alertify.success("Imagen agregada correctamente!");
          $("#"+id).append($portafolio.imagen.setImagen(response.imagenRuta, response.imagenId));
        });
        $("#foto").val("");
      },
      eliminar : function(id){
        alertify.confirm("¿Esta usted seguro de eliminar la imagen de la sección?", function (e) {
        if (e) {
          var datos = {
            id : id
          };
          $.ajax({
            url: '/portafolio/imagenDelete/remove',
            type: 'POST',
            dataType : 'JSON',
            data: datos
          })
          .done(function(response) {
            alertify.success("Imagen eliminada correctamente!");
            $("#img"+id).hide('slow', function(){
              $(this).remove();
            });
          });
        } else {
            alertify.error("Se ha cancelado la operación");
          }
        });
      }
    }
  }


  // Variable para guardar los IDs
  var myid;

  // Obtenemos todas las secciones y las imagenes de cada una
  // poniendolas en pantalla al momento de iniciar
  $portafolio.getAll();

  // Click para agregar una nueva seccion
  $("#btnAddSeccion").click(function(){
    $("#btnFormOk").data('type', 'add');
    $portafolio.seccion.agregar();
  });  

  // Click para agregar imagen
  $("#zonaSecciones").on('click', '.seccionPortafolio > .btnAddImagen', function(){
    myid = $(this).data('id-seccion');
    $portafolio.imagen.agregar();
  });

  // Click para eliminar una seccion
  $("#zonaSecciones").on('click', '.seccionPortafolio > div > div > .adminBtnsDelete', function(){
    myid = $(this).data('id-seccion');
    $portafolio.seccion.eliminar(myid);
  });

  // Click para actualizar una seccion
  $("#zonaSecciones").on('click', '.seccionPortafolio > div > div > .adminBtnsRefresh', function(){
    var nombre = $(this).data('name-seccion');
    $("#btnFormOk").data('type', 'update');
    $("#txtNombre").val(nombre);
    myid = $(this).data('id-seccion');
    $portafolio.seccion.agregar();
  });

  // Guardar una imagen en una seccion
  $("#foto").on('change', function(){
    $portafolio.imagen.guardar(myid);
  });

  // Click en el boton cancelar del modal de registro
  $("#btnFormCancel").click(function(){
    $portafolio.seccion.cancelar();
  });

  // Click al momento de guardar la informacion una seccion
  $("#btnFormOk").click(function(){
    if($(this).data('type') == 'add'){
      var nombre = $("#txtNombre").val();
      $portafolio.seccion.guardar(nombre);
    }
    else if($(this).data('type') == 'update'){
      var nombre = $("#txtNombre").val();
      $portafolio.seccion.actualizar(myid, nombre);
    }
  });

  // Click al momento de eliminar una imagen
  $("#zonaSecciones").on('click', ".seccionPortafolio > .contenidos > .img-box > .remove-btn", function(){
    myid = $(this).data('imagen');
    $portafolio.imagen.eliminar(myid);
  });



});
