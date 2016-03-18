<?php namespace Model;
class Rol{
    private $nombre;
    public function __construct(){

    }
    public static function show($message){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from rol");
        print_r($posts);
    }
    public function save(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Insert("INSERT INTO rol VALUES(NULL,'$this->nombre')");
        $datos->Desconectar();
    }
    public function update($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE rol SET nombre = '$this->nombre' where id = '$id'");
        $datos->Desconectar();
    }
    public function find($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $query=$datos->SelectJson("Select * from rol where id = '$id'");
        $datos->Desconectar();
        return $query;
    }
}


?>
