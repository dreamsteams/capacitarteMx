<?php namespace Model;
class Like{
    public $posts_id;
    public $usuarios_id;
    public $enabled;
    public function __contruct(){

    }
    public static function show($message){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from likes");
        return $posts;
    }
    public function save(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Insert("INSERT INTO likes VALUES(NULL,'$this->posts_id','$this->usuarios_id','$this->enabled')");
        $datos->Desconectar();
    }
    public function disabled($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE likes SET enabled = '$this->enabled' where id = '$id'");
        $datos->Desconectar();
    }
    public function find($id = 0, $idUser = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $query=$datos->SelectJson("Select count(id) as 'total' from likes where posts_id='$id' and usuarios_id = '$idUser'");
        $datos->Desconectar();
        echo $query;
    }

}
