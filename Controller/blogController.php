<?php namespace Controller;
class blogController extends BaseController {

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
    public function show()
    {
        echo $this->View->render('bloggMenu.php');
    }

    public function showPost()
    {
        echo $this->View->render('bloggers.php');
    }

    public function inicio()
    {
      echo $this->View->render('blogInicio.php');
    }

}
