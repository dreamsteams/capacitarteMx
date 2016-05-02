<?php namespace Controller;
class fotoPerfilController extends BaseController {
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

  public function imagenSave(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $foto = $_FILES['filePerfil'];      
      $extension = $this->getFileExtension($foto['name']);      
      if($extension == ".jpg" || $extension == ".jpeg" || $extension == ".png" || $extension == ".bmp" || $extension == ".gif"){
        try
        { 
          $nombreImagenNew = "_".date('Y-m-d')."_".rand()."_MX_".$foto['name'];
          $myDir = "assets/images/image-portada/".$nombreImagenNew;
          move_uploaded_file($foto["tmp_name"], $myDir);
          $imagen = new \Model\FotoPerfil();
          $imagen->nombreImagen = $nombreImagenNew;
          $imagen->rutaImagen = $myDir;
          $imagen->extensionImagen = $extension;
          $imagen->savePortada();          
        }
        catch(Exception $ex)
        {
          echo json_encode("ERROR: ".$ex);
        }
      }
      else{
        echo json_encode(array('status'=>"invalid"));
      }
    }
  }

  public function getAllUser(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $fotos = new \Model\FotoPerfil();
      $fotos->get();
    }
  }

}

?>