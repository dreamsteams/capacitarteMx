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
            echo $this->View->render('cursoMenu.php',array('role'=>$_SESSION['rol'],'nombre'=>$_SESSION['nombre']));
        else
            header('Location:/');
    }
    public function getFiles(){
        extract($_POST);
        $hasCurso = new \Model\Usuario_cursos();
        if($hasCurso->hasCurso($id) == '200'){
            $filesCourse = new \Model\Cursos_archivos();
            echo $filesCourse->findFiles($id);
        }
        else{
            echo json_encode(array('status'=>'403'));
        }
    }
    public function inicio()
    {
      echo $this->View->render('blogInicio.php');
    }
    public function getCursoPrincipal(){
        $curso = new \Model\Curso();
        $curso->show();
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
            $curso = new \Model\Curso();
            $curso->nombre = $nombre;
            $curso->descripcion = $descripcion;
            $curso->fecha_inicio = $fecha_inicio;
            $curso->fecha_fin = $fecha_fin;
            $curso->imagenes_id = $image[0]["Last"];
            $curso->enabled = 1;
            $curso->save();


            //define the receiver of the email
            $to = 'gerson.isaias.rivera@gmail.com';
            //define the subject of the email
            $subject = 'CAPACITARTE';
            //define the message to be sent. Each line should be separated with \n
             $message = "Hey tenemos una nueva para ti , en CapacitArte \n El nuevo curso ".$nombre." ya esta disponible adquierelo ya!!";
            //define the headers we want passed. Note that they are separated with \r\n
             $headers = "From: capacitArte@capacitarte.mx\r\nReply-To: capacitArte@capacitarte.mx";
            //send the email
             $mail_sent = @mail( $to, $subject, $message, $headers );
            //if the message is sent successfully print "Mail sent". Otherwise print "Mail failed"
             if($mail_sent)
               echo json_encode(array(0=>'Success'));
             else
               echo json_encode(array(0=>'Error'));
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
    public function uploadFileCourse(){
        extract($_POST);
        $curso = new \Model\Curso();
        $ultimoCurso = $curso->find()[0]['Last'];

    }
    public function update(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            extract($_POST);
            $image=$this->uploadImage();
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
    private function uploadFile(){
    }
    private function uploadImage(){
        extract($_POST);
        if($_FILES["file"]["name"] != "")
        {
            $file = $_FILES["file"];
            //print_r($file);
            //return;
            $nombre = "image_".str_replace(" ","_",$nombre);
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
            return null;
        }
    }

}
