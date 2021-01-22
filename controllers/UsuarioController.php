<?php

require_once 'models/Usuario.php';
class UsuarioController{

    public function index(){
        echo "controlador usuarios, Accion index";
    }

    public function Register(){
        require_once 'views/usuario/registro.php';
    }

    public function Save(){
        //obtener datos que llegan por post
        if(isset($_POST)){
            $usuario = new Usuario();

            $usuario->setNombre($_POST["nombre"]);
            $usuario->setApellidos($_POST["apellido"]);
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword($_POST["password"]);

            $save = $usuario->Save();

            if($save){
                $_SESSION["register"] = "complete";
            }else {
                $_SESSION["register"] = "failed";
            }
        }else{
            $_SESSION["register"] = "failed";
        }
        header("Location:".base_url."usuario/register");
    }

    public function login(){
        //obtener datos que llegan por post
        if(isset($_POST)){

            //indetificar el usuario
            //consulta a la base de datos
            $user = new Usuario();
            $user->setEmail($_POST["email"]);
            $identity = $user->login($_POST["password"]);


            if($identity){
                $_SESSION["identity"] = $identity;

                if($identity["rol"] == "admin"){
                    $_SESSION["admin"] = true;
                }
            }else{
                $_SESSION["error_login"] = "Identificacion fallida";
            }

        }
        header("Location:".base_url);
    }

    public function logout(){
        if (isset($_SESSION["identity"])){
            unset($_SESSION["identity"]);
        }

        if (isset($_SESSION["admin"])){
            unset($_SESSION["admin"]);
        }

        header("Location:".base_url);
    }
}