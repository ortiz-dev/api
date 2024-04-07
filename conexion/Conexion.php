<?php 

class Conexion{
    private $host;
    private $user;
    private $pass;
    private $db_name;

    public function __construct($ruta='../db.ini'){
        $db = parse_ini_file($ruta);
        $this->host = $db['host'];
        $this->db_name = $db['db_name'];
        $this->user = $db['user'];
        $this->pass = $db['password'];
        
    }

    public function conectar(){
        try{
            $dns = "mysql:host=$this->host;dbname=$this->db_name;charset=utf8";
            return new PDO($dns, $this->user, $this->pass);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}


?>