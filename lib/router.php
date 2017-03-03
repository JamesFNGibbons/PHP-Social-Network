<?php
    class router {
        #handle the route of the user.
        public static function handleRoute($route){
            if(isset($route)){
                
                foreach(user::getUsers() as $user){
                    if($route == $user['Email']){
                        if(user::isLoggedIn()){
                            if(user::isFreindsWith($user['ID'])){
                                render::renderpage("profile.php", array(
                                    "user" => $user
                                ));
                            }
                            else{
                                 render::renderpage("profile.php", array(
                                        "error" => true
                                ));
                            }
                        }
                        else{
                            render::redirect("index.php");
                        }
                         $userProfileRequest = true;
                    }
                }
                
                if(!$userProfileRequest){
                
                    switch($route){
                        case("test"):
                            render::renderPage("test.php", null);
                        break;
                        
                        case("api"):
                            if(isset($_GET['action'])){
                                switch($_GET['action']){
                                    
                                    case("user_feed"):
                                        if(user::isLoggedIn()){
                                            $to_get = $_GET['_u'];
                                            
                                            if(user::isFreindsWith($to_get)){
                                                $feed = feed::getUserFeed($to_get);
                                                print(json_encode($feed));
                                            }
                                            else{
                                                
                                                if($_GET['_u'] == $_SESSION['user']['ID']){
                                                    $feed = feed::getUserFeed($to_get);
                                                    print(json_encode($feed));
                                                }
                                                else{
                                
                                                    print("User is not freinds with this person.");
                                                }
                                            }
                                        }
                                        else{
                                            print("user is not loggedin.");
                                        }
                                    break;
                                    
                                    default:
                                        print("Invalid.");
                                }
                            }    
                        break;
                        
                        case("confirmFreindship"):
                            if(user::isLoggedIn() && isset($_POST['request'])){
                                $request = $_POST['request'];
                                freinds::confirmFreindship($request);
                                render::redirect("index.php");
                            }    
                        break;
                        
                        case("addPost"):
                            if(user::isLoggedIn() && isset($_POST['to']) && isset($_POST['text'])){
                                $from = $_SESSION['user']['ID'];
                                $to = $_POST['to'];
                                $text = $_POST['text'];
                                $type = $_POST['type'];
                                
                                if(isset($_POST['return'])){
                                    $return = $_POST['return'];
                                }
                                
                                if($to == "self"){
                                    $to = $from;
                                }
                                
                                feed::newPost($type, null, $text, $from , $to);
                                
                                if(!isset($return)){
                                    render::redirect("index.php");
                                }
                                else{
                                    render::redirect($return);
                                }
                            }    
                        break;
                        
                        case("register"):
                            if(isset($_POST['name'])){
                                try{
                                    $name = $_POST['name'];
                                    $email = $_POST['email'];
                                    $password = $_POST['password'];
                                }
                                catch(PDOException $e){
                                    die($e->getMessage());
                                }
                                
                                if(user::emailUsed($email)){
                                    render::renderPage("register.php", array(
                                        "EmailUsedError" => true
                                    ));
                                }
                                else{
                                    user::addUser($email, $name, $password);
                                    $_SESSION['loggedin'] = true;
                                    $_SESSION['user'] = user::getUser(user::getId($email));
                                    render::redirect("index.php");
                                }
                            }
                            else{
                                if(user::isLoggedIn()){
                                render::redirect("/");
                            }
                                else{
                                    render::renderPage("register.php", null);
                                }   
                            }
                        break;
                        
                        case("logout"):
                            user::logoutUser();
                            header("Location: index.php");
                        break;
                        
                        case("login"):
                            if(isset($_POST['email']) && isset($_POST['password'])){
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                
                                if(user::checkLogin($email, $password)){
                                    render::redirect("/");
                                }
                                else{
                                    render::renderPage("login.php", array("loginError" => true));
                                }
                            }    
                        break;
                            
                        case("/"):
                            if(!user::isLoggedIn()){
                                render::renderPage("home.php", null);
                            }
                            else{
                                render::renderPage("dash.php", array(
                                    "user" => $_SESSION['user']
                                ));
                            }
                        break;
                            
                        default:
                            render::renderPage("404.php", null);
                    }
                }
            }
        }
    }