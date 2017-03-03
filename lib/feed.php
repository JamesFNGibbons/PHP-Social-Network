<?php 
  class textPost {
    public function __construct($text, $to, $from){
      $this->text = $text;
      $this->to = $to;
      $this->from = $from;
    }
    
    public function getType(){
      return "text";
    }
    
    public function getTo(){
      return $this->to;
    }
    
    public function getFrom(){
      return $this->from;
    }
    
    public function getText(){
      return $this->text;
    }
    
    public function getImage(){
      return null;
    }
    
  }

  class feed {
    public static function getUserFeed($user_id){
      if(isset($user_id)){
        if(!isset($mysql)){
          $mysql = new mysql();
        }
        
        $query = $mysql->db->prepare("SELECT * FROM Posts WHERE Post_To = $user_id ORDER BY ID DESC");
        
        try{
          $query->execute();
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
        
        return $query->fetchAll();
      }
    }
    
    public static function newPost($type, $image, $text, $from , $to){
      if(isset($type) && isset($from) && isset($to)){
        if(!isset($mysql)){
          $mysql = new mysql();
        }
        
        if($type == "text"){
          $post = new textPost($text, $to, $from);
        }
        
        try{
          $mysql->db->exec("INSERT INTO Posts (Post_Type, Post_Text, Post_Image, Post_From, Post_To) VALUES (
            '".$post->getType()."', '".$post->getText()."', '".$post->getImage()."', '".$post->getFrom()."', '".$post->getTo()."')");
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
      }
    }
    
    public static function getFeed(){
      print("
        <div class='jumbotron feed-post'>
          <form action='index.php?_p=addPost' method='post'>
            <input type='hidden' name='type' value='text'>
            <input type='hidden' name='to' value='self'>
            <div class='row'>
              <div class='col-md-8'>
                <textarea name='text' class='form-control' placeholder='Whats on your mind?'></textarea>
              </div>
              <div class='col-md-3'>
                <input type='submit' value='Post' class='btn btn-primary form-control' height='100%' style='margin-top: -30px; height: 50px;'>
              </div>
            </div>
          </form>
        </div>
      ");
      
      if(!isset($mysql)){
        $mysql = new mysql();
      }
      
      $user = $_SESSION['user']['ID'];
      
      $query = $mysql->db->prepare("SELECT * FROM Posts WHERE Post_To = $user ORDER BY ID DESC");
      
      try{
        $query->execute();
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
      
      foreach($query->fetchAll() as $post){
        print("
          <div class='feed-post' style='height: auto;'>
            <div class='jumbotron'>
              <h4 style='margin: 0; padding: 0; font-size: 15px;'>
                <a>
                  ".user::getUser($post['Post_From'])['Name']."
                </a>
                ->
                <a>
                  ".user::getUser($post['Post_To'])['Name']."
                </a>
              </h4>
              <h4>
                ".$post['Post_Text']."
              </h4>
            </div>
          </div>
        ");
      }
    }
  }