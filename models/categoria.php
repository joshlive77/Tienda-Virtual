<?php
class Categoria{
    private $id;
    private $nombre;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    function setId($id){
        $this->id = $id;
    }
    function getId(){
        return $this->id;
    }

    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function getNombre(){
        return $this->nombre;
    }

    public function getAll(){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
        return $categorias;
    }

    public function getOne(){
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()};");
        return $categoria->fetch_object();
    }

    public function save(){
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}');";
        $save = $this->db->query($sql);
        $result = false;
        if($save){
            return true;
        }
        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM categorias WHERE id={$this->id}";
        $delete = $this->db->query($sql);
        $result = false;
        if($delete){
            return true;
        }
        return $result;
    }


    public function edit(){

        $sql = "UPDATE categorias SET nombre='{$this->getNombre()}'";

        $sql .=" WHERE id = {$this->getId()};";

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