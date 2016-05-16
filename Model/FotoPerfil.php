<?php namespace Model;
  class FotoPerfil {
    public $nombreSeccion;
    public $nombreImagen;
    public $extensionImagen;
    public $rutaImagen;
    public $enabled = 1;


    public function savePortada(){
    	session_start();
    	$idUser = $_SESSION['id'];
		$datos = new PDO\Datos();
		$datos->Conectar();
		$imagen = $datos->Insert("INSERT INTO imagenes(nombre, ruta, ext, enabled) VALUES ('$this->nombreImagen', '$this->rutaImagen', '$this->extensionImagen', '$this->enabled')");
		$imagenID = $datos->Select("Select max(id) as maximo from imagenes");
		$imgid = $imagenID[0]['maximo'];
		$portafolio = $datos->Insert("UPDATE usuarios SET foto_portada = '$imgid' WHERE id = $idUser");
		$datos->Desconectar();
		echo json_encode(array('status'=>'success', 'imagenRuta'=>$this->rutaImagen));
    }

    public function savePerfil(){
        session_start();
        $idUser = $_SESSION['id'];
        $datos = new PDO\Datos();
        $datos->Conectar();
        $imagen = $datos->Insert("INSERT INTO imagenes(nombre, ruta, ext, enabled) VALUES ('$this->nombreImagen', '$this->rutaImagen', '$this->extensionImagen', '$this->enabled')");
        $imagenID = $datos->Select("Select max(id) as maximo from imagenes");
        $imgid = $imagenID[0]['maximo'];
        $portafolio = $datos->Insert("UPDATE usuarios SET foto_perfil = '$imgid' WHERE id = $idUser");
        $datos->Desconectar();
        echo json_encode(array('status'=>'success', 'imagenRuta'=>$this->rutaImagen));
    }

    public function getAllUser(){
    	session_start();
    	$idUser = $_SESSION['id'];
    	$datos = new PDO\Datos();
    	$datos->Conectar();
    	$fotoPortada = $datos->Select("SELECT imagenes.ruta AS imagenPortada FROM imagenes JOIN usuarios ON imagenes.id = usuarios.foto_portada WHERE usuarios.id = $idUser");
        $fotoPerfil = $datos->Select("SELECT imagenes.ruta AS imagenPerfil FROM imagenes JOIN usuarios ON imagenes.id = usuarios.foto_perfil WHERE usuarios.id = $idUser");
    	$datos->Desconectar();
    	echo json_encode(array("fotoPortada"=>$fotoPortada, "fotoPerfil"=>$fotoPerfil));
    }

  }
?>
