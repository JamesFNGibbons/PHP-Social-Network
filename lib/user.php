<?php
    class user{
        public static function isFreindsWith($user_id){
            foreach(freinds::getFreinds() as $freind){
                if($freind == $user_id){
                    $found = true;
                }
            }
            
            if($found){
                return true;
            }
            else{
                return false;
            }
        }
        
        public static function getUsers(){
            if(!isset($mysql)){
                $mysql = new mysql();
            }
            
            $query = $mysql->db->prepare("SELECT * FROM Users");
            
            try{
                $query->execute();
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
            
            return $query->fetchAll();
        }
        
        public static function addUser($email, $name, $password){
            if(isset($email) && isset($name) && isset($password)){
                if(!isset($mysq)){
                    $mysql = new mysql();
                }
                try{
                    $mysql->db->exec("INSERT INTO Users (Name, Email, Password) 
                                    VALUES ('$name', '$email', '$password')");
                }
                catch(PDOExecption $e){
                    die($e->getMessage());
                }
            }
        }
        
        public static function emailUsed($email){
            if(isset($email)){
                if(!isset($mysql)){
                    $mysql = new mysql();
                }
                
                $query = $mysql->db->prepare("SELECT * FROM Users WHERE Email = '$email'");
                
                try{
                    $query->execute();
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
                
                if($query->rowCount() > 0){
                    return true;
                }
                else{
                    return false;
                }
            }
        }
                
        public static function getId($email){
            if(isset($email)){
                if(!isset($mysql)){
                    $mysql = new mysql();
                }
                
                $query = $mysql->db->prepare("SELECT * FROM Users WHERE Email = '$email'");
                
                try{
                    $query->execute();
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
                
                return $query->fetchAll()[0]['ID'];
            }
        }
        
        public static function getUser($id){
            if(isset($id)){
                if(!isset($mysql)){
                    $mysql = new mysql();
                }
                
                $query = $mysql->db->prepare("SELECT * FROM Users WHERE ID = $id");
                
                try{
                    $query->execute();
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
                
                return $query->fetchAll()[0];
            }
        }
        
        public static function isLoggedIn(){
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
                return true;
            }
            else{
                return false;
            }
        }
        
        public static function logoutUser(){
            session_unset();
            session_destroy();
        }
        
        public static function checkLogin($email, $password){
            if(isset($email) && isset($password)){
                if(!isset($mysql)){
                    $mysql = new mysql();
                }
                
                $query = $mysql->db->prepare("SELECT * FROM Users WHERE Email = '$email'");
                
                try{
                    $query->execute(); 
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
                
                #check if a user was found;
                if($query->rowCount() > 0){
                    if($query->fetchAll()[0]['Password'] == $password){
                        $_SESSION['loggedin'] = true;
                        $_SESSION['user'] = self::getUser(self::getId($email));
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    return false;
                }
            }
        }
    }