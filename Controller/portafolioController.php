<?php namespace Controller;
class portafolioController extends BaseController {
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

  private function getFileExtension($fileName){
    // $res = explode('.', $fileName);
    // $ext = $res[count($res) - 1];
    $ext = strrchr($fileName, '.');
    return $ext;
  }

  private function getFileOnlyName($fileName){

  }

  public function show(){
    session_start();
    if($_SESSION['rol'] == 'administrador'){
      echo $this->View->render('portafolioAdmin.php',array('role'=>$_SESSION['rol'],'nombre'=>$_SESSION['nombre']));
    }
    else{
      header('location:/');
    }
  }

  public function sectionSave(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){      
      extract($_POST);
      $seccion = new \Model\Portafolio();
      $seccion->nombreSeccion = $nombre;
      $seccion->saveSection();
    }
  }

  public function getIntoManage(){
    $portafolio = new \Model\Portafolio();
    $portafolio->showIntoManage();    
  }

  public function imagenSave(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $foto = $_FILES['foto'];
      $extension = $this->getFileExtension($foto['name']);
      if($extension === ".jpg" || $extension == ".jpeg" || $extension == ".png" || $extension == ".bmp" || $extension == ".gif"){
        try
        {
          extract($_POST);
          $myDir = "assets/images/portafolio/".$foto['name'];
          move_uploaded_file($foto["tmp_name"], $myDir);
          $imagen = new \Model\Portafolio();
          $imagen->nombreImagen = $foto['name'];
          $imagen->rutaImagen = $myDir;
          $imagen->extensionImagen = $extension;
          $imagen->saveImage($id);          
        }
        catch(Exception $ex)
        {
          echo "ERROR: ".$ex;
        }
      }
      else{
        echo "Error, el archivo no es una imagen valida";
      }
    }
  }

  public function imagenDelete(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      extract($_POST);
      $imagen = new \Model\Portafolio();
      $imagen->removeImagen($id);
    }
  }

  public function sectionDelete(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      extract($_POST);
      $imagen = new \Model\Portafolio();
      $imagen->removeSection($id);
    }
  }

  public function sectionUpdate(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      extract($_POST);
      $seccion = new \Model\Portafolio();
      $seccion->nombreSeccion = $nombre;
      $seccion->updateSeccion($id);
    }
  }

}

?>
