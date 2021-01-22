<?php

require_once 'models/Producto.php';
require_once 'models/Categoria.php';
class ProductoController
{
    public function index(){
        $producto = new Producto();
        $algunos = $producto->GetRandom(6);

        //renderizar la vista
        require_once 'views/producto/destacados.php';
    }

    public function ver(){

        if(isset($_GET["id"])){
            //obtener producto
            $producto = new Producto();
            $product = $producto->GetOne($_GET["id"]);

            //rederizar vista
            require_once 'views/producto/ver.php';

        }else{
            header("Location:".base_url);
        }
    }

    public function gestion(){
        Utils::isAdmin();
        $producto = new Producto();
        $productos = $producto->GetAll();
        require_once 'views/producto/gestion.php';
    }

    public function crear(){
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function Save(){
        Utils::isAdmin();
        if(isset($_POST)){
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : false;
            $precio = isset($_POST["precio"]) ? $_POST["precio"] : false;
            $stock = isset($_POST["stock"]) ? $_POST["stock"] : false;
            $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : false;

            if($nombre && $descripcion && $precio && $stock && $categoria){
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoriaId($categoria);

                //Guardar imagen
                $file = $_FILES["imagen"];
                $filename = $file["name"];
                $mimetype = $file["type"];

                if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){
                    if(!is_dir("uploads/images")){
                        mkdir("uploads/images", 0777,true);
                    }
                    move_uploaded_file($file["tmp_name"], "uploads/images/".$filename);
                    $producto->setImagen($filename);
                }else{
                    $_SESSION["producto"] = "failed";
                }

                if(!isset($_POST["id_borrar"])){
                    $save = $producto->save();
                }else{
                    $save = $producto->save($_POST["id_borrar"]);
                }

                if($save){
                    $_SESSION["producto"] = "completed";
                }else{
                    $_SESSION["producto"] = "failed";
                }
            }else{
                $_SESSION["producto"] = "failed";
            }
        }else{
            $_SESSION["producto"] = "failed";
        }

        header("Location:".base_url."producto/gestion");
    }

    public function editar(){
        Utils::isAdmin();
        if(isset($_GET["id"])){
            $producto = new Producto();
            $product = $producto->GetOne($_GET["id"]);
            require_once 'views/producto/editar.php';

        }else{
            header("Location:".base_url."producto/gestion");
        }

    }

    public function eliminar(){
        Utils::isAdmin();

        if(isset($_GET["id"])){
            $producto = new Producto();
            $producto->setId($_GET["id"]);
            $delete = $producto->delete();

            if($delete){
                $_SESSION["delete"] = "completed";
            }else{
                $_SESSION["delete"] = "failed";
            }
        }else{
            $_SESSION["delete"] = "failed";
        }

        header("Location:".base_url."producto/gestion");
    }

}