<?php


class Producto{

    private $id = null;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta = null;
    private $fecha;
    private $imagen;
    private $rep = "/d|\"/";


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCategoriaId()
    {
        return $this->categoria_id;
    }


    public function setCategoriaId($categoria_id)
    {
        if(!empty($categoria_id) && is_numeric($categoria_id) && preg_match("/[0-9]/", (int)$categoria_id)){
            $this->categoria_id = $categoria_id;
        }else $this->categoria_id = null;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        if(!empty($nombre) && !is_numeric($nombre) && !preg_match($this->rep, $nombre)){
            $this->nombre = $nombre;
        }else $this->nombre = null;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        if(!empty($descripcion) && !is_numeric($descripcion) && preg_match("/^[A-Za-z0-9.,+]/", $descripcion)){
            $this->descripcion = $descripcion;
        }else $this->descripcion = null;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        if(!empty($precio) && is_numeric($precio) && preg_match("/[0-9]/", (float)$precio)){
            $this->precio = $precio;
        }else $this->precio = null;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        if(!empty($stock) && is_numeric($stock) && preg_match("/[0-9]/", (int)$stock)){
            $this->stock = $stock;
        }else $this->stock = null;
    }

    public function getOferta()
    {
        return $this->oferta;
    }

    public function setOferta($oferta)
    {
        $this->oferta = $oferta;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function GetAll(){
        $sql = "SELECT * FROM productos";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        return $stmt;
    }

    public function GetOne($id){
        $sql = "SELECT * FROM productos WHERE id='$id'";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        return $stmt;
    }

    public function GetRandom($limit){
        $sql = "SELECT * FROM productos ORDER BY RAND() LIMIT $limit";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        return $stmt;
    }

    public function GetForCategories(){
        $id = $this->getCategoriaId();
        $sql = "SELECT * FROM productos WHERE categoria_id='$id'";
        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        return $stmt;
    }

    public function save($id_borrar=null){
        $id = $this->getId();
        $categoria_id = $this->getCategoriaId();
        $nombre = $this->getNombre();
        $descripcion = $this->getDescripcion();
        $precio = $this->getPrecio();
        $stock = $this->getStock();
        $oferta = $this->getOferta();
        $imagen = $this->getImagen();

        if($id_borrar==null){

            $sql ="INSERT INTO productos(id, categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES('$id','$categoria_id','$nombre','$descripcion','$precio','$stock','$oferta',CURRENT_DATE ,'$imagen')";
            $stmt = Conexion::getStatement($sql);
            $stmt->execute();

            $result = $stmt ? true : false;
        }else{
            $sql = "UPDATE productos SET categoria_id='$categoria_id', nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock', oferta='$oferta',fecha=CURRENT_DATE, imagen='$imagen' WHERE id='$id_borrar'";
            $stmt = Conexion::getStatement($sql);
            $stmt->execute();

            $result = $stmt ? true : false;
        }

        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM productos WHERE id={$this->getId()}";

        $stmt = Conexion::getStatement($sql);
        $stmt->execute();

        $result = $stmt ? true : false;
        return $result;
    }

}