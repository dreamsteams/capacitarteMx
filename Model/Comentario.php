<?php namespace Model;
class Comentario {
    public $contenido;
    public $posts_id;
    public $usuarios_id;
    public $enabled;
    public function __contruct(){

    }
    public static function show(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from comentarios");
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
