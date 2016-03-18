<?php namespace Model;
class Usuario_tiene_gusto{
    private $usuarios_id;
    private $gustos_id;
    public function __contruct(){

    }
    public static function show(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $posts=$datos->Select("Select * from usuarios_tiene_gustos");
        return $posts;
    }
    public function save(){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Insert("INSERT INTO usuarios_tiene_gustos VALUES(NULL,'$this->gustos_id','$this->usuarios_id')");
        $datos->Desconectar();
    }
    public function update($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $datos->Update("UPDATE usuarios_tiene_gustos SET gustos_id = '$this->gustos_id', usuarios_id = '$this->usuarios_id' where id = '$id'");
        $datos->Desconectar();
    }
    public function find($id = 0){
        $datos = new PDO\Datos();
        $datos->Conectar();
        $query=$datos->SelectJson("Select * from usuarios_tiene_gustos where id = '$id'");
        $datos->Desconectar();
        return $query;
    }
}
