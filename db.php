<?php
   include_once "session.php" ;
include "handel.errors.php" ;
class connect{
    private $host = "localhost";
    private $username = "root" ;
    private $password = "1234" ;
    private $db_name = "users" ;
    public $conn ;
    private static $instance = null ;

    private function __construct(){
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name",$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getConnection(){
      
        if(self::$instance === null){
            self::$instance = new connect() ;
        }
        return self::$instance->conn ;
    }
}