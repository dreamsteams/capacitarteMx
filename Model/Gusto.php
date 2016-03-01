<?php namespace Model;
class Gusto extends BaseModel{
    private $nombre;

    public function __contruct(){
        $this::init();
    }
    public static function show(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from gustos");
        return $posts;
    }
    public function save(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Insert("INSERT INTO gustos VALUES(NULL,'$this->nombre')");
        $datos->Desconectar();
    }
    public function update($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE gustos SET nombre = '$this->nombre' where id = '$id'");
        $datos->Desconectar();
    }
    public function find($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $query=$datos->SelectJson("Select * from gustos where id = '$id'");
        $datos->Desconectar();
        return $query;
    }
}
