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
    public function setIdPost(){
        extract($_POST);
        session_start();
        $_SESSION['idPost'] =  $id;
        echo json_encode(array(0=>$id));
    }
    public function showMe(){
        $post = new \Model\Post();
        $post->show();
    }
    public function save(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            extract($_POST);
            $image=$this->uploadImage();
            $post = new \Model\Post();
            $post->titulo = $titulo;
            $post->contenido = $contenido;
            $post->imagenes_id = $image[0]['Last'];
            $post->usuarios_id = 1;
            $post->enabled = 1;
            $post->save();
            echo json_encode(array(0=>'Success'));
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
    public function disabled(){
        extract($_POST);
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $post = new \Model\Post();
            $post->enabled="0";
            $post->disabled($id);
            echo json_encode(array(0=>"SUCCESS"));
        }
    }
    public function update(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            extract($_POST);
            $image=($this->uploadImage() == 0) ? null : $this->uploadImage();
            $post = new \Model\Post();
            $post->titulo = $titulo;
            $post->contenido = $contenido;
            if($image != null)
                $post->imagenes_id = $image[0]['Last'];
            else{
                $post->imagenes_id = $post->find($id)[0]['imagenes_id'];
            }
            $post->update($id);
            echo json_encode(array(0=>'Success'));
        }
    }
    private function uploadImage(){
        extract($_POST);
        if(isset($_FILES["file"]))
        {
            $file = $_FILES["file"];
            $nombre = "image_".str_replace(" ","_",$titulo);
            $tipo = $file["type"];
            $ruta_provisional = $file["tmp_name"];
            $size = $file["size"];
            $dimensiones = getimagesize($ruta_provisional);
            $width = $dimensiones[0];
            $height = $dimensiones[1];
            $carpeta = "assets/images/image-perfil/";
            if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
            {
              echo "Error, el archivo no es una imagen";
            }
            else if($width < 200 || $height < 200)
            {
                echo "Error la anchura y la altura mínima permitida es 200px";
            }
            else
            {
                try
                {
                    $src = $carpeta.$nombre.".".str_replace("image/","",$tipo);
                    move_uploaded_file($ruta_provisional, $src);
                    $image = new \Model\Imagen();
                    $image->nombre = $nombre;
                    $image->ext = str_replace("image/","",$tipo);
                    $image->ruta = $src;
                    $image->enabled=1;
                    $image->save();
                    return $image->find();
                }
                catch(Exception $ex)
                {
                    echo "ERROR: ".$ex;
                }

            }

        }
    }
}

?>
