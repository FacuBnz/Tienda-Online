<?php


class Utils{
    public static function DeleteSession($name){

        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    public static function isAdmin(){
        if(!isset($_SESSION["admin"])){
            header("Location:".base_url);
        }else return true;
    }
    public static function isIdentity(){
        if(!isset($_SESSION["identity"])){
            header("Location:".base_url);
        }else return true;
    }

    public static function ShowCategorias(){
        require_once 'models/Categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->GetAll();

        return $categorias;
    }

    public static function statsCarrito(){
        $stats = array(
          "count"=>0,
          "total"=>0
        );

        if(isset($_SESSION["carrito"])){
            foreach ($_SESSION["carrito"] as $i=>$value){
                $stats["count"] += $_SESSION["carrito"][$i]["unidades"];
                $stats["total"] += $_SESSION["carrito"][$i]["unidades"] * $_SESSION["carrito"][$i]["producto"]["precio"];
            }
        }

        return $stats;
    }
    public static function deleteCarrito(){
        unset($_SESSION["carrito"]);
    }

    public static function ShowEstatus($status){
        $value ="";

        if($status == "confirm"){
            $value = "Pendiente";
        }elseif ($status == "preparation"){
            $value = "En preparación";
        }elseif ($status == "ready"){
            $value = "Preparado para enviar";
        }else{
            $value = "Enviado";
        }

        return $value;
    }
}