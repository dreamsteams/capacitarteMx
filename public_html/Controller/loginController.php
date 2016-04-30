<?php namespace Controller;
class loginController extends BaseController {

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

    /*-----------------------------------
    Metodo para renderizar y mostrar la
    pagina principal del post
    -----------------------------------*/
    public function login()
    {
       /*-----------------------

       ------------------------*/
        extract($_POST);
        $usuario = new \Model\Usuario();
            /*$usuario->nombre = 'root';
            $usuario->apellido_paterno = 'Isaias';
            $usuario->apellido_materno = 'Rivera';
            $usuario->email = 'gerson.isaias.rivera@gmail.com';
            $usuario->password = md5('05dpr1500u');
            $usuario->codigo_usuario = md5('05dpr1500u');
            $usuario->activo = 1;
            $usuario->rol_id = 2;
            $usuario->foto_perfil = 1;
            $usuario->foto_portada = 1;
            $usuario->save();*/
        if($usuario->attempt($username,$password)){
            //En caso de que los datos esten bien
            //echo "Los datos estan bien";

            session_start();
            $response = array(
                    'status'=>'200',
                    'message'=>"/blog/show/".$_SESSION['nombre'].'_'.$_SESSION['apellido_paterno'].'_'.$_SESSION['apellido_materno']
                );
            echo json_encode($response);
        }else{
           $response = array(
                    'status'=>'404'
                );
            echo json_encode($response);
        }
    }
    public function logout(){
        session_start();
        session_destroy();
        header('Location:/');
    }



}
