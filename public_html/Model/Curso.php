<?php namespace Model;
class Curso {
    public $nombre;
    public $descripcion;
    public $fecha_inicio;
    public $fecha_fin;
    public $imagenes_id;
    public $enabled;
    public function __contruct(){

    }
    public static function show($id =0){
         $datos = new PDO\Datos();
        $datos->Conectar();
        if($id==0)
            $cursos=$datos->SelectJson("Select cursos.id,cursos.descripcion,cursos.nombre,DATE_FORMAT(cursos.fecha_inicio, '%d/%m/%Y') as 'created_at',archivos.ruta as 'src' from cursos inner join archivos on cursos.imagen= archivos.id where cursos.enabled = 1");
        else{
            $cursos=$datos->SelectJson("Select cursos.id,cursos.descripcion,cursos.nombre,DATE_FORMAT(cursos.fecha_inicio, '%d/%l/%Y H:i:s') as 'created_at',archivos.ruta as 'imagen' from cursos inner join archivos on cursos.imagen= archivos.id  where cursos.id = $id");
        }
        echo $cursos;
    }
    public function save(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Insert("INSERT INTO cursos VALUES(NULL,'$this->nombre','$this->descripcion','$this->fecha_inicio','$this->fecha_fin',3,'$this->imagenes_id','$this->enabled')");
        $datos->Desconectar();
    }
    public function update($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE cursos SET nombre = '$this->nombre', descripcion = '$this->descripcion', fecha_inicio = '$this->fecha_inicio', fecha_fin = '$this->fecha_fin', imagen = '$this->imagenes_id' where id = '$id'");
        $datos->Desconectar();
    }
    public function disabled($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE cursos SET enabled = '0' where id = '$id'");
        $datos->Desconectar();
    }
    public function find($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        if($id != 0){
            $query=$datos->Select("Select * from cursos where id = $id");
        }
        else{
            $query=$datos->Select("Select max(id) AS 'Last', min(id) AS 'First' from cursos");
        }        $datos->Desconectar();
        return $query;
    }
}
