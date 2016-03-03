<?php 

class Koneksi extends PDO {
    private $dbname     = "siak_290515";
    private $host       = "localhost";
    private $user       = "postgres";
    private $password   = "mie";
    private $port       = 5432;
    
    
    public function __construct() {
        try {
            parent::__construct("pgsql:hostsss=$this->host;port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->password");
        } catch(PDOException $e) {
            echo $e->getMessage();  
        }
    
    }
}

$db = new Koneksi();
