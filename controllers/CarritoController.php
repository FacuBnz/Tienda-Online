<?php

require_once 'models/Producto.php';

class CarritoController{
    public function index(){
        require_once 'views/carrito/index.php';
    }

    public function add(){

        if($_GET["id"]){
            $producto_id = $_GET["id"];

        }else{
            header("Location:".base_url);
        }

        if(isset($_SESSION["carrito"])){

            $encontrado = false;

            foreach ($_SESSION["carrito"] as $i => $value){
                if($_SESSION["carrito"][$i]["producto"]["id"] == $producto_id){
                    $_SESSION["carrito"][$i]["unidades"]++;
                    $encontrado = true;
                }
            }
        }

        if(!$encontrado){
            $producto = new Producto();
            $producto= $producto->GetOne($producto_id);

            if($producto){
                $producto = $producto->fetch();

                $_SESSION["carrito"][] = array(
                    "unidades"=>1,
                    "producto"=>$producto
                );
            }
        }

        header("Location:".base_url."carrito/index");

    }

    public function remove(){
        if($_GET["id"]){
            $producto_id = $_GET["id"];

        }else{
            header("Location:".base_url);
        }
        if(isset($_SESSION["carrito"])){

            foreach ($_SESSION["carrito"] as $i => $value){
                if($_SESSION["carrito"][$i]["producto"]["id"] == $producto_id){

                    $_SESSION["carrito"][$i]["unidades"]--;

                }
            }
        }

        header("Location:".base_url."carrito/index");
    }

    public function deleteCarrito(){
        unset($_SESSION["carrito"]);
        header("Location:".base_url."carrito/index");
    }

}