{%extends 'plantillas/baseBlogGral.php'%}

<<<<<<< HEAD
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
=======
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
                <li class="active">
                    <a>
                        <i class="fa fa-comments"></i>
                        <span>Todos los blogs</span>
                    </a>
                </li>
                <li>
                    <a>
                        <i class="fa fa-user"></i>
                        <span>Perfil</span>
                    </a>
                </li>
                <li>
                    <a>
                        <i class="fa fa-reply"></i>
                        <span>Salir</span>
                    </a>
                </li>
                <li class="toggle-menu">
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
      <!-- Zona de Contenido general -->


      <!-- Footer principal general -->

<!-- Fin de contenido-->

    <!-- JS -->
    <script type="text/javascript" src="/assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.validate.min.js"></script>
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
    {% block js %}{% endblock%}
    <!-- FIN JS-->
</body>
</html>
>>>>>>> master
