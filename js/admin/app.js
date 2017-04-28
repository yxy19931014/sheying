/**
 * Created by Administrator on 2017/4/20.
 */
var App=angular.module('App',['ngRoute','Ctrls']);
App.run(['$rootScope',function ($rootScope) {
    $rootScope.key=0;
}]);
App.config(['$routeProvider',function ($routeProvider) {
    $routeProvider.when('/users',{
        templateUrl:'./users.html',
        controller:'usersCtrl'
    }).when('/orders',{
        templateUrl:'./orders.html',
        controller:'ordersCtrl'
    }).when('/discuss',{
        templateUrl:'./discuss.html',
        controller:'discussCtrl'
    }).when('/price',{
        templateUrl:'./price.html',
        controller:'priceCtrl'
    }).otherwise({
        redirectTo:'/users'
    });
}]);
