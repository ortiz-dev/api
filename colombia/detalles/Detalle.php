<?php 

class Detalle{

    private $pdo;
    private $tabla;
    
    public function __construct($ruta='../db.ini'){
        $db = new Conexion($ruta);
        $this->pdo = $db->conectar();
        $this->tabla = 'detalles';
        $db = null;
    }

    public function listar(){
        $sql = "SELECT * FROM $this->tabla";
        $pre_pdo = $this->pdo->query($sql);
        $detalles = $pre_pdo->fetchAll(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 Lista de detalles obtenida");
        return $detalles;
    }

    public function obtener($id){
        $sql = "SELECT * FROM $this->tabla WHERE id = :id";
        $pre_pdo = $this->pdo->prepare($sql);
        $pre_pdo->bindParam('id', $id);
        $pre_pdo->execute();
        $detalle = $pre_pdo->fetch(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 Detalle obtenido");
        return $detalle;
    }

    public function insertar($datos){
        
        $sql = "INSERT INTO $this->tabla 
                VALUES(null, :codigo_donacion, :id_punto, :nombre_producto, :codigo_producto,
                  :cantidad, :kg_unitario, :costo_unitario, now()
                )";
    
        $pre_pdo = $this->pdo->prepare($sql);
        foreach($datos as $key => $dato){
            $pre_pdo->bindValue($key,$dato);
        }
            
        if($pre_pdo->execute()){
            header("HTTP/1.1 200 Detalle creado correctamente");
        }
    }

}//fin clase Detalle

?>