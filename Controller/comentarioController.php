<?php namespace Controller;
class comentarioController extends BaseController {

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

    public function show(){
        $comentario = new \Model\Comentario();
        session_start();
        if($_SESSION['idPost'])
            $comentario->show($_SESSION['idPost']);
        else 
            echo false;
    }
    public function showMore(){
        $comentario = new \Model\Comentario();
        session_start();
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            extract($_POST);
            if($_SESSION['idPost'])
                $comentario->show($_SESSION['idPost'],$start,$limit);
            else 
                echo false;
        }
        else{
            print_r($_POST);
        }
    }
    public function save(){
        extract($_POST);
        session_start();
        $idPost = array('id'=>$_SESSION['idPost']);
        $comentario = new \Model\Comentario();
        $comentario->contenido = $contenido;
        $comentario->posts_id = $idPost['id'];
        $comentario->usuarios_id= $_SESSION['id'];
        $comentario->enabled = 1;
        $comentario->save();
        echo json_encode(array("message"=>"success"));
    }
}
   
