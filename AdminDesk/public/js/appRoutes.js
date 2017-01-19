// public/js/appRoutes.js
angular.module('appRoutes', [])
  .config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
    $routeProvider
      // home page
      .when('/', {
        templateUrl: 'views/home.html',
        controller: 'MainController'
      }).when('/home', {
        templateUrl: 'views/home.html',
        controller: 'MainController'
      })
      // nerds page that will use the NerdController
      .when('/nerds', {
        templateUrl: 'views/nerd.html',
        controller: 'NerdController'
      })
      // nerds page that will use the NerdController
      .when('/accounts', {
        templateUrl: 'views/accounts.html',
        controller: 'AccountController'
      });
    $locationProvider.html5Mode(true);
}]);
