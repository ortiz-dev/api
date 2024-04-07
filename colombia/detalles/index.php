<?php
require_once '../../conexion/Conexion.php';
require_once 'Detalle.php';

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
    $id = trim($id);
    
    if($id && strtolower($id) == 'todos'){
        $detalle = new Detalle();
        echo json_encode($detalle->listar());
    }else{
        header("HTTP/1.1 404 No se obtienen datos");
    }
}


?>