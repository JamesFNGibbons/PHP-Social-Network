<html ng-app="app">
    <head>
        <base href="<?php print URL_BASE; ?>">
        
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/styles.php">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
        <script src="assets/js/app.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <a href="#" class="navbar-brand">
                   Student Share Space
                </a>
                <ul class="nav navbar-nav" style="float: right;">
                    <li>
                        <a>
                            <i class="fa fa-globe"></i>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?_p=logout" class="no-effect">
                            <i class="fa fa-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?_p=logout" class="no-effect">
                            <i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>