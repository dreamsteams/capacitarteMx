<?php namespace Model;
class Usuario {
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $email;
    public $password;
    public $codigo_usuario;
    public $activo;
    public $rol_id;
    public function __contruct(){

    }
    public static function show(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from usuarios");
        $datos->Desconectar();
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
    /*------------------------
    function  estatica para
    verificar las credenciales
    del usuario
    --------------------------*/
    public  function attempt($user,$pwd){
        $user = $this->limpiar($user);
        $pwd = md5($this->limpiar($pwd));
        $datos = new PDO\Datos();
        try {
            $datos->Conectar();
            $posts=$datos->Select("Select * from usuarios where email = '$user' && password= '$pwd' ");
            $datos->Desconectar();
        } catch (Exception $e) {
            echo $e;
        }
        if($posts){
            return true;
        }else{
            return false;
        }
    }
    public function find($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $query=$datos->SelectJson("Select * from comentarios where id = '$id'");
        $datos->Desconectar();
        return $query;
    }
    private function limpiar($val){
        $val = str_replace("","'",$val);
        return $val;
    }
}
