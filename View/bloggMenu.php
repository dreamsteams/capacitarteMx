{%extends 'plantillas/baseBlog.php'%}
{%block title%} Bloggs {% endblock%}
{%block css%}
<link rel="stylesheet" media="all" href="/assets/css/css/blogMenu.css">
{%endblock%}

{%block contenido%}
  <div class="container-fluid" id="contenidoBlog">

    <div class="pagePosts">
      <!---<div class="row">
        <div class="col-md-3 col-md-offset-6 text-right">
          <label for="">Buscar Curso</label>
          <input type="text" name="name" value="" placeholder="Titulo del Curso" class="form-control">
        </div>
      </div>--->

      <div class="row" id="contPost">

        <div class="col-xs-6 col-md-4">
          <div class="card-post text-center" id="addPost">
            <center>
              <div>
                <label><span class="fa fa-plus"></span></label>
              </div>
              <h4><b>Añadir Curso</b></h4>
            </center>
          </div>
        </div>
        <div class="posters">

        <!-- ./Aqui se iran añadiendo los posts dinamicamente --->
        </div>

      </div>
    </div>

    <div class="pageAdd" hidden="hidden">
        <div class="form-group">
          <label for="">Titulo del curso</label>
          <input type="text" name="titulo" class="form-control" id="titulo">
        </div>
        <div class="form-group">
          <label for="">Fecha Inicio <label>
          <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio">
        </div>
        <div class="form-group">
          <label for="">Fecha Fin <label>
          <input type="date" name="fecha_fin" class="form-control" id="fecha_fin">
        </div>
        <div class="form-group">
          <label for="">Contenido</label>
          <textarea name="content" id="content" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
          <label>Elegir Imagen de Portada</label><br>
          <button type="button" class="btn btn-info btn-inline" id="selectFile">
            Seleccionar Archivo
          </button>
          <input type="text" name="name" value="" class="form-control" placeholder="No se ha seleccionado archivo" disabled>
          <form id="frm_post" enctype="multipart/form-data">
              <input type="file" accept="image/gif,image/jpeg,image/png" style="display:none;" name="file" id="file">
          </form>
        </div>
      <div class="text-right">
        <button type="button" name="button" class="btn btn-primary" id="send" name="send">
          Publicar
        </button>
        <button type="button" name="button" class="btn btn-primary" id="update" name="update" hidden="hidden">
          Actualizar
        </button>
        <button type="button" name="button" class="btn btn-warning">
          Limpiar
        </button>
        <button type="button" name="button" class="btn btn-danger" id="btnAddCancel">
          Cancelar
        </button>
      </div>
    </div>

  </div>
{%endblock%}

