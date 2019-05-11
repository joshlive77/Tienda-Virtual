<?php

class Pedido{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;

    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsuario_id()
    {
        return $this->Usuario_id;
    }

    public function setUsuario_id($Usuario_id)
    {
        $this->Usuario_id = $Usuario_id;
    }

    public function getProvincia()
    {
        return $this->Provincia;
    }

    public function setProvincia($Provincia)
    {
        $this->Provincia = $this->db->real_escape_string($Provincia);
    }

    public function getLocalidad()
    {
        return $this->Localidad;
    }

    public function setLocalidad($Localidad)
    {
        $this->Localidad = $this->db->real_escape_string($Localidad);
    }

    public function getDireccion()
    {
        return $this->Direccion;
    }

    public function setDireccion($Direccion)
    {
        $this->Direccion = $this->db->real_escape_string($Direccion);
    }

    public function getCoste()
    {
        return $this->Coste;
    }

    public function setCoste($Coste)
    {
        $this->Coste = $Coste;
    }

    public function getEstado()
    {
        return $this->Estado;
    }

    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }
 
    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getHora()
    {
        return $this->Hora;
    }

    public function setHora($Hora)
    {
        $this->Hora = $Hora;
    }


    //METODOS
    public function getAll(){
        $pedidos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $pedidos;
    }
    
    public function getOne(){
        $pedidos = $this->db->query("SELECT * FROM pedidos WHERE id={$this->getId()}");
        return $pedidos->fetch_object();
    }

    public function getOneByUser(){
        $sql = "SELECT p.id, p.coste FROM pedidos p "
                // ."INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
                ."WHERE p.usuario_id = {$this->getUsuario_id()} "
                ."ORDER BY id DESC LIMIT 1";
        // echo $sql;
        $pedido = $this->db->query($sql);
        // echo $this->db->error;
        // die();
        return $pedido->fetch_object();
    }

    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p "
                // ."INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
                ."WHERE p.usuario_id = {$this->getUsuario_id()} "
                ."ORDER BY id DESC";
        // echo $sql;
        $pedido = $this->db->query($sql);
        // echo $this->db->error;
        // die();
        return $pedido;
    }

    public function getProductByPedido($id){
        // $sql = "SELECT * FROM productos"
        //         ." WHERE id IN"
        //         ." (SELECT producto_id FROM lineas_pedidos"
        //         ." WHERE pedido_id{$id}";

        $sql = "SELECT pr.*, lp.unidades FROM productos pr"
                ." INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id"
                ." WHERE lp.pedido_id = {$id}";
        $productos = $this->db->query($sql);  
        // echo $sql;
        // echo $this->db->error;
        // die();
        // echo $this->db->error;   
        // die();   
        return $productos; 
    }

    public function save(){

        $sql = "INSERT INTO pedidos VALUES (NULL,'{$this->getUsuario_id()}', '{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
        $save = $this->db->query($sql);
        // echo $sql;
        // echo $this->db->error;
        // die();
        $result = false;
        if($save){
            return true;
        }
        return $result;
    }

    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido' ";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];
            $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id}, {$elemento['unidades']}) ";
            $save = $this->db->query($insert);
        }
        var_dump($pedido_id);
        $result = false;
        if($save){
            return true;
        }
        return $result;
    }

    public function updateOne(){
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}'"
                ." WHERE id = {$this->id}";
        $save = $this->db->query($sql);
        // echo $sql;
        // echo $this->db->error;
        // die();
        $result = false;
        if($save){
            return true;
        }
        return $result;
    }
}

