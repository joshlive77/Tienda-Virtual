<!-- esto es una entidad una representacion de una fila de la base de dadtos -->
<?php
// EN ESTE MODELO EL USUARIO INTERACTUA CON LA BASE DE DATOS
class Usuario{
    // creamos los valores de la tabla usuario
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
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

    function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }
    function getApellidos(){
        return $this->apellidos;
    }

    function setEmail($email){ 
        $this->email = $this->db->real_escape_string($email);
    }
    function getEmail(){
        return $this->email;
    }

    function setPassword($password){
        $this->password = $password;
    }
    function getPassword(){
        return password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function setRol($rol){
        $this->rol = $rol;
    }
    function getRol(){
        return $this->rol;
    }

    function setImagen($imagen){
        $this->imagen = $imagen;
    }
    function getImagen(){
        return $this->imagen;
    }

    public function save(){
        $sql = "INSERT INTO usuarios VALUES (NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}','user',null);";
        $save = $this->db->query($sql);
        $result = false;
        if($save){
            return true;
        }
        return $result;
    }

    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;
        // comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            // verificar la contraseña
            $usuario = $login->fetch_object();
            $verify = password_verify($password, $usuario->password);
            if($verify){
                $result = $usuario;
            }
        }
        return $result;
    }
}