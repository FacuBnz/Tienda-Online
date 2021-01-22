<?php

require_once 'models/Categoria.php';
require_once 'models/Producto.php';
class CategoriaController
{
    public function index(){
        $categoria = new Categoria();
        $categorias = $categoria->GetAll();

        require_once "views/categoria/index.php";
    }

    public function ver(){

        if(isset($_GET["id"])){

            //Conseguir la categoria
            $categoria = new Categoria();
            $categoria->setId($_GET["id"]);
            $titulo = $categoria->GetOne();

            //Conseguir los productos
            $producto = new Producto();
            $producto->setCategoriaId($_GET["id"]);
            $productos = $producto->GetForCategories();

            //rederizar la vista
            require_once 'views/producto/categoria.php';

        }else header("Location:".base_url);

    }

    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save(){
        Utils::isAdmin();

        //Guardar la categoria en la base de datos
        if(isset($_POST["nombre"])){
            $categoria = new Categoria();
            $categoria->setNombre($_POST["nombre"]);
            $categoria->Save();
        }

        header("Location:".base_url."categoria/index");
    }
}