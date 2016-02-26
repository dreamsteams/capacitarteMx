<?php namespace Model;
class Post extends BaseModel{
    //Solo es una funcion ejemplo
    public function __construct(){
        $this::init();
    }
    public static function show($message){
        $datos = new \Model\PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from posts");
        print_r($posts);
    }
}


?>
