<?php
namespace Model;
class Usuario_cursos {
    public $id;
    public $curso_id;
    public $usuario_id;

    public function save(){
        $datos = new PDO\Datos();
        try{
            $datos->Conectar();
            $cursos=$datos->Insert("INSERT INTO `usuarios_tienen_cursos`(`id`, `usuarios_id`, `curso_id`) VALUES (null,'$this->usuario_id','$this->curso_id')");

            echo json_encode(array('status'=>'200'));
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }
    }
    public function hasCurso($idCurso){
        $datos = new PDO\Datos();
        $IDUSER = $_SESSION['id'];
        try{
            $datos->Conectar();
            $cursos=$datos->Insert("SELECT count(id) as 'has' from usuarios_tienen_cursos where usuario_id = $IDUSER  and curso_id = $idCurso ");
            if($cursos[0]['has'] == 0)
                return '403';
            else
                return '200';
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }

    }

}
