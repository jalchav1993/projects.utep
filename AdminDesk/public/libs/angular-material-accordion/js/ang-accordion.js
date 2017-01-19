/*
 * angaccordion
 * Accordion directive for AngularJS
 * Licensed under the MIT license
 */

(function() {
    'use strict';

    angular.module('angAccordion', ['collapsibleItem'])
      .controller('angAccordionController', ['$scope', function($scope){
        var collapsibleItems = [];

          this.openCollapsibleItem = function(collapsibleItemToOpen) {
            if( $scope.oneAtATime ) {
              angular.forEach(collapsibleItems, function(collapsibleItem) {
                collapsibleItem.isOpenned = false;
                collapsibleItem.icon = collapsibleItem.closeIcon;
              });
            }
            collapsibleItemToOpen.isOpenned = true;
          };

          this.addCollapsibleItem = function(collapsibleItem) {
            collapsibleItems.push(collapsibleItem);

            if ( $scope.closeIconClass !== undefined || $scope.openIconClass !== undefined ) {
              collapsibleItem.iconsType = 'class';
              collapsibleItem.closeIcon = $scope.closeIconClass;
              collapsibleItem.openIcon = $scope.openIconClass;
            }
            else if ( $scope.closeIconUrl !== undefined || $scope.openIconUrl !== undefined ) {
              collapsibleItem.iconsType = 'url';
              collapsibleItem.closeIcon = $scope.closeIconUrl;
              collapsibleItem.openIcon = $scope.openIconUrl;
            }

            collapsibleItem.iconIsOnLeft = $scope.iconPosition == 'left' ? true: false;
          };

      }])
      .directive('angAccordion', function() {
      return {
        restrict: 'EA',
        transclude: true,
        replace: true,
        scope: {
          oneAtATime: '@',
          closeIconUrl: '@',
          openIconUrl: '@',
          closeIconClass: '@',
          openIconClass: '@',
          iconPosition: '@'
        },
        controller: 'angAccordionController',
        template: '<div class="accordion" ng-transclude></div>'
      };
    });

    angular.module('collapsibleItem', []).directive('collapsibleItem', function() {
      return {
        require: '^angAccordion',
        restrict: 'EA',
        transclude: true,
        replace: true,
        scope: {
          itemTitle: '@',
          itemDisabled: '=',
          initiallyOpen: '='
        },
        link: function(scope, element, attrs, accordionController) {
          scope.isOpenned = (scope.initiallyOpen) ? true : false;
          accordionController.addCollapsibleItem(scope);

          if(scope.isOpenned)
            scope.icon = scope.openIcon;
          else
            scope.icon = scope.closeIcon;

          scope.toggleCollapsibleItem = function () {
            if(scope.itemDisabled)
              return;

            if(!scope.isOpenned) {
              accordionController.openCollapsibleItem(this);
              scope.icon = scope.openIcon;
            }
            else {
              scope.isOpenned = false;
              scope.icon = scope.closeIcon;
            }
          };

          scope.getIconUrl = function ( type ) {
            return type == 'url' ? scope.icon : null;
          };
        },
        template: '<md-card class="collapsible-item time-entry" ng-class="{open: isOpenned}"><md-card-title class="accordion-title" ng-class="{disabled: itemDisabled}" ng-click="toggleCollapsibleItem()"><md-card-title-text><span class="md-headline">{{itemTitle}}</span></md-card-title-text></md-card-title><div class="body"><div class="content" ng-transclude></div></div></md-card>'
    };
    });
})();
