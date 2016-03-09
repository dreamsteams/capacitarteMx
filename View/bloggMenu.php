{%extends 'plantillas/baseBlog.php'%}
{%block title%} Bloggs {% endblock%}
{%block css%}
<link rel="stylesheet" media="all" href="../../assets/css/css/blogMenu.css">
{%endblock%}

{%block contenido%}
  <div class="container-fluid" id="contenidoBlog">

    <div class="pagePosts">
      <div class="row">
        <div class="col-md-3 col-md-offset-6 text-right">
          <label for="">Buscar Post</label>
          <input type="text" name="name" value="" placeholder="Titulo de Post" class="form-control">
        </div>
      </div>

      <div class="row">

        <div class="col-xs-6 col-md-4">
          <div class="card-post text-center" id="addPost">
            <center>
              <div>
                <label>+</label>
              </div>
              <h4><b>Añadir Post</b></h4>
            </center>
          </div>
        </div>

        <div class="col-xs-6 col-md-4">
            <div class="col-xs-12 text-right">
              <div class="actionButtons">
                <button type="button" name="button" class="btn btn-info btn-fab btnUpdatePost">
                  <span class="fa fa-refresh"></span>
                </button>
                <button type="button" name="button" class="btn btn-danger btn-fab btnDelPost">
                  <span class="fa fa-trash-o"></span>
                </button>
              </div>
            </div>
          <div class="card-post push-post text-center">
            <img src="../../assets/images/blog/portadas/p1.jpg" alt="" class="img-responsive">
            <h5>Titulo del post</h5>
          </div>
        </div>

        <div class="col-xs-6 col-md-4">
          <div class="col-xs-12 text-right">
            <div class="actionButtons">
              <button type="button" name="button" class="btn btn-info btn-fab btnUpdatePost">
                <span class="fa fa-refresh"></span>
              </button>
              <button type="button" name="button" class="btn btn-danger btn-fab btnDelPost">
                <span class="fa fa-trash-o"></span>
              </button>
            </div>
          </div>
          <div class="card-post push-post text-center">
            <img src="../../assets/images/blog/portadas/img (35).jpg" alt="" class="img-responsive">
            <h5>Titulo del post</h5>
          </div>
        </div>

        <div class="col-xs-6 push-post col-md-4">
          <div class="col-xs-12 text-right">
            <div class="actionButtons">
              <button type="button" name="button" class="btn btn-info btn-fab btnUpdatePost">
                <span class="fa fa-refresh"></span>
              </button>
              <button type="button" name="button" class="btn btn-danger btn-fab btnDelPost">
                <span class="fa fa-trash-o"></span>
              </button>
            </div>
          </div>
          <div class="card-post text-center">
            <img src="../../assets/images/blog/portadas/img (37).jpg" alt="" class="img-responsive">
            <h5>Titulo del post</h5>
          </div>
        </div>

        <div class="col-xs-6 push-post col-md-4">
          <div class="col-xs-12 text-right">
            <div class="actionButtons">
              <button type="button" name="button" class="btn btn-info btn-fab btnUpdatePost">
                <span class="fa fa-refresh"></span>
              </button>
              <button type="button" name="button" class="btn btn-danger btn-fab btnDelPost">
                <span class="fa fa-trash-o"></span>
              </button>
            </div>
          </div>
          <div class="card-post text-center">
            <img src="../../assets/images/blog/portadas/img (33).jpg" alt="" class="img-responsive">
            <h5>Titulo del post</h5>
          </div>
        </div>

      </div>
    </div>

    <div class="pageAdd" hidden="hidden">
      <form action="">
        <div class="form-group">
          <label for="">Titulo del post</label>
          <input type="text" class="form-control" id="">
        </div>
        <div class="form-group">
          <label for="">Contenido</label>
          <textarea name="name" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
          <label>Elegir Imagen de Portada</label><br>
          <button type="button" class="btn btn-info btn-inline">
            Seleccionar Archivo
          </button>
          <input type="text" name="name" value="" class="form-control" placeholder="No se ha seleccionado archivo" disabled>
        </div>
      </form>
      <div class="text-right">
        <button type="button" name="button" class="btn btn-primary">
          Aceptar
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
  <script type="text/javascript">
    $(document).ready(function() {
      $(".push-post").click(function(event) {
        document.location.href = "/capacitarteMx-master/blog/showPost/post";
      });

      $("#addPost").click(function(event) {
        $(".pagePosts").fadeOut('slow');
        $(".pageAdd").removeAttr('hidden')
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

    });
  </script>
{%endblock%}
