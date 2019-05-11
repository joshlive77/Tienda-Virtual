<?php

// cargamos el modelo
require_once 'models/producto.php';

class productoController{
    public function index(){
        // echo "controlador producto, accion index";
        //renderizar las vistas
        $producto = new Producto;   
        $productos = $producto->getRandom(9);
        require_once 'views/producto/destacados.php';
    }

    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $producto = new Producto();
            $producto->setId($id);

            $product = $producto->getOne();

        }
        require_once 'views/producto/ver.php';
    }

    public function gestion(){
        Utils::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAll();
        require_once 'views/producto/gestion.php';
    }

    public function crear(){
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function save(){
        Utils::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;

            if($nombre && $descripcion && $descripcion && $precio && $stock && $categoria){
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                // guardar imagen
                if(isset($_FILES['imagen'])){
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];
    
                    // var_dump($file);
                    // die();
                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                        if(!is_dir('uploads/images')){
                            // para crear un directorio dentro de otro hay que poner true al final
                            mkdir('uploads/images', 0777, true);
                        }
                        $producto->setImagen($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                    }
                }

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                }
                else{
                    $save = $producto->save();
                }

                if($save){
                    $_SESSION['producto'] = "complete";
                }
                else{
                    $_SESSION['producto'] = "failed";
                }
            }
            else{
                $_SESSION['producto'] = "failed";
            }
        }
        else{
            $_SESSION['producto'] = "failed";
        }
        header('Location:'.base_url.'producto/gestion');
    }

    public function editar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();
            require_once 'views/producto/crear.php';
        }
        else{
            header('Location:'.base_url.'producto/gestion');
        }
    }

    public function eliminar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $filename = $producto->getLink();
            // echo $filename;
            // var_dump($filename);
            // die();
            $delete = $producto->delete();
            unlink('uploads/images/'.$filename);
            if($delete){
                $_SESSION['delete'] = "complete";
            }
            else{
                $_SESSION['delete'] = "failed";
            }
        }
        else{
            $_SESSION['delete'] = "failed";
        }
        header('Location:'.base_url.'producto/gestion');
    }
}