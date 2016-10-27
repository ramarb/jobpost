/**
 * Created by ramon on 10/26/16.
 */
/**
 * Created by ramon on 10/21/16.
 */
var app = angular.module('jobBoard',[]);

app.controller('jobBoardCtrl',function($scope, $http, $location, $timeout){
    $scope.job_applications = job_applications;
});
