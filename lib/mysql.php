<?php
    class mysql{
        public function __construct(){
            try{
                $this->db = new PDO("mysql: host=".MYSQL_HOST."; dbname=". MYSQL_DBNAME, MYSQL_USER, MYSQL_PASS);
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }