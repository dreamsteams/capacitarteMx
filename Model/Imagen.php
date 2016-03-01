<?php namespace Model;
class Imagen extends BaseModel{
    private $nombre;
    private $ruta;
    private $ext;
    private $enabled;
    public function __contruct(){
        $this::init();
    }
    public static function show($message){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from comentarios");
        return $posts;
    }
    public function save(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Insert("INSERT INTO comentarios VALUES(NULL,'$this->nombre','$this->ruta','$this->ext','$this->enabled')");
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
        $query=$datos->SelectJson("Select * from comentarios where id = '$id'");
        $datos->Desconectar();
        return $query;
    }
}
