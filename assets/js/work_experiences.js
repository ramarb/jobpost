/**
 * Created by ramon on 10/24/16.
 */
/**
 * Created by ramon on 10/21/16.
 */
var app = angular.module('jobBoard',[]);

app.controller('jobBoardCtrl',function($scope, $http, $location, $timeout){
    $scope.months = ['January','February','March','April','May','June','July','August','September','October','November','December','Present'];
    $scope.month_to = 'Present';
    $scope.month_from = $scope.months[0];
    $scope.select_month_to = function(data){
        //alert(data);
        $scope.month_to = data;
    }

    $scope.select_month_from = function(data){
        //alert(data);
        $scope.month_from = data;
    }
});
