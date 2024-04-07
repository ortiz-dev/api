<?php 
require_once '../../conexion/Conexion.php';
require_once 'Encabezado.php';

//Obtener datos
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']== 'GET'){
    $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
    $id = trim($id);
    if($id && strtolower($id) == 'todos'){
        $encabezado = new Encabezado();
        echo json_encode($encabezado->listar());
    }else{
        header("HTTP/1.1 404 No se obtienen datos");
    }
}


?>