<?php
  class freinds {
    public static function confirmFreindship($request){
      if(isset($request)){
        if(!isset($mysql)){
          $mysql = new mysql();
        }
        
        $request = self::getRequest($request);
        
        $user_a = $request['User_A'];
        $user_b = $request['User_B'];
        
        try{
          $mysql->db->exec("DELETE FROM Freind_Requests WHERE ID = " . $request['ID']);
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        
        try{
          $mysql->db->exec("INSERT INTO Freindships (User_A, User_B) VALUES ('$user_a', '$user_b')");
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
      }
    }
    
    public static function getRequest($request){
      if(isset($request)){
        if(!isset($mysql)){
          $mysql = new mysql();
        }
        
        $query = $mysql->db->prepare("SELECT * FROM Freind_Requests WHERE ID = $request");
        
        try{
          $query->execute();
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        
        return $query->fetchAll()[0];
      }
    }
    
    public static function userHasRequests(){
      if(user::isLoggedIn()){
        if(count(self::getrequests()) > 0){
          return true;
        } 
        else{
          return false;
        }
      }
    }
    
    public static function getrequests(){
      if(user::isLoggedIn()){
        $requests = array();
        
        $user = $_SESSION['user']['ID'];
        
        if(!isset($mysql)){
          $mysql = new mysql();
        }
        
        $query = $mysql->db->prepare("SELECT * FROM Freind_Requests WHERE User_A = $user");
        
        try{
          $query->execute();
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        
        foreach($query->fetchAll() as $freindship){
          array_push($requests, $freindship);
        }
        
        #do again but for freind b this time.
          
        $query = $mysql->db->prepare("SELECT * FROM Freind_Requests WHERE User_B = $user");
        
        try{
          $query->execute();
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        
        foreach($query->fetchAll() as $freindship){
          array_push($requests, $freindship);
        }
        
        return $requests;
      }
    }
    
    public static function userHasFreinds(){
      if(user::isLoggedIn()){
        if(count(self::getFreinds()) > 0){
          return true;
        }
        else{
          return false;
        }
      }
    }
    
    public static function getFreinds(){
      if(user::isLoggedIn()){
        $freinds = array();
        
        $user = $_SESSION['user']['ID'];
        
        if(!isset($mysql)){
          $mysql = new mysql();
        }
        
        $query = $mysql->db->prepare("SELECT * FROM Freindships WHERE User_A = $user");
        
        try{
          $query->execute();
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        
        foreach($query->fetchAll() as $freindship){
          array_push($freinds, $freindship['User_B']);
        }
        
        #do again but for freind b this time.
          
        $query = $mysql->db->prepare("SELECT * FROM Freindships WHERE User_B = $user");
        
        try{
          $query->execute();
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        
        foreach($query->fetchAll() as $freindship){
          array_push($freinds, $freindship['User_A']);
        }
        
        return $freinds;
      }
    }
  }