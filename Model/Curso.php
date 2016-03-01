<?php namespace Model;
class Curso extends BaseModel{
    private $nombre;
    private $descripcion;
    private $fecha_inicio;
    private $fecha_fin;
    private $imagenes_id;
    private $enabled;
    public function __contruct(){
        $this::init();
    }
    public static function show(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from cursos");
        return $posts;
    }
    public function save(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Insert("INSERT INTO cursos VALUES(NULL,'$this->nombre','$this->descripcion','$this->fecha_inicio','$this->fecha_fin','$this->imagenes_id','$this->enabled')");
        $datos->Desconectar();
    }
    public function update($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE cursos SET nombre = '$this->nombre', descripcion = '$this->descripcion', fecha_inicio = '$this->fecha_inicio', fecha_fin = '$this->fecha_fin', imagenes_id = '$this->imagenes_id' where id = '$id'");
        $datos->Desconectar();
    }
    public function disabled($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE cursos SET enabled = '$this->enabled' where id = '$id'");
        $datos->Desconectar();
    }
    public function find($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $query=$datos->SelectJson("Select * from cursos where id = '$id'");
        $datos->Desconectar();
        return $query;
    }
}