{%block js%}
 <script type="text/javascript" src="/assets/js/js/Create.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        var idCurso;

      $(".posters").on('click','button[name=btn-view]',function(event) {
          var $element = this;
         $.ajax({
             url:'/curso/setIdCurso/buscarPost',
             type:'JSON',
             method:'POST',
             data:{id:$($element).attr('data-id-post')}
         }).done(function(reponse){
             window.location='/blog/showPost/'+$($element).attr('data-id-post');
         }).fail(function(error,status,statusText){
             console.log(error);
             console.log(status);
             console.log(statusText);
         });
      });

      $("#addPost").click(function(event) {
        $(".pagePosts").fadeOut('slow');
        $(".pageAdd").removeAttr('hidden');
      });

      $("#btnAddCancel").click(function(event) {
        $(".pagePosts").show('slow');
        $(".pageAdd").attr('hidden', 'hidden');
      });

      $(".btnUpdatePost, .btnDelPost").hover(function() {
        $(this).css({
          'transition' : '0.4s',
          'opacity' : '1'
        });
      }, function() {
        $(this).css({
          'transition' : '0.4s',
          'opacity' : '0.5'
        });

      });
        $("#selectFile").click(function(e){
            e.preventDefault();
            $("#file").trigger('click');
            $("input[name=name]").attr('placeholder',"Seleccionaste un archivo");
        });
        $("#send").click(function(){
             var formData = new FormData($("#frm_post")[0]);
                formData.append('nombre',$("#titulo").val());
                formData.append('descripcion',$("#content").val());
                  formData.append('fecha_inicio',$("#fecha_inicio").val());
                  formData.append('fecha_fin',$("#fecha_fin").val());

                 $.ajax({
                    url:'/curso/save/guardar-curso',
                    method:'POST',
                    dataType:'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data:formData,
                    beforeSend: function(){
                            alertify.log("El curso se esta guardando");
                    },
                }).done(function(response){

                    alertify.success("El curso se guardo con exito");
                    //window.location="/blog/show/all";

                }).fail(function(error,status,statusText){
                    console.log(status);
                    console.log(error);
                    console.log(statusText);
                });
        });

        cargarPosts();

        function cargarPosts(){
            $.ajax({
                url:'/curso/showMe/cursos-actuales',
                method:'POST',
                dataType:"JSON",
                cache:false
            }).done(function(response){
                 console.log(response);
                $(".pagePosts > #contPost .posters").empty();
                $.each(response,function(index,object){
                    console.log(object);
                    elemento.Curso.id=object.id;
                    elemento.Curso.nombre=object.nombre;
                    elemento.Curso.descripcion=(object.descripcion);
                    elemento.Curso.ruta="/"+object.src;
                    elemento.Curso.fecha_inicio= object.created_at;
                    elemento.Curso.fecha_fin= object.fecha_fin;
                    $(".pagePosts > #contPost .posters").append(elemento.Curso.create());
                });
            }).fail(function(error,status,statusText){
                console.log(error);
                alertify.error(error.responseText.error);
                console.log(status);
                console.log(statusText);
            });
        }
        $(".pagePosts > #contPost .posters").on("click","button[name=btn-disabled]",function(){
            $.ajax({
                url:'/curso/disabled/deshabilitar-post',
                method:'POST',
                dataType:'JSON',
                data:{id:$(this).attr('data-id-post')},
                cache:false
            }).done(function(response){
                alertify.success("El post se elimino con exito");
                cargarPosts();

            }).fail(function(error,status,statusText){
                console.log(error);
                console.log(status);
                console.log(statusText);
            });
        });
        $(".pagePosts > #contPost .posters").on("click","button[name=btn-refresh]",function(){
            idCurso = $(this).attr('data-id-post');
            console.log($(this));
            $("#titulo").val($(".posters #title_post_"+idCurso).text());
            $("#content").val($(".posters #content_post_"+idCurso).attr('title').replace("Comentario:",""));
            $("#send").attr('hidden','hidden');
            $("#fecha_inicio").val(moment(fecha_inicio).format('YYYY-MM-DD'));
            $("#fecha_fin").val(moment(fecha_fin).format('YYYY-MM-DD'));
            $("#update").removeAttr('hidden');
            $(".pagePosts").fadeOut('slow');
            $(".pageAdd").removeAttr('hidden');

        });
        $("#update").click(function(){
            console.log(idCurso);
            var formData = new FormData($("#frm_post")[0]);
                formData.append('nombre',$("#titulo").val());
                formData.append('descripcion',$("#content").val());
                formData.append('fecha_inicio',$("#fecha_inicio").val());
                formData.append('fecha_fin',$("#fecha_fin").val());
                formData.append('id',idCurso);
                 $.ajax({
                    url:'/curso/update/update-curso',
                    method:'POST',
                    dataType:'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data:formData,
                }).done(function(response){

                    alertify.success("Se actualizo el curso con exito");

                }).fail(function(error,status,statusText){
                    console.log(status);
                    alertify.error(error);
                    console.log(statusText);
                });
        });
    });
  </script>
{%endblock%}

