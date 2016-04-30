<?php namespace Model;
class Comentario {
    public $contenido;
    public $posts_id;
    public $usuarios_id;
    public $enabled;
    public function __contruct(){

    }
    public  function show($post_id=0,$start=0,$limit=5){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $max= $datos->Select("Select max(id) as 'max' from  comentarios");

                if($start == 0){
                    $posts=$datos->SelectJson("Select comentarios.id,comentarios.contenido,
                    comentarios.created_at AS 'fecha',
                    concat(usuarios.nombre,' ',usuarios.apellido_paterno,' ',usuarios.apellido_materno) AS 'nombre_completo',
                    concat('/',imagenes.ruta) AS 'src_imagen_perfil'
                    from comentarios inner join usuarios on comentarios.usuarios_id = usuarios.id
                    inner join imagenes on imagenes.id = usuarios.foto_perfil
                    inner join posts on posts.id = comentarios.posts_id
                    where posts.id = '$post_id'
                    order by(comentarios.id)
                    asc LIMIT $limit");
                }
                else{
                    if($max){
                        if(($max[0]['max']) != $start)
                        {

                           $posts=$datos->SelectJson("Select comentarios.id,comentarios.contenido,
                            comentarios.created_at AS 'fecha',
                            concat(usuarios.nombre,' ',usuarios.apellido_paterno,' ',usuarios.apellido_materno) AS 'nombre_completo',
                            concat('/',imagenes.ruta) AS 'src_imagen_perfil'
                            from comentarios inner join usuarios on comentarios.usuarios_id = usuarios.id
                            inner join imagenes on imagenes.id = usuarios.foto_perfil
                            inner join posts on posts.id = comentarios.posts_id
                            where posts.id = '$post_id'
                            order by(comentarios.id)
                            asc LIMIT $start,$limit");
                        }
                        else{
                            echo json_encode(array('message'=>$start, "max"=>$max[0]));
                        }

                    }
                }
                echo $posts;


    }
    public function save(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Insert("INSERT INTO comentarios VALUES(NULL,'$this->contenido','$this->posts_id','$this->usuarios_id',now(),'$this->enabled')");
        $datos->Desconectar();
    }
    public function update($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE comentarios SET contenido = '$this->contenido' where id = '$id'");
        $datos->Desconectar();
    }
    public function disabled($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE comentarios SET enabled = '$this->enabled' where id = '$id'");
        $datos->Desconectar();
    }
    public function find($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $query=$datos->SelectJson("Select * from comentarios where id = '$id'");
        $datos->Desconectar();
        return $query;
    }
}
