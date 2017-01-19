(function(){
	//hoisted
	var app = angular.module('EventDesk', ['ngMaterial']);
	'use strict';
	/* Author: Jesus Chavez
	 * Menu item object node
	 */
	var MenuItem = function(){
		this.template = '';
		this.action = '';
	};
	/* Author: Jesus Chavez
	 * Global factory, handles http requests to rest
	 */
	function global($rootScope, $http){
		var obj = {};
		obj.menuItemList = [];
		obj.loginResponse = "";
		obj.getAndToggleMenu = function(){
			obj.menuItemList = [];
			$http({
				url: "http://" + location.host + "/api/menu/data.json",
	  		method: "GET"
			}).success(function (data, status, headers, config) {
	      for (i = 0; i < data.length; i++) {
	       	tmp = new MenuItem ();
	        angular.copy(data[i], tmp);
	        obj.menuItemList.push(tmp);
	      }
				$rootScope.$broadcast("populate");
			}).error(function (data, status, headers, config) {
	  		console.log('Error');
				console.log(response);
			});
		};
		obj.signIn = function(formUser, formPass){
			$http({
				url: "http://"+location.host+"/api/session/login/",
				method: "POST",
				data: {id:formUser, pwd:formPass}
			}).success(function (data, status, headers, config){
				obj.loginResponse = data;
				$rootScope.$broadcast("loginResponse");
				console.log(formUser+" "+formPass);
			}).error(function (data, status, headers, config) {
	  		console.log('Error');
				console.log(response);
			});
		}
		return obj;
	};
	/* Author: Jesus Chavez
	 * Controller for side nav
	 */
	function NavCtrl($scope, $mdSidenav, $timeout, $mdPanel, $mdDialog, global){
		this._mdPanel = $mdPanel;
		this.disableParentScroll = false;
		$scope.getAndToggleMenu = function(){
			global.getAndToggleMenu();
		
		};
		$scope.$on("populate", function () {
			$scope.menuItems = [];
	    $scope.menuItems = global.menuItemList;
			$mdSidenav('left').toggle();
	    console.log(global.menuItemList);
	  });  
		$scope.$on("loginResponse", function(){
			alert(global.loginResponse);
		});
		$scope.getAction = function(a){
			console.log(a);
			$mdSidenav('left').toggle();
			if(a == "signin"){
				var position = $mdPanel.newPanelPosition()
				.absolute()
				.center();
		  	var config = {
			    attachTo: angular.element(document.body),
			    controller: SignInPanelDialogCtrl,
			    controllerAs: 'ctrl',
			    disableParentScroll: this.disableParentScroll,
			    templateUrl: '/templates/panel.tmpl.1.03.html',
			    hasBackdrop: true,
			    panelClass: 'demo-dialog-example',
			    position: position,
			    trapFocus: true,
			    zIndex: 150,
			    clickOutsideToClose: true,
			    escapeToClose: true,
			    focusOnOpen: true
		 		};
		 		$mdPanel.open(config);
			}
		};
	};
	function SignInPanelDialogCtrl(global){
		
	};
	app.factory('global', global);
	app.controller('NavCtrl', NavCtrl);
  app.controller('SignInCtrl', SignInCtrl);
	app.controller('SignInPanelDialogCtrl', SignInPanelDialogCtrl);
})();