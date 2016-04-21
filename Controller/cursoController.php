<?php namespace Controller;
class cursoController extends BaseController {

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
            if($_SESSION['rol'] == 'administrador')
                echo $this->View->render('cursoMenu.php');
            else
                header('Location:/');
        else
            header('Location:/');
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

    public function setIdCurso(){
        extract($_POST);
        session_start();
        $_SESSION['idCurso'] =  $id;
        echo json_encode(array(0=>$id));
    }
    public function showMe(){
        $curso = new \Model\Curso();
        $curso->show();
    }
    public function save(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            extract($_POST);
            $image=$this->uploadImage();
            $post = new \Model\Curso();
            $post->nombre = $nombre;
            $post->descripcion = $descripcion;
            $post->fecha_inicio = $fecha_inicio;
            $post->fecha_fin = $fecha_fin;
            $post->imagenes_id = $image[0]["Last"];
            $post->enabled = 1;
            $post->save();
            echo json_encode(array(0=>'Success'));
        }
    }
    public function disabled(){

        extract($_POST);
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $curso = new \Model\Curso();
            $curso->disabled($id);
            echo json_encode(array(0=>"SUCCESS"));
        }
    }
    public function update(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            extract($_POST);
            $image=($this->uploadImage() == 0) ? null : $this->uploadImage();
            $curso = new \Model\Curso();
            if($image != null)
                $curso->imagenes_id = $image[0]['Last'];
            else{
                $curso->imagenes_id = $curso->find($id)[0]['imagen'];
            }
            $curso->nombre = $nombre;
            $curso->descripcion = $descripcion;

            $curso->fecha_inicio = $fecha_inicio;
            $curso->fecha_fin = $fecha_fin;

            $curso->update($id);
            echo json_encode(array(0=>'Success'));
        }
    }
    private function uploadImage(){
        extract($_POST);
        if(!\is_null($_FILES["file"]))
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
                    $image = new \Model\Archivo();
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
        else{
            return 0;
        }
    }

}
