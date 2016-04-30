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
        session_start();
        if($_SESSION)
            echo $this->View->render('bloggMenu.php',array('role'=>$_SESSION['rol'],'session'=>$_SESSION));
        else
            header('Location:/');
    }
    public function postFind(){
        session_start();
        $id = array('id'=>$_SESSION['idPost']);
        $post = new \Model\Post();
        $post->show($id['id']);
    }
    public function showPost()
    {
        session_start();
        $id = array('id'=>$_SESSION['idPost']);
        if(!empty($id)){

            echo $this->View->render('bloggers.php');
        }
        else{
            header("Location:/blog/show/all");
        }
    }

    public function inicio()
    {
      echo $this->View->render('blogInicio.php');
    }

}
