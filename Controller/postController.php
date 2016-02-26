<?php namespace Controller;
class postController extends BaseController {

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
    public function showMe(){
        $name = array('name'=>'roger');
        echo $this->View->render("Post.php",$name);
    }
    public function data(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $i = 2*7;
            echo "Valor = ".$i;
        }
        else{
            /*--------------------------------
            Para mandar a llamar una clase externa
            al namespace debemos de poner su namespace
            asi -> \NombreNamespace\Clase
            ejemplos
            $class = \namespace\class();
            $class->method
            \namespace\class::metodostatic();
            ---------------------------------*/
            \Model\Post::show("Willy que onda");
        }
    }
}

?>
