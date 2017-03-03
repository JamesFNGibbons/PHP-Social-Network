
<html ng-app="app">
  <div ng-controller="feed">
    <h1>Test = {{test}}</h1>
    <h2 ng-repeat="item in feed">
      {{item.Post_Text}}
    </h2>
  </div>
</html>