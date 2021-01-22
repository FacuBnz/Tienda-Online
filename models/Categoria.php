<?php


class Categoria{
    private $id;
    private $nombre;
    private $rep = "/d|\"/";

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        if(!empty($id) && is_numeric($id) && preg_match("/[0-9]/", (int)$id)){
            $this->id = $id;
        }else $this->id = null;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        if(!empty($nombre) && !is_numeric($nombre) && !preg_match($this->rep, $nombre)){
            $this->nombre = $nombre;
        }else $this->nombre = null;
    }

    public function GetAll(){
        $sql = "SELECT * FROM categorias ORDER BY id ASC";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        return $stmt;
    }

    public function GetOne(){
        $id = $this->getId();
        $sql = "SELECT * FROM categorias WHERE id='$id'";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        return $stmt;
    }


    public function Save(){

        $nombre = $this->getNombre();

        $sql = "INSERT INTO categorias(nombre) VALUES('$nombre')";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        $result = $stmt ? true : false;

        return $result;
    }

}