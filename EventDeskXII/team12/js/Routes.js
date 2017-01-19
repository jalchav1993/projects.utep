(function(){
	//hoisted
	var app = angular.module('EventRoutes', ['ngRoute']);
	app.config(function($routeProvider, $locationProvider){
		$routeProvider.when('/', {
     templateUrl: '/team12/templates/events/',
     
     }).when('/eventsRt', {
     templateUrl: '/team12/templates/events/',
     controller: 'eventsController',
     }).when('/aboutRt', {
     templateUrl: '/team12/templates/article/about/',
     controller: 'aboutController'
   }).when('/contactRt', {
     templateUrl: '/team12/templates/article/contact/',
     controller: 'contactController'
   }).when('/myeventsRt', {
     templateUrl: '/team12/templates/article/myevents/',
     controller: 'myeventsController'
   }).when('/myprofileRt', {
     templateUrl: '/team12/templates/article/myprofile/',
     controller: 'myprofileController'
   }).when('/vmRt', {
     templateUrl: '/team12/templates/vm/',
     controller: 'vmController'
   }).when('/reportsRt', {
     templateUrl: '/team12/templates/reports/',
     controller: 'reportsController'
   });
   // configure html5 to get links working on jsfiddle
   $locationProvider.html5Mode(true);
	});
	function eventsController(){
		
	};
	function aboutController(){
		
	};
	function contactController(){
		
	};
	function myeventsController(){
		
	};
	function myprofileController(){
		
	};
	function vmController(){
		
	};
	app.controller('eventsController', eventsController);
	app.controller('aboutController', aboutController);
	app.controller('contactController', contactController);
	app.controller('myeventsController', myeventsController);
	app.controller('myprofileController', myprofileController);
	app.controller('contactController', contactController);
	app.controller('vmController', vmController);
	})(angular);