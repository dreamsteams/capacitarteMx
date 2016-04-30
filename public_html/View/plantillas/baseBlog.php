<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html;">
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- FIN META -->
    <title>{% block title %}{%endblock%}</title>
    <!-- Estilos-->
    <link rel="stylesheet" media="all" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" media="all" href="/assets/css/mdb.min.css">
    <link rel="stylesheet" media="all" href="/assets/css/roboto.min.css">
    <link rel="stylesheet" media="all" href="/assets/css/alertify.core.css">
    <link rel="stylesheet" media="all" href="/assets/css/alertify.default.css">
    <link rel="stylesheet" media="all" href="/assets/css/material-fullpalette.min.css">
    <link rel="stylesheet" media="all" href="/assets/css/ripples.min.css">
    <link rel="stylesheet" media="all" href="/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" media="all" href="/assets/css/animate.min.css">
    <link rel="stylesheet" media="all" href="/assets/css/css/baseBlog.css">
    <link rel="stylesheet" media="all" href="/assets/css/css/responsiveBlogBase.css">
    {% block css %}{% endblock %}
    <!-- fin de estilos-->
</head>
<body>
<!-- Contenido de lapagina-->
    <!--Header-->
    <header class="my_navbar hoverable">
       <div class="logo">
           <img src="../../assets/images/logo.png" width="60%" class="img-responsive">
       </div>
         <ul class="migas">
             <li class="active">
                <a href="/blog/show/all">
                   &nbsp;
                   <i class="fa fa-home"></i>
                   <span>Cursos</span>
                 </a>
                 &nbsp;
                 <i class="fa fa-chevron-right"></i>
             </li>

         </ul>
    </header>


{%block addContent%}
<!-- Barra lateral izquierda con menu y estatus -->
  <aside id="myaside" class="navbar_left   hoverable">
     <!--<div class="img-user view overlay hm-blue-light">
         <img src="assets/Imagenes/image-perfil/avatar04.png" class="img-circle img-responsive"/>
         <span>Roger</span>
     </div>-->
      <div class="img-user view overlay hm-orange-slight">
          <img src="/assets/images/image-perfil/avatar04.png"  class="img-circle img-responsive" alt="">
          <div class="mask">
              <div class="verticalcenter">
                  <p class="white-text text-center">Usuario<br>{{ session['nombre'] }}</p>
              </div>
          </div>
      </div>
      <ul class="navbar-left-list">
          <li>
              <a href="/">
                  <i class="fa fa-home"></i>
                  &nbsp;&nbsp;
                  <span>Inicio</span>
              </a>
          </li>
         {% if role == 'administrador'  %}
          <li id="register_user">
              <a>
                  <i class="fa fa-users"></i>
                  &nbsp;&nbsp;
                  <span>Registro</span>
              </a>
          </li>
          <li id="user_assigned">
              <a>
                  <i class="fa fa-cubes"></i>
                  &nbsp;&nbsp;
                  <span>Asignar Curso</span>
              </a>
          </li>
          {% endif %}
          <li>
              <a href="blog/show/cursos">
                  <i class="fa fa-book"></i>
                  &nbsp;&nbsp;
                  <span>Cursos</span>
              </a>
          </li>
          <li>
              <a href="/login/logout/cerrar-sesion">
                  <i class="fa fa-reply"></i>
                  &nbsp;&nbsp;
                  <span>Salir</span>
              </a>
          </li>
          <li class="toggle-menu" >

                    <a>
                        <i class="fa fa-paint-brush"></i>
                        <span>Temas</span>
                        <i class="fa fa-chevron-left"></i>
                    </a>
          </li>
                <ul class="navbar-left-sublist">
                       <li>
                           <a>
                              <i class="fa fa-circle-o"></i>
                              <span>Azul</span>
                              <span class="color blue"></span>
                            </a>
                        </li>
                         <li>
                           <a>
                              <i class="fa fa-circle-o"></i>
                              <span>Amarillo</span>
                              <span class="color yellow"></span>
                            </a>
                        </li>

                       <li>
                           <a>
                              <i class="fa fa-circle-o"></i>
                              <span>Morado</span>
                              <span class="color purple"></span>
                            </a>
                        </li>
                        <li>
                           <a>
                              <i class="fa fa-circle-o"></i>
                              <span>Negro</span>
                              <span class="color black"></span>
                            </a>
                        </li>
                        <li>
                           <a>
                              <i class="fa fa-circle-o"></i>
                              <span>Rojo</span>
                              <span class="color red"></span>
                            </a>
                        </li>
                        <li>
                           <a>
                              <i class="fa fa-circle-o"></i>
                              <span>Verde</span>
                              <span class="color green"></span>
                            </a>
                        </li>
                        <li>
                           <a>
                              <i class="fa fa-circle-o"></i>
                              <span>Naranja</span>
                              <span class="color orange"></span>
                            </a>
                        </li>
                    </ul>
      </ul>
  </aside>
  <div id="mask"></div>
  <div class="container-fluid" id="contenido">
      {%block contenido%} {% endblock %}
  </div>
  <!-- Modal Registro usuario -->
    <div class="modal fade" id="modal_register_user" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" id="close_modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Registro de Usuario</h4>
          </div>
          <div class="modal-body">
            <div class="row" id="sec_data_person">
                <form class="col-md-12" id="frm_data_person">
                  <div class="row">
                   <div class="form-group col-md-4">
                      <label for="">Nombre</label>
                      <input type="text" name="nombre" class="form-control" id="nombre">
                   </div>
                   <div class="form-group col-md-4">
                      <label for="">Apellido Paterno</label>
                      <input type="text" name="apellido_paterno" class="form-control" id="apellido_paterno">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">Apellido Materno</label>
                      <input type="text" name="apellido_materno" class="form-control" id="apellido_materno">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="">Contraseña</label>
                      <input type="password" name="password" class="form-control" id="password">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="">Email</label>
                      <input type="text" name="email" class="validate form-control" id="email">
                    </div>
                  </div>
                </form>
            </div>
         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-action="save" id="reg_user">Registrar</button>
          </div>
        </div>
      </div>
    </div>
    <!--Fin de modal de registro--->
    <!--Modal de asignación de cursos--->
    <div class="modal fade" id="modal_assigned_user" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" id="close_modal_assigned" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Registro de Usuario</h4>
          </div>
          <div class="modal-body">
              <select id="users" class="form-control">
                  <!---Se llenara dinamicamente --->
              </select>
              <br><br>
              <div class="row">
                  <div id="cursos" class="col-md-12">
                  </div>
              </div>
         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-action="save" id="reg_user"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <div id="preview-template" style="display: none;">
{%endblock%}

      <!-- Zona de Contenido general -->


      <!-- Footer principal general -->

