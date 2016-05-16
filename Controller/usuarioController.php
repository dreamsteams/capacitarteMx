<?php namespace Controller;
class usuarioController extends BaseController {

    /*-------------------------
    Creamos la variable
    protegida $View
    para almacenar renderizar
    --------------------------*/

    protected $View;

    public function __construct(){
        /*------------------------
        Usamos la variable View e
        inicializamos el controlador

        NOTA: EN VIEW SE ALMACENA
        LOS METODOS DE TWIG(Renderizacion
        de vistas)
        ---------------------------*/

        $this->View=$this::init();
    }
    public function mostrar(){
        $usuario = new \Model\Usuario();
        $usuario->show();
    }

    public function showGestion(){
        session_start();
        if($_SESSION['rol'] == 'administrador'){
          echo $this->View->render('gestionUsuarios.php', array('role'=>$_SESSION['rol'],'session'=>$_SESSION));
        }
        else{
          header('location:/');
        }
    }
    
    public function save(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            extract($_POST);
            $usuario = new \Model\Usuario();
            $usuario->nombre = $nombre;
            $usuario->apellido_paterno = $apellido_paterno;
            $usuario->apellido_materno = $apellido_materno;
            $usuario->email = $email;
            $usuario->password = md5($password);
            $usuario->codigo_usuario = md5($nombre.$apellido_paterno.$apellido_materno);
            $usuario->activo = 1;
            $usuario->rol_id = 2;
            $usuario->foto_perfil = 1;
            $usuario->foto_portada = 1;
            $usuario->save();
            echo json_encode(array('message'=>'El usuario se ha reistrado'));
            
        }
    }
    public function update(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            extract($_POST);
            $usuario = new \Model\Usuario();
            $usuario->nombre = $nombre;
            $usuario->apellido_paterno = $apellido_paterno;
            $usuario->apellido_materno = $apellido_materno;
            $usuario->email = $email;
            $usuario->password = md5($password);
            $usuario->codigo_usuario = md5($nombre.$apellido_paterno.$apellido_materno);
            $usuario->activo = 1;
            $usuario->rol_id = 2;
            $usuario->foto_perfil = 1;
            $usuario->foto_portada = 1;
            $usuario->save();
            echo json_encode(array('message'=>'El usuario se ha reistrado'));

        }
    }

    public function updateUser(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            extract($_POST);
            $user = new \Model\Usuario();
            $user->nombre = $nombre;
            $user->apellido_paterno = $apellido_paterno;
            $user->apellido_materno = $apellido_materno;
            $user->email = $email;
            $user->Update($id);
            echo json_encode(array(0=>"/usuario/showGestion/todos"));
        }
    }

    public function removeUser(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            extract($_POST);
            $user = new \Model\Usuario();
            $user->disabledUser($id);
            echo json_encode(array(0=>"/usuario/showGestion/todos"));
        }
    }
}
