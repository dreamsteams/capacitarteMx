<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{% block title %}{%endblock%}</title>
    <link rel="stylesheet" media="all" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" media="all" href="/assets/css/mdb.min.css">
    <link rel="stylesheet" media="all" href="/assets/css/roboto.min.css">
    <link rel="stylesheet" media="all" href="/assets/css/material-fullpalette.min.css">
    <link rel="stylesheet" media="all" href="/assets/css/ripples.min.css">
    <link rel="stylesheet" media="all" href="/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" media="all" href="/assets/css/animate.min.css">
    <link rel="stylesheet" media="all" href="/assets/css/css/baseBlog.css">
    <link rel="stylesheet" media="all" href="/assets/css/css/responsiveBlogBase.css">
    {% block css %}{% endblock %}
</head>
<body>
  <!--Header-->
  <header class="my_navbar hoverable">
     <div class="logo">
        <img src="/assets/images/logo.png" width="60%" class="img-responsive">
     </div>
      <div class="navbar_header hoverable">
         <div class="btnToggle" id="btn-navbar-left">
            <i class="fa fa-navicon fa-2x"></i>
          </div>
       </div>
       <ul class="migas">
         <li class="active">
            <a href="/blog/show/all">
               &nbsp;
               <i class="fa fa-home"></i>
               <span>Blog</span>
             </a>
             &nbsp;
             <i class="fa fa-chevron-right"></i>
         </li>
         <li class="active">
            <a>
               &nbsp;
               <i class="fa fa-commenting"></i>
               <span>Post</span>
             </a>
         </li>
     </ul>
  </header>

  {% block addContent %}{% endblock %}

  <script type="text/javascript" src="/assets/JS/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="/assets/JS/jquery.validate.min.js"></script>
  <script type="text/javascript" src="/assets/JS/bootstrap.min.js"></script>
  <script type="text/javascript" src="/assets/CSS/mdb.min.css"></script>
  <script type="text/javascript" src="/assets/JS/ripples.min.js"></script>
  <script type="text/javascript" src="/assets/JS/wow.min.js"></script>
  <script type="text/javascript" src="/assets/JS/waves-effect.js"></script>
  <script type="text/javascript" src="/assets/JS/buttons.js"></script>
  <script type="text/javascript" src="/assets/JS/app.js"></script>
  <script type="text/javascript" src="/assets/JS/js/baseBlog.js"></script>
  <script type="text/javascript" src="/assets/JS/js/blog.js"></script>
  {% block js %}{% endblock%}
  </body>
  </html>
