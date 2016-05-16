<?php namespace Controller;
class usuarioscurController extends BaseController {
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
    public function hasCuourses(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            extract($_POST);
            $cursos = new \Model\Usuario_cursos();
            $cursos->whatCoursesHas($id);
        }
    }
    public function assignedcurso(){
        extract($_POST);
        $cursos_assigned = json_decode(stripslashes($cursos));
        $usuario_curso = new \Model\Usuario_cursos();
        $usuario_curso->delete($usuario_id);
        try{
            foreach($cursos_assigned as $cursos)
            {
                $usuario_curso->usuario_id = $usuario_id;
                $usuario_curso->curso_id = $cursos->curso_id;
                $usuario_curso->save();
            }
             echo json_encode(array('status'=>'200','message'=>'Los cursos fueron guardados'));
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

}
