/**
 * Created by ramon on 10/21/16.
 */
var app = angular.module('jobBoard',[]);

app.controller('jobBoardCtrl',function($scope, $http, $location, $timeout){
    $scope.applicants = applicants;
});