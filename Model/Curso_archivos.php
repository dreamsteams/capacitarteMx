<?php
namespace Model;
class Curso_archivos {
    public $id;
    public $curso_id;
    public $archivo_id;

    public function save(){
        $datos = new PDO\Datos();
        try{
            $datos->Conectar();
            $cursos=$datos->Insert("INSERT INTO `cursos_tienen_archivos`(`id`, `curso_id`, `archivo_id`) VALUES (null,'$this->curso_id','$this->archivo_id')");

            echo json_encode(array('status'=>'200'));
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }
    }
    public function findFiles($idCurso){
        $datos = new PDO\Datos();
        try{
            $datos->Conectar();
            $cursos=$datos->Insert("SELECT  archivos.nombre,archivos.ruta FROM cursos_tienen_archivos inner join
                                    archivos on archivos.id = cursos_tiene_archivos.archivo_id
                                    WHERE cursos_tienen_archivos.curso_id = $idCurso");
            if($cursos)
                echo json_encode(array('status'=>'200','files'=>$cursos));
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }

    }

}
