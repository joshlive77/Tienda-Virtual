<?php

class Utils{
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function isAdmin(){
        if (!isset($_SESSION['admin'])) {    
            header("Location:".base_url);
        }
        else{
            return true;
        }
    }

    public static function isIdentity(){
        if (!isset($_SESSION['identity'])) {
            header('Location:'.base_url);
        }
        else{
            return true;
        }
    }

    public static function showCategorias(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    public static function statsCarrito(){
        $stast = array(
            'count' => 0,
            'total' => 0
        );
        if(isset($_SESSION['carrito'])){
            $stast['count'] = count($_SESSION['carrito']);
            foreach ($_SESSION['carrito'] as $producto) {
                $stast['total'] += $producto['precio']*$producto['unidades'];
            }
        }

        return $stast;
    }

    public static function showStatus($status){
        $value ='pendiente';
        if($status == 'confirm'){
            $value = 'pendiente';
        }
        elseif($status == 'preparation'){
            $value = 'preparado para enviar';
        }
        elseif($status == 'ready'){
            $value = 'preparado';
        }
        elseif($status == 'sended'){
            $value = 'enviado';
        }
        return $value;
    }
}

function mostrarError($errores, $campo){
    $alerta = '';
    if(isset($errores[$campo]) && !empty($campo)){
        $alerta = "<div class='alert_red'>".$errores[$campo].'</div>';
    }
    return $alerta;
}
