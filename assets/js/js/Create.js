/*Created by Gerson Isaias*/
var elemento ={
        clase:this.class,
        create:function($tag){
            return $("<"+$tag+"/>").addClass(this.class);
        },
        addToCreate:function($parent,$child){
            this.create($parent).append(this.create($child));
        },
        add:function($parent,$children){
            if($.isArray($children)){
                $.each($children,function(index,object){
                    $($parent).append(object);
                })
            }
            else{
                $($parent).append($children);
            }

        },
        Curso:{
            id:this.id,
            contenido:this.contenido,
            nombre:this.titulo,
            fecha_inicio:this.fecha_inicio,
            fecha_fin:this.fecha_fin,
            ruta:this.ruta,
            create:function(){
                return  "<div class=\"col-xs-6 push-post col-md-4\" data-id-post="+this.id+" data-fecha-inicio="+this.fecha_inicio+">"+
                  "<div class=\"col-xs-12 text-right\">"+
                    "<div class=\"actionButtons\">"+
                      "<button type=\"button\" name=\"btn-refresh\" data-id-post="+this.id+" data-fecha-inicio="+this.fecha_inicio+" data-fecha-fin="+this.fecha_fin+" class=\"btn btn-info btn-fab btnUpdatePost\">"+
                        "<span class=\"fa fa-refresh\"></span>"+
                      "</button>"+
                      "<button type=\"button\" name=\"btn-disabled\" data-id-curso="+this.id+" class=\"btn btn-danger btn-fab btnDelPost\">"+
                        "<span class=\"fa fa-trash-o\"></span>"+
                      "</button>"+
                    "</div>"+
                  "</div>"+
                  "<div class=\"card-post text-center\" id='content_post_"+this.id+"' title='Descripción: "+this.descripcion+"'>"+
                   "<img src="+this.ruta+" alt=\"Imagen del post\" class=\"img-responsive\">"+
                    "<h5 id='title_post_"+this.id+"'>"+this.nombre+"</h5>"+
                    "<p id='fecha_inicio_"+this.id+"'>Fecha de inicio: "+moment(this.fecha_inicio,"DDMMYYYY").fromNow()+"</p>"+
                  "</div>"+
                "</div>";
            },
            createGeneral:function(){
                 return  "<div class=\"col-xs-6 push-post col-md-4\" data-id-curso="+this.id+" data-fecha-inicio="+this.fecha_inicio+">"+
                  "<div class=\"col-xs-12 text-right\">"+
                    "<div class=\"actionButtons\">"+
                      "<button type=\"button\" name=\"btn-view-file\" title='Ver archivos adicionales' data-id-curso="+this.id+"  class=\"btn btn-info btn-fab btn-view \">"+
                        "<span class=\"fa fa-eye\"></span>"+
                      "</button>"+
                    "</div>"+
                  "</div>"+
                  "<div class=\"card-post text-center\" id='content_post_"+this.id+"' title='Descripción: "+this.descripcion+"'>"+
                   "<img src="+this.ruta+" alt=\"Imagen del post\" class=\"img-responsive\">"+
                    "<h5 id='title_post_"+this.id+"'>"+this.nombre+"</h5>"+
                    "<p id='fecha_inicio_"+this.id+"'>Fecha de inicio: "+moment(this.fecha_inicio,"DDMMYYYY").fromNow()+"</p>"+
                  "</div>"+
                "</div>";
            }
        }
}
