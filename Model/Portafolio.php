<?php namespace Model;
  class Portafolio {
    public $nombreSeccion;
    public $nombreImagen;
    public $extensionImagen;
    public $rutaImagen;
    public $enabled = 1;

    public function saveSection(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Insert("INSERT INTO secciones_portafolio(nombre) VALUES ('$this->nombreSeccion')");
        $query = $datos->Select("Select max(id) AS 'Last', min(id) AS 'First' from secciones_portafolio");
        $datos->Desconectar();
        echo json_encode(array(0=>"success", 1=>$query));
    }

    public function showIntoManage(){
      $datos = new PDO\Datos();
      $datos->Conectar();      
      $portafolio = array("imagenes"=>[], "secciones"=>[]);

      $secciones = $datos->Select("SELECT * FROM secciones_portafolio");
      array_push($portafolio["secciones"], $secciones);
      foreach ($secciones as $key => $value) {
        $seccId = $value['id'];
        $info = $datos->Select("SELECT imagenes.ruta AS imagenRuta, imagenes.id AS imagenId, secciones_portafolio.id AS seecionId FROM secciones_portafolio JOIN portafolio ON secciones_portafolio.id = portafolio.seccion_id JOIN imagenes ON portafolio.imagen_id = imagenes.id WHERE portafolio.seccion_id = $seccId AND imagenes.enabled = '1'");
        array_push($portafolio["imagenes"], $info);
      }

      $datos->Desconectar();
      echo json_encode($portafolio);
    }

    public function saveImage($id){
      $datos = new PDO\Datos();
      $datos->Conectar();
      $imagen = $datos->Insert("INSERT INTO imagenes(nombre, ruta, ext, enabled) VALUES ('$this->nombreImagen', '$this->rutaImagen', '$this->extensionImagen', '$this->enabled')");
      $imagenID = $datos->Select("Select max(id) as maximo from imagenes");
      $imgid = $imagenID[0]['maximo'];
      $portafolio = $datos->Insert("INSERT INTO portafolio (seccion_id, imagen_id) VALUES ('$id', '$imgid')");
      $datos->Desconectar();        
      echo json_encode(array('imagenId'=>$imagenID[0]['maximo'], 'imagenRuta'=>"/".$this->rutaImagen));
    }

    public function removeSection($id){
      $datos = new PDO\Datos();
      $datos->Conectar(); 
      $datos->Delete("DELETE FROM secciones_portafolio WHERE id = $id;");
      $datos->Desconectar();
      echo json_encode(array(0=>'success'));
    }

    public function removeImagen($id){
      $datos = new PDO\Datos();
      $datos->Conectar();
      $datos->Delete("DELETE FROM imagenes WHERE id = $id");
      $datos->Desconectar();
      echo json_encode(array(0=>'success'));
    }

    public function updateSeccion($id){
      $datos = new PDO\Datos();
      $datos->Conectar();      
      $datos->Update("UPDATE secciones_portafolio SET nombre = '$this->nombreSeccion' where id = '$id'");
      $datos->Desconectar();
      echo json_encode(array(0=>"success"));
    }

  }


?>
