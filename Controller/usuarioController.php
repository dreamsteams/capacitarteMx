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
}
