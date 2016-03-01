<?php namespace Model;
class Perfil extends BaseModel{
    private $apodo;
    private $fecha_nac;
    private $Situacion_sentimental_id;
    private $usuarios_id;
    private $imagen_portada;
    private $imagen_perfil;
    public function __contruct(){
        $this::init();
    }
    public static function show($message){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from perfil");
        return $posts;
    }
    public function save(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Insert("INSERT INTO perfil VALUES(NULL,'$this->apodo','$this->fecha_nac','$this->Situacion_sentimental_id','$this->usuarios_id','$this->imagen_portada','$this->imagen_perfil')");
        $datos->Desconectar();
    }
    public function update($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE perfil SET apodo = '$this->contenido', fecha_nac = '$this->fecha_nac', Situacion_sentimental_id = '$this->Situacion_sentimental_id', usuario_id = '$this->usuarios_id' where id = '$id'");
        $datos->Desconectar();
    }
    public function updatePortada($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE perfil SET imagen_portada = '$this->imagen_portada' where id = '$id'");
        $datos->Desconectar();

    }
    public function updateFPerfil($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE perfil SET imagen_perfil = '$this->imagen_perfil' where id = '$id'");
        $datos->Desconectar();

    }
    public function disabled($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE perfil SET enabled = '$this->enabled' where id = '$id'");
        $datos->Desconectar();
    }
    public function find($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $query=$datos->SelectJson("Select * from perfil where id = '$id'");
        $datos->Desconectar();
        return $query;
    }
}
