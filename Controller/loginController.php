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
        $usuario = new \Model\usuario();
        if($usuario->attempt($username,$password)){
            //En caso de que los datos esten bien
            echo "Los datos estan bien";
        }else{
            // Los datos estan mal
            echo "Los datos estan incorrectos";
        }
    }

}
