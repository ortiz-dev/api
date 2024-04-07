<?php 

class Punto{
    private $pdo;
    private $tabla;
    
    public function __construct($ruta='../db.ini'){
        $db = new Conexion($ruta);
        $this->pdo = $db->conectar();
        $this->tabla = 'puntos';
        $db = null;
    }

    public function listar(){
        $sql = "SELECT * FROM $this->tabla";
        $pre_pdo = $this->pdo->query($sql);
        $puntos = $pre_pdo->fetchAll(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 Lista de puntos obtenida");
        return $puntos;
    }
    
    public function obtener($id_punto){
        $sql = "SELECT * FROM $this->tabla WHERE id_punto = :id_punto";
        $pre_pdo = $this->pdo->prepare($sql);
        $pre_pdo->bindValue('id_punto',$id_punto);
        $pre_pdo->execute();
        $punto = $pre_pdo->fetch(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 Punto obtenido");
        return $punto;
    }
    
    public function insertar($datos){
        $sql = "INSERT INTO $this->tabla 
                VALUES(null, :id_punto, :nombre_punto, :departamento,
                  :ciudad, :direccion
                )";
    
        $pre_pdo = $this->pdo->prepare($sql);
        foreach($datos as $key => $dato){
            $pre_pdo->bindValue($key,$dato);
        }
            
        if($pre_pdo->execute()){
            header("HTTP/1.1 200 Punto creado correctamente");
        }
    }

}//fin clase Punto

?>