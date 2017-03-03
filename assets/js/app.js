var app = angular.module("app", []);


  app.controller("feed", function($scope, $http){
    console.log("--> Working.");
   
   $scope.value = 0;
   
   setInterval(function () {
    $http.get("index.php?_p=api&action=user_feed&_u=5").then(function(data){
       $scope.feed = data.data;
    });
    console.log($scope.value);
    }, 1000);
  });
