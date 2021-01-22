<?php

class Pedido{
    private $id = null;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $costo;
    private $estado;
    private $fecha;
    private $hora;
    private $rep = "/d|\"/";

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        if(!empty($id) && is_numeric($id) && preg_match("/[0-9]/", (int)$id)){
            $this->id = $id;
        }else $this->id = null;
    }

    public function getUsuarioId(){
        return $this->usuario_id;
    }
    public function setUsuarioId($usuario_id){
        if(!empty($usuario_id) && is_numeric($usuario_id) && preg_match("/[0-9]/", (int)$usuario_id)){
            $this->usuario_id = $usuario_id;
        }else $this->usuario_id = null;
    }

    public function getProvincia(){
        return $this->provincia;
    }
    public function setProvincia($provincia){
        if(!empty($provincia) && !is_numeric($provincia) && !preg_match($this->rep, $provincia)){
            $this->provincia = $provincia;
        }else $this->provincia = null;
    }

    public function getLocalidad(){
        return $this->localidad;
    }
    public function setLocalidad($localidad){
        if(!empty($localidad) && !is_numeric($localidad) && !preg_match($this->rep, $localidad)){
            $this->localidad = $localidad;
        }else $this->localidad = null;
    }

    public function getDireccion(){
        return $this->direccion;
    }
    public function setDireccion($direccion){
        if(!empty($direccion) && !is_numeric($direccion) && preg_match("/^[A-Za-z0-9.,+]/", $direccion)){
            $this->direccion = $direccion;
        }else $this->direccion = null;
    }

    public function getCosto(){
        return $this->costo;
    }
    public function setCosto($costo){
        if(!empty($costo) && is_numeric($costo) && preg_match("/[0-9]/", (int)$costo)){
            $this->costo = (float)$costo;
        }else $this->costo = null;
    }

    public function getEstado(){
        return $this->estado;
    }
    public function setEstado($estado){
        if(!empty($estado) && !is_numeric($estado) && !preg_match($this->rep, $estado)){
            $this->estado = $estado;
        }else $this->estado = null;
    }

    public function getFecha(){
        return $this->fecha;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getHora(){
        return $this->hora;
    }
    public function setHora($hora){
        $this->hora = $hora;
    }

    public function GetAll(){
        $sql = "SELECT * FROM pedidos";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        return $stmt;
    }

    public function GetOne(){
        $id = $this->getId();
        $sql = "SELECT * FROM pedidos WHERE id='$id'";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        return $stmt;
    }

    public function GetOneByUser(){
        $id = $this->getUsuarioId();
        $sql = "SELECT p.id, p.coste FROM pedidos p "
            ."INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
        ."WHERE p.usuario_id='$id' ORDER BY id DESC LIMIT 1";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        return $stmt;
    }

    public function GetAllByUser(){
        $id = $this->getUsuarioId();
        $sql = "SELECT p.* FROM pedidos p "
            ."INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
            ."WHERE p.usuario_id='$id' ORDER BY id DESC";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        return $stmt;
    }

    public function GetProdcutosByPedidos(){
//        $sql = "SELECT * FROM productos WHERE id IN "
//        ."(SELECT producto_id FROM lineas_pedidos WHERE pedido_id='$id')";
        $id = $this->getId();
        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
            ."INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
            ."WHERE lp.pedido_id='$id'";

        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        return $stmt;
    }

    public function save($id_borrar=null){
        $id = $this->getId();
        $usuario_id = $this->getUsuarioId();
        $provincia = $this->getProvincia();
        $localidad = $this->getLocalidad();
        $direccion = $this->getDireccion();
        $costo = $this->getCosto();

        if($id_borrar==null){

            $sql ="INSERT INTO pedidos(id,usuario_id,provincia,localidad,direccion,coste,estado,fecha,hora) VALUES('$id','$usuario_id','$provincia','$localidad','$direccion',$costo, 'confirm', CURRENT_DATE, CURRENT_TIME)";
            $stmt = Conexion::getStatement($sql);
            $stmt->execute();

            $result = $stmt ? true : false;
        }

        return $result;
    }

    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido_id';";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        $pedido = $stmt->fetch();
        $id_pedido =  $pedido["pedido_id"];

        foreach ($_SESSION["carrito"] as $i=>$value){
            $id_producto = $_SESSION["carrito"][$i]["producto"]["id"];

            $insert = "INSERT INTO lineas_pedidos VALUES(null, '$id_pedido', '$id_producto', '{$_SESSION["carrito"][$i]["unidades"]}')";

            $stmt = Conexion::getStatement($insert);
            $stmt->execute();
        }

        $result = $stmt ? true : false;
        return $result;
    }

    public function updateOne(){
        $id = $this->getId();
        $estado = $this->getEstado();
        $sql = "UPDATE pedidos SET estado='$estado' WHERE id='$id'";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        $result = $stmt ? true : false;

        return $result;
    }

}