<?php namespace Model;
class Imagen {
    public $nombre;
    public $ruta;
    public $ext;
    public $enabled;
    public function __contruct(){

    }
    public static function show($message){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from imagenes");
        return $posts;
    }
    public function save(){
        try{
            $datos = new PDO\Datos();
            $datos->Conectar();
            $datos->Insert("INSERT INTO imagenes VALUES(NULL,'$this->nombre','$this->ruta','$this->ext','$this->enabled')");
            $datos->Desconectar();
        }
        catch(Exception $ex){
            echo $ex;
        }
    }
    public function disabled($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE imagenes SET enabled = '$this->enabled' where id = '$id'");
        $datos->Desconectar();
    }
    public function find($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        if($id != 0){
            $query=$datos->Select("Select * from imagenes where id = $id");
        }
        else{
            $query=$datos->Select("Select max(id) AS 'Last', min(id) AS 'First' from imagenes");
        }
        $datos->Desconectar();
        return $query;
    }
}
