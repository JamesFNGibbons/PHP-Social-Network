<?php
    require_once("lib/config.php");
    require_once("lib/mysql.php");
    require_once("lib/user.php");
    require_once("lib/feed.php");
    require_once("lib/freinds.php");
    require_once("lib/render.php");
    require_once("lib/router.php");
    
    session_start(); 
    
    #check the mysql connection.
    $mysql = new mysql();
    
    try{
        $mysql->db->exec(file_get_contents("lib/sql/init.sql"));
    }
    catch(PDOException $e){
        die($e->getMessage());
    }
    
    #check if a route has come from the .htaccess
    if(!isset($_GET['_p'])){
        $route = "/";
    }
    else{
        $route = $_GET['_p'];
    }
    
    router::handleRoute($route);