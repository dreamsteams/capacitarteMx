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
        $like->find($id['id'],$_SESSION['id']);
    }
    public function setLikes(){
        $like = new \Model\Like();
        session_start();
        $id = array('id'=>$_SESSION['idPost']);

        //--Buscamos si el usuario ya le ha dado like al post
        $likeshas = $like->hasLike($id['id'],$_SESSION['id']);
        //--Si el usuario no le ha dado un like al post guarda el like
        if($likeshas == 0){
            $like->posts_id=$id['id'];
            $like->usuarios_id=$_SESSION['id'];
            $like->enabled=1;
            $like->save();
        }
        else{
            //--Si no , lo eliminamos
            $like->delete($id['id'],$_SESSION['id']);
        }
        $likes = $like->find($id['id'],$_SESSION['id']);
        echo $likes;
    }

}
