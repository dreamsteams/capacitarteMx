<?php namespace Model;
class Like extends BaseModel{
    private $posts_id;
    private $usuarios_id;
    private $enabled;
    public function __contruct(){
        $this::init();
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
        $datos->Insert("INSERT INTO likes VALUES(NULL,'$this->$posts_id','$this->$usuarios_id','$this->$enabled')");
        $datos->Desconectar();
    }
    public function disabled($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE likes SET enabled = '$this->$enabled' where id = '$id'");
        $datos->Desconectar();
    }
    public function find($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $query=$datos->SelectJson("Select * from likes where usuarios_id = '$usuarios_id' and posts_id='$posts_id'");
        $datos->Desconectar();
        return $query;
    }
}
