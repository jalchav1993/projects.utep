/*
/* Author: Jesus Chavez
 * POST/GET do not actually reload page, angularjs by google(c) 
 * From mean Plataform, Angular Javascript framework delivers them!!!important!!!
 * POST/GET uses AJAX
 * POST/GET Requests in funtion global(..){..}
 * global handles api requests to /team12/api
 * the aplication programing interface was written in PHP, 
 * reference /team12/api for any POST/GET Request information,
 * and data base manipulation
 */
(function() {
	//hoisted
	var app = angular.module('EventDesk', ['ngMaterial', 'ngRoute', 'ui.bootstrap','ngMessages']);
	'use strict';
	/*
	/* Author: Jesus Chavez
	 * Menu item object node
	 */
	var MenuItem = function() {
		this.template = '';
		this.action = '';
		this.route = '';
	};
	var HeaderItem = function() {
		this.msg = '';
		this.accordionItems = [];
	};
	var Resonse = function() {
		this.response = '';
	};
	var UserItem = function(){
	 	this.userType= '';
	 	this.userName='';
	 	this.firstName='';
		this.middleInit='';
	  this.lastName='';
		this.userPass='';
		this.telephone='';
		this.eventPreference='';
		this.userClass='';
	}
	var EventItem = function(){
	 	this.eventId= '';
	 	this.eventName='';
	 	this.eventDescription='';
		this.eventLocation='';
	  this.eventVolunteers='';
	  this.approved_by='';
		this.created_by='';
		this.updated_by='';
	}
	var Report= function(){
		this.Eid = '';
		this.Hours = '';
	}
	/* Author: Jesus Chavez
	 * Global factory, handles http requests to rest
	 */
	function global($rootScope, $http) {
		var obj = {};
		obj.menuItemList = [];
		obj.userItemList = [];
		obj.eventItemList = [];
		obj.requestItemList = [];
		obj.state = [];
		obj.header = [];
		obj.report = [];
		obj.loginResponse = "";
		obj.panelRef = "";
		obj.signUp = function(eventId){
			$http({
				url: "http://" + location.host + "/team12/api/sql/insert/volunteer/",
				method: "POST",
				data: {
					request:'insertVolunteerById',
					Eid:eventId
				}
			}).success(function(data, status, headers, config) {
				console.log('got populate response '+data)
				if(data === ' delete-user-success '){
					$rootScope.$broadcast('delete-user-request-accepted');
				}else if(data === 'insert-server-error'){
					$rootScope.$broadcast('delete-user-request-denied');
				}
			}).error(function(data, status, headers, config) {
				console.log('Error this');
				console.log(response);
			});
		}
		obj.getAndToggleMenu = function() {
			obj.menuItemList = [];
			obj.header = [];
			$http({
				url: "http://" + location.host + "/team12/api/menu/",
				method: "GET"
			}).success(function(data, status, headers, config) {
				tmp = new HeaderItem();
				angular.copy(data[0], tmp);
				obj.header = tmp;
				for (i = 1; i < data.length; i++) {
					tmp = new MenuItem();
					angular.copy(data[i], tmp);
					obj.menuItemList.push(tmp);
				}
				$rootScope.$broadcast("populate");
			}).error(function(data, status, headers, config) {
				console.log('Error');
				console.log(response);
			});
		};
		obj.routeTimeOut = function(){
			obj.userItemList = [];
			$http({
				url: "http://" + location.host + "/team12/api/components/users/",
				method: "GET"
			}).success(function(data, status, headers, config) {
				for (i = 0; i < data.length; i++) {
					tmp = new UserItem();
					angular.copy(data[i], tmp);
					obj.userItemList.push(tmp);
					console.log(tmp);
				}
				$rootScope.$broadcast("buildUser");
			}).error(function(data, status, headers, config) {
				console.log('Error');
				console.log(response);
			});
		}
		obj.getRequests = function(){
			obj.requestItemList = [];
			$http({
				url: "http://" + location.host + "/team12/api/components/events/?request=requests",
				method: "GET"
			}).success(function(data, status, headers, config) {
				for (i = 0; i < data.length; i++) {
					tmp = new EventItem();
					angular.copy(data[i], tmp);
					obj.requestItemList.push(tmp);
				}
				$rootScope.$broadcast('buildRequests');
				console.log("event request list "+obj.requestItemList);
			}).error(function(data, status, headers, config) {
				console.log('Error');
				console.log(response);
			});
		}
		obj.getReport = function(){
			obj.report = [];
			$http({
				url: "http://" + location.host + "/team12/api/sql/reports/",
				method: "GET"
			}).success(function(data, status, headers, config) {
				for (i = 0; i < data.length; i++) {
					tmp = new Report();
					angular.copy(data[i], tmp);
					obj.report.push(tmp);
					console.log(tmp);
				}
				$rootScope.$broadcast('buildReports');
				console.log(obj.report);
			}).error(function(data, status, headers, config) {
				console.log('Error');
				console.log(response);
			});
		};
		obj.getEvents = function(selector){
			obj.eventItemList = [];
			$http({
				url: "http://" + location.host + "/team12/api/components/events/?request="+selector,
				method: "GET"
			}).success(function(data, status, headers, config) {
				for (i = 0; i < data.length; i++) {
					tmp = new EventItem();
					angular.copy(data[i], tmp);
					obj.eventItemList.push(tmp);
					console.log(tmp);
				}
				if(selector === 'events')
					$rootScope.$broadcast('buildEvents');
				else if(selector === 'myevents')
					$rootScope.$broadcast('buildMyEvents');
			}).error(function(data, status, headers, config) {
				console.log('Error');
				console.log(response);
			});
		};
		obj.addEvent = function(){
			$rootScope.$broadcast('showAddEventModal');
		};
		obj.addUser = function(){
			$rootScope.$broadcast('showAddUserModal');
		};
		obj.deleteUser = function(userType, userName){
			$http({
				url: "http://" + location.host + "/team12/api/sql/delete/user/",
				method: "POST",
				data: {
					request:'deleteById',
					tableSelect:userType,
					Semail:userName
				}
			}).success(function(data, status, headers, config) {
				console.log('got populate response '+data)
				if(data === ' delete-user-success '){
					$rootScope.$broadcast('delete-user-request-accepted');
				}else if(data === 'insert-server-error'){
					$rootScope.$broadcast('delete-user-request-denied');
				}
			}).error(function(data, status, headers, config) {
				console.log('Error this');
				console.log(response);
			});
		}
		obj.deleteEvent = function(deleteEid){
			$http({
				url: "http://" + location.host + "/team12/api/sql/delete/event/",
				method: "POST",
				data: {
					request:'deleteById',
					eid:deleteEid
				}
			}).success(function(data, status, headers, config) {
				console.log('got populate response '+data)
				if(data === ' delete-event-success '){
					$rootScope.$broadcast('event-request-accepted');
				}else if(data === 'delete-server-error'){
					$rootScope.$broadcast('delete-event-request-denied');
				}
			}).error(function(data, status, headers, config) {
				console.log('Error this');
				console.log(response);
			});
		}
		obj.updateEvent = function(event){
			$http({
				url: "http://" + location.host + "/team12/api/sql/update/event/",
				method: "POST",
				data: {
					request:'updateById',
					event:event
				}
			}).success(function(data, status, headers, config) {
				console.log('got populate response '+data)
				if(data === 'update-event-request-accepted'){
					$rootScope.$broadcast('event-request-accepted');
				}else if(data === 'update-server-error'){
					$rootScope.$broadcast('update-event-request-denied');
				}
			}).error(function(data, status, headers, config) {
				console.log('Error this');
				console.log(response);
			});
		}
		obj.updateUser = function(user){
			$http({
				url: "http://" + location.host + "/team12/api/sql/update/user/",
				method: "POST",
				data: {
					request:'updateById',
					user:user
				}
			}).success(function(data, status, headers, config) {
				console.log('got populate response '+data)
				if(data === 'update-user-request-accepted'){
					$rootScope.$broadcast('update-user-request-accepted');
				}else if(data === 'update-server-error'){
					$rootScope.$broadcast('update-user-request-denied');
				}
			}).error(function(data, status, headers, config) {
				console.log('Error this');
				console.log(response);
			});
		}
		obj.submitAddEventRequest = function(event){
			console.log(event);
			$http({
				url: "http://" + location.host + "/team12/api/sql/insert/event/",
				method: "POST",
				data: event
			}).success(function(data, status, headers, config) {
				console.log('got populate response '+data)
				if(data === 'insert-success'){
					$rootScope.$broadcast('add-event-request-success');
				}else if(data === 'insert-server-error'){
					$rootScope.$broadcast('add-event-request-denied');
				}
			}).error(function(data, status, headers, config) {
				console.log('Error this');
				console.log(response);
			});
		}
		obj.submitAddUserRequest = function(user){
			console.log(user);
			$http({
				url: "http://" + location.host + "/team12/api/sql/insert/user/",
				method: "POST",
				data: user
			}).success(function(data, status, headers, config) {
				console.log('got populate response '+data)
				if(data === 'insert-success'){
					$rootScope.$broadcast('add-user-request-success');
				}else if(data === 'insert-server-error'){
					$rootScope.$broadcast('add-user-request-denied');
				}
			}).error(function(data, status, headers, config) {
				console.log('Error this');
				console.log(response);
			});
		};
		obj.getState = function(){
			obj.state = [];
			$http({
				url: "http://" + location.host + "/team12/api/state/",
				method: "GET"
			}).success(function(data, status, headers, config) {
				obj.state = data;
				console.log(obj.state);
					console.log('true '+obj.state);
					$rootScope.$broadcast('buildState');
			}).error(function(data, status, headers, config) {
				console.log('Error');
				console.log(response);
			});
		}
		obj.submitSignInRequest = function(formUser, formPwd) {
			$http({
				url: "http://" + location.host + "/team12/api/session/login/",
				method: "POST",
				data: {
					id: formUser,
					pwd: formPwd
				}
			}).success(function(data, status, headers, config) {
				console.log('got populate response '+data)
				if(data ==='login-success'){
					$rootScope.$broadcast("loginSuccess");
				}else if(data ==='login-denied'){
					$rootScope.$broadcast("loginDenied");
				}else{
					$rootScope.$broadcast("loginUnkown");
				}
					
			}).error(function(data, status, headers, config) {
				console.log('Error');
				console.log(response);
			});
		};
		obj.signOut = function() {
			$http({
				url: "http://" + location.host + "/team12/api/session/logout/",
				method: "GET",
			}).success(function(data, status, headers, config) {
				$rootScope.$broadcast("logoutResponse");
			}).error(function(data, status, headers, config) {
				console.log('Error');
				console.log(response);
			});
		}
		obj.showSignInModal = function(){
			$rootScope.$broadcast('showSignInModal');
		};
		return obj;
	};
	/* Author: Jesus Chavez
	 * Controller for side nav
	 */
	function NavCtrl($scope, $mdSidenav, $timeout, global, $route) {
		$scope.msg = {
			"msg": "welcome, please sign in"
		};
		$scope.getAndToggleMenu = function() {
			global.getAndToggleMenu();

		};
		$scope.$on("populate", function() {
			populate();
			toggle('left');
		});
		$scope.getAction = function(a) {
			console.log(a);
			if (a == 'signin') {
				global.showSignInModal();
			} else if (a == 'signout') {
				global.signOut();
			}else if (a === 'getusers'){
				//global.getUsers();
			} else if (a === 'addevent'){
				global.addEvent();
			} else if (a === 'adduser'){
				global.addUser();
			} else if( a === 'myprofile'){
				$route.reload();
			}
			return toggle('left');
		};
		$scope.$on('logoutResponse', function(){
			global.getState();
		});
		function populate() {
			$scope.menuItems = [];
			$scope.menuItems = global.menuItemList;
			$scope.header = global.header;
			console.log(global.menuItemList);
			console.log(global.header);
		};

		function toggle(side) {
			$mdSidenav(side).toggle();
		}

	};
	function ModalDemoCtrl ($uibModal, $scope, $log, $document,global) {
		var $ctrl = this;
		$ctrl.animationsEnabled = true;
		$ctrl.selectedItem;
		$scope.$on('showSignInModal', function() {
			var parentElem = angular.element($document[0].querySelector('.modal-demo'));
			var modalInstance = $uibModal.open({
					animation: $ctrl.animationsEnabled,
					ariaLabelledBy: 'modal-title',
					ariaDescribedBy: 'modal-body',
					templateUrl: '/team12/templates/panel/panel.tmpl.1.03.html',
					controller: 'ModalInstanceCtrl',
					controllerAs: '$ctrl',
					size: 'sm',
					appendTo: parentElem
			});
			modalInstance.result.then(function(selectedItem) {
				$ctrl.selected = selectedItem;
				global.getAndToggleMenu();
			}, function() {
				$log.info('Modal was dismissed at: ' + new Date());
			});
		});
	};
	function ModalInstanceCtrl ($uibModalInstance, $scope, $timeout, $window, global) {
		var $ctrl = this;
		$ctrl.emitItem = '';
		$ctrl.emitItemBk = '';
		$ctrl.state={
			'cssClass':'',
			'msgText':''
		};
		$ctrl.input = {
			'user': '',
			'pass': ''
		};
		$scope.$on('loginSuccess', function() {
			$ctrl.state.msgText = 'login success';
			$ctrl.state.cssClass = '#90EE90';
			//global.getAndToggleMenu();
			$timeout(function() {
				$uibModalInstance.close('loginSuccess');
			}, 500);
		});
		$scope.$on('loginDenied', function() {
			$ctrl.state.msgText = 'login failed, incorrect username/password combination';
			$ctrl.state.cssClass = 'red';
		});
		$ctrl.submitSignInRequest = function() {
			global.submitSignInRequest($ctrl.input.user,$ctrl.input.pass);
			console.log('populating ');
		};
		$ctrl.closeLogInDialog = function() {
			$uibModalInstance.dismiss('close');
		};
	};
	function AddEventModalCtrl($uibModal, $scope, $log, $document){
		var $ctrl = this;
		$ctrl.animationsEnabled = true;
		$ctrl.selectedItem;
		$scope.$on('showAddEventModal', function(){
			console.log('what');
			var parentElem = angular.element($document[0].querySelector('.modal-event'));
			var modalInstance = $uibModal.open({
					animation: $ctrl.animationsEnabled,
					ariaLabelledBy: 'modal-title',
					ariaDescribedBy: 'modal-event',
					templateUrl: '/team12/templates/panel/addEventPanel.html',
					controller: 'AddEventModalInstanceCtrl',
					controllerAs: '$ctrl',
					size: 'lg',
					appendTo: parentElem
			});
			modalInstance.result.then(function(selectedItem) {
				$ctrl.selected = selectedItem;
			}, function() {
				$log.info('Modal was dismissed at: ' + new Date());
			});
		});
	}
	function AddEventModalInstanceCtrl ($uibModalInstance, $scope, $timeout, global) {
		var $ctrl = this;
    $ctrl.event = {
			'eventId': '',
			'eventName':'',
			'eventDescription':'',
			'eventDate':'',
			'eventLocation':'',
			'eventVolunteerCount':'',
			'eventTimeSlot': {
				'start':'',
				'end':''
			}
		}
		$ctrl.state={
			'cssClass':'',
			'msgText':''
		};
		$ctrl.n = 1;
		$ctrl.checkBoxSelected = false;
		$ctrl.isDisabled = false;
		$ctrl.selectTimeSlots = 0;
		$ctrl.update = function(){
			$ctrl.timeslots = new Array($ctrl.n);
			for(i = 0; i < $ctrl.timeslots.length; i++){
				console.log(i)
				$ctrl.timeslots[i] = {
					'start': $ctrl.timeslots[i-1].end,
					'end': new Date(),
					'nVolunteers':0.00
				}
			}
		}
		$ctrl.submitAddEventRequest = function() {
			global.submitAddEventRequest($ctrl.event);
			console.log($ctrl.event);
		};
		$ctrl.closeLogInDialog = function() {
			console.log($ctrl.event);
			$uibModalInstance.dismiss('close');
		};
		$ctrl.selectChanged = function(){
			$ctrl.selectTimeSlots = parseInt($ctrl.selectTimeSlots);
			$ctrl.event.timeSlots.n=$ctrl.selectTimeSlots;
		}
		$ctrl.getNumber= function(){
			var num =$ctrl.n;
			console.log(num);
			return new Array(num);
		}
		$ctrl.getIsDisabled = function(){
			console.log("'"+$ctrl.isDisabled+"'");
			return $ctrl.isDisabled;
		}
		$scope.$on('add-event-request-success', function(){
			$ctrl.state.msgText = 'add-user-request-success';
			$ctrl.state.cssClass = '#90EE90';
			console.log('this should close');
			$timeout(function() {
				global.getEvents('myevents');
				$uibModalInstance.close('closed');
			}, 500);
		});
		$scope.$on('add-event-request-denied', function(){
			$ctrl.state.msgText = 'login failed, incorrect username/password combination';
			$ctrl.state.cssClass = 'red';
		});
	};
	function AddEventModalInstanceConfig($mdThemingProvider){
		$mdThemingProvider.theme('docs-dark', 'default')
      .primaryPalette('yellow')
      .dark();
		
	}
	function AddUserModalCtrl($uibModal, $scope, $log, $document){
		var $ctrl = this;
		$ctrl.animationsEnabled = true;
		$ctrl.selectedItem;
		$scope.$on('showAddUserModal', function(){
			console.log('what');
			var parentElem = angular.element($document[0].querySelector('.modal-user'));
			var modalInstance = $uibModal.open({
					animation: $ctrl.animationsEnabled,
					ariaLabelledBy: 'modal-title',
					ariaDescribedBy: 'modal-body',
					templateUrl: '/team12/templates/panel/AddUserPanel.html',
					controller: 'AddUserModalInstanceCtrl',
					controllerAs: '$ctrl',
					size: 'lg',
					appendTo: parentElem
			});
			modalInstance.result.then(function(selectedItem) {
				$ctrl.selected = selectedItem;
			}, function() {
				$log.info('Modal was dismissed at: ' + new Date());
			});
		});
	};
	function AddUserModalInstanceCtrl ($uibModalInstance, $scope, $timeout, global) {
		var $ctrl = this;
    $ctrl.user = {
      'userType': '',
      'userName': '',
      'firstName': '',
			'middleInit':'',
      'lastName': '',
			'userPass': '',
			'telephone':'',
			'eventPreference':'',
			'userClass':''
    };
		$ctrl.state={
			'cssClass':'',
			'msgText':''
		};
		$ctrl.isDisabled = false;
		$ctrl.submitAddUserRequest = function() {
			global.submitAddUserRequest($ctrl.user);
			console.log($ctrl.user);
		};
		$ctrl.closeLogInDialog = function() {
			$uibModalInstance.dismiss('close');
		};
		$ctrl.selectChanged = function(){
			var select =$ctrl.user.userType; 
			if(select === 'admin'||select==='guest'){
				$ctrl.isDisabled = true;
			}else{
				$ctrl.isDisabled = false;
			}
		}
		$ctrl.getIsDisabled = function(){
			console.log("'"+$ctrl.isDisabled+"'");
			return $ctrl.isDisabled;
		}
		$scope.$on('add-user-request-success', function(){
			$ctrl.state.msgText = 'add-user-request-success';
			$ctrl.state.cssClass = '#90EE90';
			$timeout(function() {
				$uibModalInstance.close('loginSuccess');
				global.routeTimeOut();
			}, 500);
		});
		$scope.$on('add-user-request-denied', function(){
			$ctrl.state.msgText = 'login failed, incorrect username/password combination';
			$ctrl.state.cssClass = 'red';
		});
	};
	function AddUserModalInstanceConfig($mdThemingProvider){
		$mdThemingProvider.theme('docs-dark', 'default')
      .primaryPalette('yellow')
      .dark();
		
	}
	function Routes ($routeProvider, $locationProvider) {
		$routeProvider.when('/team12', {
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
			templateUrl: '/team12/templates/myevents/',
			controller: 'myeventsController'
		}).when('/myprofileRt', {
			templateUrl: '/team12/api/components/profile/',
			controller: 'myprofileController'
		}).when('/usersRt', {
			templateUrl: '/team12/templates/users/',
			controller: 'usersCtrl'
		}).when('/reportsRt', {
			templateUrl: '/team12/templates/reports/',
			controller: 'reportsController'
		});
		// configure html5 to get links working on jsfiddle
		$locationProvider.html5Mode(true);
	};
	function reportsController($route, $routeParams, $location, $scope, global){
		global.getReport();
		$scope.report = [];
		$scope.$on('buildReports', function() {
			$scope.report = global.report;
		});
	}
	function eventsController($route, $routeParams, $location, $scope, global) {
		global.getEvents('events');
		$scope.$on('buildEvents', function(){
			console.log('building events events');
			$scope.events = global.eventItemList;
			global.getState();
		});
		$scope.$on('buildState', function(){
			console.log('building events state');
			$scope.state = global.state;
		});
		$scope.signUp = function(eventId){
			console.log('sign up');
			global.signUp(eventId);
		};
	};

	function aboutController($route, $routeParams, $location) {

	};

	function contactController($route, $routeParams, $location) {

	};

	function myeventsController($route, $routeParams, $location, $scope, global) {
		global.getEvents('myevents');
		global.getRequests();
		$scope.requests = {
			'eventId': '',
			'eventName':'',
			'eventLocation':'',
			'eventName':'',
			'eventVolunteerCount':''
		};
		$scope.event = {
			'eventId': '',
			'eventName':'',
			'eventLocation':'',
			'eventName':'',
			'eventVolunteerCount':''
		};
		$scope.isModified = true;
		$scope.selected = {};
		$scope.$on('buildMyEvents', function(){
			console.log('building my events ');
			$scope.events = global.eventItemList;
			
		});
		$scope.$on('buildRequests', function(){
			$scope.requests = global.requestItemList;
		});
		$scope.$on('event-request-accepted', function(){
			global.getEvents('myevents');
		});
		$scope.delete = function(eid){
			global.deleteEvent(eid);
		};
		$scope.modify = function(event){
			console.log('modifying');
			$scope.selected = event;
			$scope.isModified = false;
		}
		$scope.save = function(event){
			$selected = '';
			global.updateEvent(event);
			$scope.isModified = true;
		}
	};

	function myprofileController($route, $routeParams, $location) {

	};

	function usersCtrl($route, $routeParams, $location, $scope, global) {
		global.routeTimeOut();
		$scope.users = {};
		$scope.isModified = true;
		$scope.selected = {};
		$scope.$on('buildUser', function(){
			console.log('bulding my users');
			$scope.users = global.userItemList;
		});
		$scope.$on('delete-user-request-accepted', function(){
			global.routeTimeOut();
		});
		$scope.$on('update-user-request-accepted', function(){
			global.routeTimeOut();
		});
		$scope.delete= function (userType, userName){
			global.deleteUser(userType, userName);
			console.log('deleting' +userType+' '+userName);
		};
		$scope.modify= function (user){
			console.log('modifying');
			$scope.selected = user;
			$scope.isModified = false;
		};
		$scope.save= function (user){
			$selected = '';
			global.updateUser(user);
			$scope.isModified = true;
		};
	};
	app.controller('NavCtrl', NavCtrl);
	app.controller('ModalDemoCtrl', ModalDemoCtrl);
	app.controller('AddUserModalCtrl', AddUserModalCtrl);
	app.controller('AddEventModalCtrl', AddEventModalCtrl);
	app.controller('ModalInstanceCtrl', ModalInstanceCtrl);
	app.controller('AddEventModalInstanceCtrl', AddEventModalInstanceCtrl);
	app.controller('AddUserModalInstanceCtrl', AddUserModalInstanceCtrl);
	app.controller('eventsController', eventsController);
	app.controller('aboutController', aboutController);
	app.controller('contactController', contactController);
	app.controller('myeventsController', myeventsController);
	app.controller('myprofileController', myprofileController);
	app.controller('contactController', contactController);
	
	app.controller('reportsController', reportsController);
	
	app.controller('usersCtrl', usersCtrl);
	app.factory('global', global);
	app.config(Routes);
	app.config(AddEventModalInstanceConfig);
	app.config(AddUserModalInstanceConfig);

})(angular);
