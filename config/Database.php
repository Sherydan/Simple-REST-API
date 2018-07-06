<?php
    class Database {
        private $host = 'localhost';
        private $user = 'root';
        private $password = 'root';
        private $dbname = 'myblog';
        private $conn;

        private $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        public function connect(){
            $this->conn = null;
            
            try{
                $this->conn = new PDO('mysql:host='.$this->host.';'.'dbname='.$this->dbname, $this->user, $this->password, $this->options);
            } catch(PDOException $ex){
                echo 'Connection error: ' . $ex->getMessage();

            }

            return $this->conn;
        }
    }
?>