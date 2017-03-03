<?php
    class render {
        public static function redirect($location){
            if(isset($location)){
                if($location == "/"){
                    $location = "index.php";
                }
                
                header("Location: " . $location);
            }
        }
        
        public static function htmlRedirect($route){
            if(isset($route)){
                print("<script>window.location.assign('$route'); </script>");
            }
        }
        
        public static function renderPage($view, $vals){
            if(isset($view)){
                #render the navigation
                include("html/header.php");
                #render the body
                include("html/" . $view);
                #render the footer
                include("html/footer.php");
            }
        }
    }