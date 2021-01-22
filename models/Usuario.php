<?php


class Usuario{
    private $id = null;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol = "user";
    private $imagen = "null";
    private $rep = "/d|\"/";


    public function getId(){
        return $this->id;
    }


    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        if(!empty($nombre) && !is_numeric($nombre) && !preg_match($this->rep, $nombre)){
            $this->nombre = $nombre;
        }else $this->nombre = null;;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match($this->rep, $apellidos)){
            $this->apellidos = $apellidos;
        }else $this->apellidos = null;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email){
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }else $this->email = null;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $password_segura = "";
        if(!empty($password)){
            $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' =>4]);
            $this->password = $password_segura;
        }else $this->password = false;
    }

    public function getRol(){
        return $this->rol;
    }

    public function setRol($rol){
        $this->rol = $rol;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function Save(){

        $result = false;

        if($this->nombre != false && $this->apellidos != false && $this->email != false && $this->password != false){
            $sql = "INSERT INTO usuarios(id, nombre, apellidos, email, password, rol, imagen) VALUES ('{$this->id}','{$this->nombre}', '{$this->apellidos}', '{$this->email}', '{$this->password}', '{$this->rol}', '{$this->imagen}')";
            $stmt = Conexion::getStatement($sql);
            $stmt->execute();

            if($stmt){
                $result = true;
            }
        }

        return $result;
    }

    public function login($password){
        $result = false;

        $email = $this->getEmail();

        //Comprobar la existencia del usuario
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $login = Conexion::getStatement($sql);
        $login->execute();

        $fila = $login->fetch();

        if($login && $login->rowCount()==1){
            //verificar la contraseña
            $verify = password_verify($password, $fila["password"]);

            if($verify){
                $result=$fila;
            }
        }

        return $result;
    }

}