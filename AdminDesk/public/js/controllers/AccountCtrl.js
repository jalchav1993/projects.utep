// public/js/controllers/AccountCtrl.js
angular.module('AccountCtrl', ['ngMaterial']).controller('AccountController', function($scope, $timeout) {
	$scope.data = {
	  selectedIndex: 0,
	  bottom:        false
	};
	$scope.tools = {
		FirstName: {
			label:'First Name',
		  model:true,
			content:''
		},
		LastName: {
			label:'Last Name',
		  model:true,
			content:''
		},
		MiddleName: {
			label:'Middle Name',
		  model:true,
			content:''
		},
		ID: {
			label:'Identification',
		  model:false,
			content:''
		},
		CreationDate: {
			label:'Creation Date',
		  model:false,
			content:''
		},
		Age: {
			label:'Age',
		  model:false,
			content:''
		},
		Phone: {
			label:'Phone',
		  model:false,
			content:''
		},
		Email: {
			label:'Email',
		  model:false,
			content:''
		},
		Country: {
			label:'Country',
		  model:false,
			content:''
		},
		City: {
			label:'City',
		  model:false,
			content:''
		},
		State: {
			label:'State',
		  model:false,
			content:''
		}
	}
  $scope.next = function() {
    $scope.data.selectedIndex = Math.min($scope.data.selectedIndex + 1, 4) ;
  };
  $scope.previous = function() {
    $scope.data.selectedIndex = Math.max($scope.data.selectedIndex - 1, 0);
  };
});