<!-- Fin de contenido-->

    <!-- JS -->
    <script type="text/javascript" src="/assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/css/mdb.min.css"></script>
    <script type="text/javascript" src="/assets/js/ripples.min.js"></script>
    <script type="text/javascript" src="/assets/js/wow.min.js"></script>
    <script type="text/javascript" src="/assets/js/waves-effect.js"></script>
    <script type="text/javascript" src="/assets/js/buttons.js"></script>
    <script type="text/javascript" src="/assets/js/app.js"></script>
    <script type="text/javascript" src="/assets/js/js/baseBlog.js"></script>
    <script type="text/javascript" src="/assets/js/js/blog.js"></script>
    <script type="text/javascript" src="/assets/js/moment.js"></script>
    <script type="text/javascript" src="/assets/js/es.js"></script>
    <script type="text/javascript" src="/assets/libs/validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/assets/libs/validation/localization/messages_es.min.js"></script>
    <script type="text/javascript" src="/assets/js/alertify.js"></script>
    <script type="text/javascript">
       $(document).on('ready',__init);

        function __init(){

             /*---------------------------------
             | Primera validación del form para
             | datos personales
             -----------------------------------*/
             $("#frm_data_person").validate({
                 rules:{
                     nombre:{
                         required:true
                     },
                     apellido_paterno:{
                         required:true
                     },
                     apellido_materno:{
                         required:true
                     },
                     password:{
                         required:true
                     },
                     email:{
                         email:true,
                         required:true
                     }
                 }
             });
            cargarUsuariosAssigned();
            function cargarUsuariosAssigned(){
                $.ajax({
                    url:'/usuario/mostrar/mostrar-usuarios',
                    method:'POST',
                    dataType:'JSON'
                }).done(function(response){
                    $.each(response,function(i,objeto){
                        var $opt = $("<option/>").val(objeto.id).text(objeto.nombre+' '+objeto.apellido_paterno);
                        $("#users").append($opt);
                    });
                }).fail(function(error){
                    console.log(error);
                });
            }
            cargarCursos();
            function cargarCursos(){
                $.ajax({
                    url:'/curso/showMe/mostrar-cursos',
                    method:'POST',
                    dataType:'JSON'
                }).done(function(response){
                    var checkbox = {
                        create:function(id,label){
                         return "<input type='checkbox' id="+id+"  /> <label for="+id+">"+label+"</label><br>";
                        }
                    }
                    $.each(response,function(i,objeto){
                        $("#cursos").append(checkbox.create(objeto.id,objeto.nombre));
                    });
                }).fail(function(error){
                    console.log(error);
                });
            }
            //-----------------------------------
                //------ CLOUSHURES -----------
            //----------------------------------
            $("#register_user").click(function(){
                $("#modal_register_user").modal('show');
            });

            $("#user_assigned").click(function(){
                $("#modal_assigned_user").modal('show');
            });


             $("#reg_user").click(function(){
                   var $btn = this;
                   if($("#frm_data_person").valid()){
                       $.ajax({
                           url:'/usuario/save/register-user',
                           method:'POST',
                           dataType:'JSON',
                           data:$("#frm_data_person").serialize()
                       }).done(function(response){
                          alertify.success(response.message);
                       }).fail(function(error,status,statusText){
                           alertify.error(error);
                           console.log(status);
                           console.log(statusText);
                       });
                   }
            });


            $("#close_modal").click(function(){
                $("#profile").attr('disabled',true);
                $("#data_person").trigger('click');
                $("#frm_data_person").trigger('reset');
                $("#frm_profile").trigger('reset');
                $("#modal_register_user").modal('hide');
            });

            $("#close_modal_assigned").click(function(){
                $("#modal_assigned_user").modal('hide');
            });


        }

    </script>

    {% block js %}{% endblock%}
    <!-- FIN JS-->
</body>
</html>