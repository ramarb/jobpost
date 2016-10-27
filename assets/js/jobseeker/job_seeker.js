/**
 * Created by ramon on 10/21/16.
 */
var app = angular.module('jobBoard',[]);
//var resumes = [{"user_files_id":"7","type":"Resume","file_name":"Senator-De-Lima.jpg"},{"user_files_id":"8","type":"Resume","file_name":"Crying.jpg"}];
app.controller('jobBoardCtrl',function($scope, $http, $location, $timeout){
    $scope.resumes = resumes;
});
