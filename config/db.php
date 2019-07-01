<?php

class Database{
    public static function connect(){
        $db = new mysqli('localhost','root','','tienda_master');
        $db->query("SET NAMES 'utf8'");#para poner todos los resultados de la bd en español
        return $db;
    }
}