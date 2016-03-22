<?php namespace Model;
class Archivo {
    private $contenido;
    private $posts_id;
    private $usuarios_id;
    private $enabled;
    public function __contruct(){

    }
    public static function show(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from archivos");
        return $posts;
    }
    public function save(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Insert("INSERT INTO archivos VALUES(NULL,'$this->nombre','$this->ext','$this->ruta','$this->enabled')");
        $datos->Desconectar();
    }
    public function update($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE archivos SET nombre = '$this->nombre', '' where id = '$id'");
        $datos->Desconectar();
    }
    public function disabled($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE archivos SET enabled = '$this->enabled' where id = '$id'");
        $datos->Desconectar();
    }
    public function find($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $query=$datos->SelectJson("Select * from archivos where id = '$id'");
        $datos->Desconectar();
        return $query;
    }
}
