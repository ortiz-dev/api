<?php 

class Encabezado{
    private $pdo;
    private $tabla;
    
    public function __construct($ruta='../db.ini'){
        $db = new Conexion($ruta);
        $this->pdo = $db->conectar();
        $this->tabla = 'encabezados';
        $db = null;
    }

    public function listar(){
        $sql = "SELECT * FROM $this->tabla";
        $pre_pdo = $this->pdo->query($sql);
        $encabezados = $pre_pdo->fetchAll(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 Lista de encabezados obtenida");
        return $encabezados;
    }
    
    private function obtener($id_punto, $cod_donacion){
        $sql = "SELECT * FROM $this->tabla WHERE id_punto = :id_punto and codigo_donacion = :codigo_donacion";
        $pre_pdo = $this->pdo->prepare($sql);
        $pre_pdo->bindParam('id_punto',$id_punto);
        $pre_pdo->bindParam('codigo_donacion',$cod_donacion);
        $pre_pdo->execute();
        $encabezado = $pre_pdo->fetch(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 Encabezado obtenido");
        return $encabezado;
    }
    
    public function insertar($datos){
        
        $encabezado = $this->obtener($datos['id_punto'], $datos['codigo_donacion']);
        
        if(!$encabezado){
            $sql = "INSERT INTO  $this->tabla
                    VALUES(null, :codigo_donacion, now(), :kg_total, :costo_total,
                    :nombre_punto, :id_punto, :departamento, :ciudad, :direccion)";
        
            $pre_pdo = $this->pdo->prepare($sql);
            $pre_pdo->bindParam('codigo_donacion', $datos['codigo_donacion']); 
            $pre_pdo->bindParam('kg_total', $datos['kg_total']); 
            $pre_pdo->bindParam('costo_total', $datos['costo_total']);
            $pre_pdo->bindParam('nombre_punto', $datos['nombre_punto']); 
            $pre_pdo->bindParam('id_punto', $datos['id_punto']); 
            $pre_pdo->bindParam('departamento', $datos['departamento']); 
            $pre_pdo->bindParam('ciudad', $datos['ciudad']); 
            $pre_pdo->bindParam('direccion', $datos['direccion']);            
            
            
            $pre_pdo->execute();

        }else{
            $sql = "UPDATE  $this->tabla
                   SET kg_total = (kg_total + :kg_total), costo_total = (costo_total + :costo_total) WHERE id_punto = :id_punto and codigo_donacion = :codigo_donacion";
        
            $pre_pdo = $this->pdo->prepare($sql);
            $pre_pdo->bindParam('kg_total', $datos['kg_total']);
            $pre_pdo->bindParam('costo_total', $datos['costo_total']); 
            $pre_pdo->bindParam('id_punto', $datos['id_punto']);
            $pre_pdo->bindParam('codigo_donacion', $datos['codigo_donacion']);            
            $pre_pdo->execute();
        }
    
    }
    
}//fin clase Encabezado

?>