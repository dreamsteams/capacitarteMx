<?php namespace Controller;
class likeController extends BaseController {

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
    public function getLikes(){
        session_start();
        $id = array('id'=>$_SESSION['idPost']);
        $like = new \Model\Like();
        $like->find($id['id']);
    }
    public function setLikes(){

        session_start();
        $id = array('id'=>$_SESSION['idPost']);
        $like = new \Model\Like();
        $like->posts_id=$id['id'];
        $like->usuarios_id=1;
        $like->enabled=1;
        $like->save();
        echo 1;
    }
}
