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
        if($usuario->attempt($username,$password)){
            //En caso de que los datos esten bien
            //echo "Los datos estan bien";
            session_start();
            header("Location:/blog/show/".$_SESSION['nombre'].'_'.$_SESSION['apellido_paterno'].'_'.$_SESSION['apellido_materno']);
        }else{
            header("Location:/");
        }
    }
    public function logout(){
        session_destroy();
        header('Location:/');
    }



}
