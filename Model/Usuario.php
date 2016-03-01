<?php namespace Model;
class Usuario extends BaseModel{
    private $nombre;
    private $apellido_paterno;
    private $apellido_materno;
    private $email;
    private $password;
    private $codigo_usuario;
    private $activo;
    private $rol_id;
    public function __contruct(){
        $this::init();
    }
    public static function show(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from usuarios");
        return $posts;
    }
    public function save(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Insert("INSERT INTO usuarios VALUES(NULL,'$this->nombre','$this->apellido_paterno','$this->apellido_materno','$this->email','$this->password','$this->codigo_usuario','$this->activo','$this->rol_id')");
        $datos->Desconectar();
    }
    public function update($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE usuarios SET nombre = '$this->nombre', apellido_paterno = '$this->apellido_paterno', apellido_materno = '$this->apellido_materno', email = '$this->email'  where id = '$id'");
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
        $query=$datos->SelectJson("Select * from comentarios where id = '$id'");
        $datos->Desconectar();
        return $query;
    }
}
