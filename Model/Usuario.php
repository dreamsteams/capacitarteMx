<?php namespace Model;
class Usuario {
<<<<<<< HEAD
    private $nombre;
    private $apellido_paterno;
    private $apellido_materno;
    private $email;
    private $password;
    private $codigo_usuario;
    private $activo;
    private $rol_id;
=======
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $email;
    public $password;
    public $codigo_usuario;
    public $activo;
    public $rol_id;
>>>>>>> 8cbcca8cd9238c4a86cf0960998c60d9ed2800a3
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
            $posts=$datos->Select("Select usuarios.nombre,usuarios.apellido_paterno,usuarios.apellido_materno,usuarios.email,usuarios.password,usuarios.codigo_usuario,rol.nombre as 'Rol' from usuarios inner join rol on rol.id = usuarios.rol_id where email = '$user' && password= '$pwd' ");
            $datos->Desconectar();
        } catch (Exception $e) {
            echo $e;
        }

        if($posts){
            $this->nombre = $posts[0]['nombre'];
            $this->apellido_paterno = $posts[0]['apellido_paterno'];
            $this->apellido_materno = $posts[0]['apellido_materno'];
            $this->email = $posts[0]['email'];
            $this->password = $posts[0]['password'];
            $this->codigo_usuario = $posts[0]['codigo_usuario'];
            $this->rol_id = $posts[0]['Rol'];
            $this->generarObjUser();
            return true;
        }else{
            return false;
        }
    }
    public function generarObjUser(){
        session_start();
        $_SESSION['nombre'] = $this->nombre;
        $_SESSION['apellido_paterno'] = $this->apellido_paterno;
        $_SESSION['apellido_materno'] = $this->apellido_materno;
        $_SESSION['password'] = $this->password;
        $_SESSION['email'] = $this->email;
        $_SESSION['rol'] = $this->rol_id;
        $_SESSION['codigo_usuario'] = $this->codigo_usuario;
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
        $val = htmlspecialchars($val);
        return $val;
    }
}
