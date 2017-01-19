(function(angular, undefined) {
  ‘use strict’;

  angular
      .module('demoApp', ['ngMaterial'])
      .controller('DemoDialogController', DialogController);

  var panelRef;

  function showPanel($event) {
    var panelPosition = $mdPanel.newPanelPosition()
        .absolute()
        .top('50%')
        .left('50%');

    var panelAnimation = $mdPanel.newPanelAnimation()
        .targetEvent($event)
        .defaultAnimation('md-panel-animate-fly')
        .closeTo('.show-button');

    var config = {
      attachTo: angular.element(document.body),
      controller: DialogController,
      controllerAs: 'ctrl',
      position: panelPosition,
      animation: panelAnimation,
      targetEvent: $event,
      templateUrl: 'dialog-template.html',
      clickOutsideToClose: true,
      escapeToClose: true,
      focusOnOpen: true
    }

    $mdPanel.open(config)
        .then(function(result) {
          panelRef = result;
        });
  }

  function DialogController(MdPanelRef, toppings) {
    var toppings;

    function closeDialog() {
      MdPanelRef &amp;&amp; MdPanelRef.close();
    }
  }
})(angular);