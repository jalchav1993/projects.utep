(function(){
	var app = angular.module('EventModal',['ui.bootstrap', 'ngMaterial']);
	app.controller('ModalDemoCtrl', function ($uibModal, $log, $document) {
	  var $ctrl = this;
	  $ctrl.items = ['item1', 'item2', 'item3'];

	  $ctrl.animationsEnabled = true;

	  $ctrl.open = function (size, parentSelector) {
	    var parentElem = parentSelector ? 
	      angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
	    var modalInstance = $uibModal.open({
	      animation: $ctrl.animationsEnabled,
	      ariaLabelledBy: 'modal-title',
	      ariaDescribedBy: 'modal-body',
	      templateUrl: '/team12/templates/panel.tmpl.1.03.html',
	      controller: 'ModalInstanceCtrl',
	      controllerAs: '$ctrl',
	      size: size,
	      appendTo: parentElem,
	      resolve: {
	        items: function () {
	          return $ctrl.items;
	        }
	      }
	    });

	    modalInstance.result.then(function (selectedItem) {
	      $ctrl.selected = selectedItem;
	    }, function () {
	      $log.info('Modal was dismissed at: ' + new Date());
	    });
	  };
	});
	app.controller('ModalInstanceCtrl', function ($uibModalInstance, $scope, $timeout, items) {
	  var $ctrl = this;
	  $ctrl.items = items;
		$ctrl.emitItem ='';
		$ctrl.emitItemBk = '';
		$ctrl.input = {
			'user':'',
			'pass':''
		};
	  $ctrl.selected = {
	    item: $ctrl.items[0]
	  };
		$scope.$on('loginSuccess', function(){
			$ctrl.emitItem = 'login-success';
			$ctrl.emitItemBk = 'green';
			$timeout(function () {
				$uibModalInstance.close($ctrl.selected.item);
				}, 500);
		});
		$scope.$on('loginFail', function(){
			$ctrl.emitItem = 'login-fail';
			$ctrl.emitItemBk = 'red';
		});
	  $ctrl.submitLogInRequest = function () {
	    //$uibModalInstance.close($ctrl.selected.item);
			if($ctrl.input.user === 'admin'&& $ctrl.input.pass === 'admin1'){
				$scope.$emit('loginSuccess');
			}else{
				$scope.$emit('loginFail');
			}
			console.log('populating '+$ctrl.input.user+' '+$ctrl.input.pass);
	  };
	  $ctrl.closeLogInDialog = function () {
	    $uibModalInstance.dismiss('close');
	  };
	});
})(angular);
