<?php namespace Model;
class BaseModel{
    public static function init(){
        /*---------------------------------------
        - Requerimos el autoload para asi poder
        - cargar las clases en tiempo de ejecucion
        ----------------------------------------*/
        require_once 'autoload.php';
        \Autoload::run();
    }
}



?>
