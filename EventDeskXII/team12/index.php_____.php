<?php
session_start();
if(empty ($_SESSION['state'])) {
    $_SESSION['state'] = 'init';
}
?>
<html lang="en" >
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- BootStrapCSS -->
	<link rel="stylesheet" href="./css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<!-- Utep Official Colors -->
	<link rel="stylesheet" href="./css/UTEP-theme.css">
  <!-- Angular Material style sheet -->
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
	<!--Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified CSS for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
	<!-- Utep official colrs -->
	<link rel="text/cs" href="./css/demo.css">
	<!-- base for apps -->
	<base href="/">
</head>
<body ng-app = "EventDesk">
	<div ng-controller = "NavCtrl">
	  <section layout="row" flex>
	    <md-sidenav class="md-sidenav-left" md-component-id="left" md-whiteframe="4">
	      <md-toolbar>
	        <h1 class="md-toolbar-tools UTEP-theme-color-blue">CS Volunteerring</h1>
					<img src="./images/utep.png">
	      </md-toolbar>
	      <md-content>
		      <md-list flex>
		       	<md-subheader class="md-no-sticky">{{header.msg}}</md-subheader>
		        <md-list-item class="md-1-line" href = "{{item.route}}" ng-repeat = "item in menuItems" ng-click = "getAction(item.action)">
		          <div class="md-list-item-text" layout="column">
		            <h6>{{item.template}}</h6>
		          </div>
		        </md-list-item>
		      </md-list>
	      </md-content>
	    </md-sidenav>
	    <md-content flex>
		 	<span style="display:inline-block;">
		 			<a href="http://utep.edu/"> <img src="./images/banner.png" height = "55"></a> 
			</span>
	      <div layout="column" layout-align="top center">
		 		<md-toolbar>
		 			<div class="md-toolbar-tools UTEP-theme-color-blue">
		 	      <md-button class="md-icon-button" ng-click="getAndToggleMenu()">
		 		      <i class=" material-icons"><span class = "white-text">reorder</span></i>
		 	      </md-button>
		 	      <span flex></span>
		 	    </div>
		 	  </md-toolbar>
	      </div>
	    </md-content>
	  </section>
	</div>
	<div class = "container" ng-controller = "RouteCtrl">
		<div class = "ng-view"></div>
	</div>
	
	<!--jQuery before materialize.js-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<!-- Compiled and minified JavaScript -->
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <!-- Angular.js Libraries -->
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.min.js"></script>
  <!-- Angular Material Library -->
  <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
  <!-- Your application bootstrap  -->
	<script src="js/EventDesk.js" ></script>
</body>
</html>