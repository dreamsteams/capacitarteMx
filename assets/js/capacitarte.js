$(document).ready(function() {
  wow = new WOW({
    animateClass: 'animated',
    offset: 100
  });
  wow.init();

    var cursos;
    function changeiconcolorfocus(element,backgroundColor,fontColor){
          var padre =$(element).parent('div');
          padre.children('div').css({background:backgroundColor,
                                     'border-top-left-radius':'5px',
                                     'border-bottom-left-radius':'5px',
                                    });
          padre.children('div').children('i').css({
              color:fontColor
          });
      }
      function changeiconcolorblur(){
          $('.input-group-addon > i').css({
              color:'#57504e',
              'font-size':'15px'
          });
          $(".input-group-addon").css({background:'#ded4d4'})
      }
      function asignedNotRepeat(arrays,numMayor){
          var valor = Math.round(Math.random() * numMayor);
          if($.isArray(arrays)){
              for(var i =0; i < arrays.length; i++){
                  if(valor == arrays[i])
                      return {status:false};
                  else if(i == arrays.length-1)
                      return {status:true,message:valor};

              }
          }
      }
      function createRandom(arrays,numMayor){
          var correctNum = false;
          var response;
          while(correctNum == false){
              response = asignedNotRepeat(arrays,numMayor);
              correctNum = response.status;
          }
          return response.message;
      }
      function createArray(numMayor,limit){
          var arreglo = [];
          if(limit >= 3){
              limit = 3;
          }
          for(var i =0; i < limit; i++){
              if(arreglo.length == 0)
                  arreglo[i]=Math.round(Math.random()*numMayor);
              else
                  arreglo[i]=createRandom(arreglo,numMayor);
          }
          return arreglo;
      }
      getCursos();
      function getCursos(){
          $.ajax({
              url:'/curso/getCursoPrincipal/obtener-cursos',
              method:'POST',
              dataType:'JSON'
          }).done(function(response){
              cursos = response;
              var cursosSelect = createArray(response.length-1,response.length);
              var i;
              var status= cursosSelect.length;
              var primer_elemento = false;
              for(i = 0; i < cursosSelect.length; i++){
                  if(status == 1){
                      $("#body_cursos .contenedor:nth-child(2)  h2").append(cursos[cursosSelect[i]].nombre);
                      $("#body_cursos .contenedor:nth-child(2)  > .carta > .atras > .descripcion").append(cursos[cursosSelect[i]].descripcion);
                      $("#body_cursos .contenedor:nth-child(2) > .carta > .frente").css('background-image','url('+cursos[cursosSelect[i]].src+')');
                      $("#body_cursos  .contenedor:nth-child(2)").removeClass('hide');
                      $("#body_cursos  .contenedor:first-child").css('opacity','0.0');
                      $("#body_cursos  .contenedor:first-child").removeClass('wow');
                      $("#body_cursos  .contenedor:first-child").removeClass('hide');
                  }
                  else if(status == 2){
                      if(!primer_elemento){
                          $("#body_cursos .contenedor:first-child  h2").append(cursos[cursosSelect[i]].nombre);
                          $("#body_cursos .contenedor:first-child  > .carta > .atras > .descripcion").append(cursos[cursosSelect[i]].descripcion);
                          $("#body_cursos .contenedor:first-child > .carta > .frente").css('background-image','url('+cursos[cursosSelect[i]].src+' )');
                          $("#body_cursos  .contenedor:first-child").removeClass('hide');
                          primer_elemento = true;
                      }
                      else{
                          $("#body_cursos .contenedor:nth-child(3)  h2").append(cursos[cursosSelect[i]].nombre);
                          $("#body_cursos .contenedor:nth-child(3) > .carta > .atras > .descripcion").append(cursos[cursosSelect[i]].descripcion);
                          $("#body_cursos .contenedor:nth-child(3) > .carta > .frente").css('background-image','url('+cursos[cursosSelect[i]].src+')');
                          $("#body_cursos  .contenedor:nth-child(3)").removeClass('hide');
                          $("#body_cursos  .contenedor:nth-child(2)").css('opacity','0.0');
                          $("#body_cursos  .contenedor:nth-child(2)").removeClass('hide');
                      }
                  }
                  else{
                      $("#body_cursos .contenedor:nth-child("+(i+1)+")  h2").append(cursos[cursosSelect[i]].nombre);
                      $("#body_cursos .contenedor:nth-child("+(i+1)+")  > .carta > .atras > .descripcion").append(cursos[cursosSelect[i]].descripcion);
                      $("#body_cursos .contenedor:nth-child("+(i+1)+") > .carta > .frente").css('background-image','url('+cursos[cursosSelect[i]].src+')');
                      $("#body_cursos  .contenedor:nth-child("+(i+1)+")").removeClass('hide');
                  }

              }
              if(i > 0){
                  $("#cabecera_cursos , #body_cursos").removeAttr("hidden");

              }
          }).fail(function(error){
              console.log(error);
          });
      }

      //---Inicio de changeiconcolorfocus
        //---
      $('input').focus(function(){
          changeiconcolorfocus(this,'#3b3939','#c33e02');
      });

      $('input').blur(function(){
          changeiconcolorblur();
      });

     $("#entrar").click(function(){
         $.ajax({
             url:$('#frm_login').attr('action'),
             method:'POST',
             dataType:'JSON',
             data:$('#frm_login').serialize()
         }).done(function(response){
             if(response.status == '404')
                 alertify.log('El usuario o contraseña no fueron encontrados');
             else
                 window.location=response.message;
         }).fail(function(error){
             console.log(error);
         });
     });

});
