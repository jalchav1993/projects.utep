<?php
session_start();
if(empty ($_SESSION['state'])) {
    $_SESSION['state'] = 'init';
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CS VOLUNTEERING</title>
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
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- base for apps -->
	<base href="/">
	<!-- IExplorer support -->
	<!--[if lt IE 9]>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
	  <![endif]-->
</head>
<body class = 'ng-scope' ng-app = "EventDesk">
	<div ng-controller = "NavCtrl">
	  <section layout="row" flex>
	    <md-sidenav class="md-sidenav-left" md-component-id="left" md-whiteframe="4">
	      <md-toolbar>
	        <h1 class="md-toolbar-tools UTEP-theme-color-blue">CS Volunteerring</h1>
					<img src="team12/images/utep.png">
	      </md-toolbar>
				<div style = "margin-bottom:0px">
					<uib-accordion>
					    <div uib-accordion-group heading="{{header.msg}}" >
									<div ng-repeat = "accordionItem in header.accordionItems">
										<a ng-href ="./#/{{accordionItem.route}}" ng-click ="getAction(accordionItem.action)">
											{{accordionItem.template}} 
										</a>
									</div>
							</div>
						</uib-accordion>
					</div>
	      	<md-content>
		      	<md-list flex>
		        	<md-list-item class="md-1-line" ng-href = "./#/{{item.route}}" ng-repeat = "item in menuItems" ng-click = "getAction(item.action)">
		         	 <div class="md-list-item-text" layout="column">
		           	<h6>{{item.template}}</h6>
		          	</div>
		        </md-list-item>
		      </md-list>
	      </md-content>
	    </md-sidenav>
	    <md-content flex>
		 	<span style="display:inline-block;">
		 			<a href="http://utep.edu/"> <img src="team12/images/banner.png" height = "55"></a> 
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
				<div ng-controller="ModalDemoCtrl as $ctrl" class="modal-demo">
					<div class="modal-parent"></div>
				</div>
				<div ng-controller="AddUserModalCtrl as $ctrl" class="modal-user">
					<div class="modal-parent"></div>
				</div>
				<div ng-controller="AddEventModalCtrl as $ctrl" class="modal-event ">
					<div class="modal-parent"></div>
				</div>
	    </md-content>
	  </section>
	</div>
	<div class = "container" ng-controller = "eventsController" >
		<div class = "ng-view"></div>
	</div>
	<script type="text/ng-template" id="group-template.html">
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title" style="color:#fa39c3">
	        <a href tabindex="0" class="accordion-toggle" ng-click="toggleOpen()" uib-accordion-transclude="heading">
	          <span uib-accordion-header ng-class="{'text-muted': isDisabled}">
	            {{heading.msg}}
	          </span>
	        </a>
	      </h4>
	    </div>
	    <div class="panel-collapse collapse" uib-collapse="!isOpen">
	      <div class="panel-body" style="text-align: right" ng-transclude></div>
	    </div>
	  </div>
	</script>
	<!--jQuery before materialize.js-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	 <!-- Latest compiled and minified JavaScript -->
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <!-- Angular.js Libraries -->
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.min.js"></script>
  <!-- Angular Material Library -->
  <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
  <!-- Your application bootstrap  -->
	<script src="team12/js/ui-bootstrap-tpls-2.1.4.min.js"></script>
	<script src="team12/js/EventDesk.js" ></script>
</body>
</html>



