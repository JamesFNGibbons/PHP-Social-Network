  <script>
    app.controller("feed", function($scope, $http){
      console.log("--> Working.");
     $scope.value = 0;
     
     setInterval(function () {
      $http.get("index.php?_p=api&action=user_feed&_u=<?php print $vals['user']['ID']; ?>").then(function(data){
         $scope.feed = data.data;
      });
      console.log($scope.value);
      }, 100);
    });
  </script>
  <div class="container col-md-offset-1" ng-controller="feed">
    <div class="col-md-10">
        <div class="jumbotron" style='height: 180px;'>
          <div class='col-md-6'>
            <div class='col-md-5'>
              <img src='<?php print $vals['user']['Profile_Image']; ?>' width='100%' style='margin-top: 30px;'>
            </div>
            <div class='col-md-5'>
                <h2 style='margin-top: 85px;'><?php print $vals['user']['Name']; ?></h2>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
             <div class='jumbotron feed-post'>
               <form action='index.php?_p=addPost' method='post'>
                 <input type='hidden' name='type' value='text'>
                 <input type='hidden' name='to' value="<?php print $vals['user']['ID']; ?>">
                 <input type='hidden' name='return' value='index.php?_p=<?php print $vals["user"]["Email"]; ?>'>
                 <div class='row'>
                   <div class='col-md-8'>
                     <textarea name='text' class='form-control' placeholder='Post something to <?php print $vals["user"]["Name"]; ?> timeline'></textarea>
                   </div>
                   <div class='col-md-3'>
                     <input type='submit' value='Post' class='btn btn-primary form-control' height='100%' style='margin-top: -30px; height: 50px;'>
                   </div>
              </div>
            </form>
        </div>
              <div ng-repeat="item in feed" class='feed-post' style='height: auto;'>
                <div class='jumbotron'>
                  <h4 style='margin: 0; padding: 0; font-size: 15px;'>
                    <a>
                     {{item.Post_From}}
                    </a>
                    ->
                    <a>
                      {{item.post_To}}
                    </a>
                  </h4>
                  <h4>
                    {{item.Post_Text}}
                  </h4>
                </div>
              </div>
        </div>
        <div class="col-md-2 jumbotron" style="height: 400px; width: 260px;">
            <h3 class="text-center">
                Your Freinds 
            </h3>
            <?php if(freinds::userHasRequests()): ?>
                <?php foreach(freinds::getRequests() as $request): ?>
                    <div class='row' style='margin: auto; text-align: center;'>
                        <div class='col-md-9' style='float: left; text-align: left;'>
                            <p style='text-align: left;'><?php print user::getuser($request['User_A'])['Name'] ?></p>
                        </div>
                        <div class='col-md-3' style='float: right;'>
                            <form action="index.php?_p=confirmFreindship" method="post">
                                <input type="hidden" name="request" value="<?php print $request['ID']; ?>">
                                <input type='submit' class='btn btn-primary' value='Accept'>
                            </form>
                        </div>
                    </div>
                    <br>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if(freinds::userHasFreinds()): ?>
                <?php foreach(freinds::getFreinds() as $freind): ?>
                    <p>
                        <a href='index.php?_p=<?php print user::getUser($freind)["Email"]; ?>'>
                            <?php print user::getUser($freind)['Name']; ?>
                        </a>
                    </p>
                <?php endforeach; ?>
            <?php else: ?>
                <p style='font-size: 14px; text-align: center;'>You have no freinds</p>
                <br>
                <h2 style="text-align: center; margin: 0; padding: 0; font-size: 80px;">
                    <i class="fa fa-frown-o"></i>
                </h2>
            <?php endif; ?>
        </div>
    </div>
</div>
