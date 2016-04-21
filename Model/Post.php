<?php namespace Model;
class Post{
    public $id;
    public $titulo;
    public $contenido;
    public $imagenes_id;
    public $usuarios_id;
    public $enabled;
    public function __construct(){

    }
    public static function show($id=0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        if($id==0)
            $posts=$datos->SelectJson("Select posts.id,posts.contenido,posts.titulo,DATE_FORMAT(posts.created_at, '%d/%l/%Y H:i:s') as 'created_at',imagenes.ruta as 'src' from posts inner join imagenes on posts.imagenes_id= imagenes.id where posts.enabled = 1");
        else{
            $posts=$datos->SelectJson("Select posts.id,posts.contenido,posts.titulo,posts.created_at,imagenes.ruta as 'src' from posts inner join imagenes on posts.imagenes_id= imagenes.id where posts.id = $id");
        }
        echo $posts;
    }
    public function save(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        try{
            $datos->Insert("INSERT INTO posts VALUES(NULL,'$this->titulo','$this->contenido',now(),'$this->usuarios_id','$this->enabled','$this->imagenes_id')");
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }
        $datos->Desconectar();
    }
    public function update($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE posts SET titulo = '$this->titulo' , contenido = '$this->contenido', imagenes_id = '$this->imagenes_id' where id = '$id'");
        $datos->Desconectar();
    }
    public function disabled($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE posts SET enabled = '$this->enabled' where id = '$id'");
        $datos->Desconectar();
    }
    public function find($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        if($id != 0){
            $query=$datos->Select("Select * from posts where id = $id");
        }
        else{
            $query=$datos->Select("Select max(id) AS 'Last', min(id) AS 'First' from posts");
        }
        $datos->Desconectar();
        return $query;
    }
}


?>
