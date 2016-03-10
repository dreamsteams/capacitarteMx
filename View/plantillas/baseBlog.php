{%extends 'plantillas/baseBlogGral.php'%}

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
                  <p class="white-text text-center">Usuario<br>roger23@live.com</p>
              </div>
          </div>
      </div>
      <ul class="navbar-left-list">
          <li>
              <a>
                  <i class="fa fa-user"></i>
                  &nbsp;&nbsp;
                  <span>Perfil</span>
              </a>
          </li>
          <li class="active">
              <a>
                  <i class="fa fa-comments"></i>
                  &nbsp;&nbsp;
                  <span>Blog</span>
              </a>
          </li>
          <li>
              <a>
                  <i class="fa fa-book"></i>
                  &nbsp;&nbsp;
                  <span>Cursos</span>
              </a>
          </li>
          <li>
              <a href="/">
                  <i class="fa fa-reply"></i>
                  &nbsp;&nbsp;
                  <span>Salir</span>
              </a>
          </li>
      </ul>
  </aside>
  <div id="mask"></div>
  <div class="container-fluid" id="contenido">
      {%block contenido%} {% endblock %}
  </div>
{%endblock%}
