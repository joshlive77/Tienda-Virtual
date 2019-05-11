<?php

// use MisClases\Usuario;

require_once 'models/usuario.php';

class usuarioController{
    public function index(){
        echo "controlador usuarios, accion index";
    }
    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    public function save(){

        if(isset($_POST)){

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? trim($_POST['email']) : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            // $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
            // $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
            // // el trim es para guardar sin espacios
            // $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
            // $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

            // if($nombre && $apellidos && $email && $password){
            //     $usuario = new Usuario();
            //     $usuario->setNombre($nombre);
            //     $usuario->setApellidos($apellidos);
            //     $usuario->setEmail($email);
            //     $usuario->setPassword($password);

            //     $save = $usuario->save();
            //     // var_dump($usuario);
            //     if($save)
            //         // echo "registro completato";
            //         $_SESSION['register'] = "complete";
            //     else
            //         // echo "registro fallido";
            //         $_SESSION['register'] = "failed";
            // }
            // ARRAY DE ERRORES
            $errores = array();
                        
            // VALIDAMOS LOS DATOS ANTES DE GUARDARLOS EN LA BASE DE DATOS
            // !preg_match("/[0-9]/", $nombre) comprueba si no hay valores numericos en el nombre
            if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
                $nombre_validado = true;
            }
            else{
                $nombre_validado = false;
                $errores['nombre'] = "el nombre no es valido";
            }
            
            // validacion de apellidos
            if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
                $apellidos_validado = true;
            }
            else{
                $apellidos_validado = false;
                $errores['apellidos'] = "los apellidos no son validos";
            }
            
            // validacion de email
            if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
                $email_validado = true;
            }
            else{
                $email_validado = false;
                $errores['email'] = "el email no es valido";
            }
            
            // validacion de constraseña
            if(!empty($password)){
                $password_validado = true;
            }
            else{
                $password_validado = false;
                $errores['password'] = "la contraseña esta vacia";
            }
            
            if (count($errores) == 0) {

                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $save = $usuario->save();
                // var_dump($usuario);
                if($save)
                    // echo "registro completato";
                    $_SESSION['completado'] = "Registro completado!!!";
                else
                    // echo "registro fallido";
                    // $_SESSION['register'] = "failed";
                    $_SESSION['errores']['general'] = "fallo al guardar usuario";
            }
            else
                $_SESSION['errores'] = $errores;
        }
        else
            // echo "registro fallido";
            // $_SESSION['register'] = "failed";
            $_SESSION['errores']['general'] = "fallo al guardar usuario";
        header('Location:'.base_url.'usuario/registro');
    }

    public function login(){
        if(isset($_POST)){
            // identificar el usuario
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            // consulta a la base de datos
            $identity = $usuario->login();
            // crear una session 
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
                if($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
                else{
                    $_SESSION['error_login'] = 'idetificacion fallida !!!!';
                }
            }
        }
        header('Location:'.base_url);
    }

    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        header('Location:'.base_url);
    }
} //fin de la clase

