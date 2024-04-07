<?php 
require_once '../../conexion/Conexion.php';
require_once 'Punto.php';
require_once '../../colombia/detalles/Detalle.php';
require_once '../../colombia/encabezados/Encabezado.php';

//Obtener datos
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']== 'GET'){
    $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
    $id = trim($id);
    if($id && strtolower($id) == 'todos'){
        $punto = new Punto();
        echo json_encode($punto->listar());
    }else{
        header("HTTP/1.1 404 No se obtienen datos");
    }
}

//Insertar datos
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $datos = filter_var(file_get_contents('php://input'),FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_FLAG_NO_ENCODE_QUOTES);
    
    $datos = json_decode($datos);
    $punto = new Punto();
    $detalle = new Detalle('../../colombia/db.ini');
    $encabezado = new Encabezado('../../colombia/db.ini');
    $dono = false;
    foreach($datos as $dato){
        $dato = (array) $dato;
        $datos_punto = $punto->obtener($dato['id_punto']);
        if($datos_punto){
            $dono = true;
            $datos_detalle = [
                'codigo_donacion' => $dato['codigo_donacion'], 
                'id_punto' => $dato['id_punto'], 
                'nombre_producto' => $dato['nombre_producto'], 
                'codigo_producto' => $dato['codigo_producto'],
                'cantidad' => $dato['cantidad'], 
                'kg_unitario' => $dato['kg_unitario'], 
                'costo_unitario' => $dato['costo_unitario']
            ];
            
            $detalle->insertar($datos_detalle);
                    
            $datos_encabezado = [
                'codigo_donacion' => $dato['codigo_donacion'], 
                'kg_total' => ($dato['cantidad'] * $dato['kg_unitario']), 
                'costo_total' => ($dato['cantidad'] * $dato['costo_unitario']),
                'nombre_punto' => $datos_punto['nombre_punto'], 
                'id_punto' => $dato['id_punto'], 
                'departamento' => $datos_punto['departamento'], 
                'ciudad' => $datos_punto['ciudad'], 
                'direccion' => $datos_punto['direccion']
            ];
            
            $encabezado->insertar($datos_encabezado);
        }
        
    }
    if($dono){
        header("HTTP/1.1 200 Donacion realizada con exito");
    }else{
        header("HTTP/1.1 404 El punto de donacion no existe");
    }
    
}

?>