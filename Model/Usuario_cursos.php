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
            $datos->Insert("INSERT INTO  usuarios_tienen_cursos VALUES(null,'$this->usuario_id','$this->curso_id','0000-00-00','0000-00-00')");
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }
    }
    public function delete($id){
        $datos = new PDO\Datos();
        try{
            $datos->Conectar();
            $cursos=$datos->Delete("DELETE FROM usuarios_tienen_cursos where usuario_id = '$id' ");

        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }
    }
    public static function hasCurso($idCurso,$usuario_id){
        $datos = new PDO\Datos();
        try{
            $datos->Conectar();
            $cursos=$datos->Select("SELECT count(id) as 'has' from usuarios_tienen_cursos where usuario_id = '$usuario_id'  and curso_id = '$idCurso'");
            if($cursos[0]['has'] == 0)
                return '403';
            else
                return '200';
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }

    }
    public function whatCoursesHas($id){
       $datos = new PDO\Datos();
        try{
            $datos->Conectar();
            $cursos=$datos->SelectJson("SELECT curso_id from usuarios_tienen_cursos where usuario_id = $id");
            echo $cursos;
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }
    }

}
