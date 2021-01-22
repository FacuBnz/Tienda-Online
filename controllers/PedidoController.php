<?php

require_once 'models/Pedido.php';
class PedidoController
{
    public function hacer(){
        require_once 'views/pedido/hacer.php';
    }
    public function add(){
        Utils::isIdentity();
        if (isset($_POST)){
            //Guardar datos en la base de datos
            $stats = Utils::statsCarrito();
            $pedido = new Pedido();
            $pedido->setUsuarioId($_SESSION["identity"]["id"]);
            $pedido->setProvincia($_POST["provincia"]);
            $pedido->setLocalidad($_POST["localidad"]);
            $pedido->setDireccion($_POST["direccion"]);
            $pedido->setCosto($stats["total"]);

            $save = $pedido->save();

            //Guardar Linea pedido
            $save_linea = $pedido->save_linea();

            if($save && $save_linea){
                $_SESSION["pedido"] = "completed";
            }else{
                $_SESSION["pedido"] = "failed";
            }
            header("Location:".base_url."pedido/confirmado");
        }else{
            //Redirigir al index
            header("Location:".base_url);
        }
    }

    public function confirmado(){

        Utils::isIdentity();
        $pedido = new Pedido();
        $pedido->setUsuarioId($_SESSION["identity"]["id"]);
        $pedido = $pedido->GetOneByUser();
        $pedido = $pedido->fetch();

        $pedido_productos = new Pedido();
        $pedido_productos->setId($pedido["id"]);
        $pedido_productos = $pedido_productos->GetProdcutosByPedidos();
        $pedido_productos = $pedido_productos->fetchAll();


        require_once 'views/pedido/confirmado.php';
    }

    public function misPedidos(){

        Utils::isIdentity();
        $pedido = new Pedido();
        $pedido->setUsuarioId($_SESSION["identity"]["id"]);
        $pedido = $pedido->GetAllByUser();
        $pedidos = $pedido->fetchAll();
        require_once 'views/pedido/pedidos.php';
    }

    public function detalle(){

        Utils::isIdentity();
        if(isset($_GET) && isset($_GET["id"]) && is_numeric($_GET["id"])){
            $detalle = new Pedido();
            $detalle->setId($_GET["id"]);
            $detalle = $detalle->GetOne();
            $detalle = $detalle->fetch();

            $productos = new Pedido();
            $productos->setId($_GET["id"]);
            $productos = $productos->GetProdcutosByPedidos();
            $productos = $productos->fetchAll();
            require_once 'views/pedido/detalle.php';
        }else{
            header("Location:".base_url."pedido/misPedidos");
        }
    }

    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedido = $pedido->GetAll();
        $pedidos = $pedido->fetchAll();

        require_once 'views/pedido/pedidos.php';
    }

    public function estado(){
        Utils::isAdmin();
        if(isset($_POST)){
            //Update del pedido;
            $pedido = new Pedido();
            $pedido->setId($_POST["id_pedido"]);
            $pedido->setEstado($_POST["estado"]);
            $pedido->updateOne();

            header("Location:".base_url."pedido/detalle&id=".$pedido->getId());

        }else{
            header("Location:".base_url);
        }
    }
}