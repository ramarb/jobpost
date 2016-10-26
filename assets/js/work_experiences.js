/**
 * Created by ramon on 10/24/16.
 */
/**
 * Created by ramon on 10/21/16.
 */
var app = angular.module('jobBoard',[]);

if(form_data === undefined){
    var form_data = '';
}

app.controller('jobBoardCtrl',function($scope, $http, $location, $timeout){
    $scope.months = ['January','February','March','April','May','June','July','August','September','October','November','December','Present'];

    if(form_data !== ''){
        $scope.position = form_data.position;
        $scope.company = form_data.company;
        $scope.year_from = form_data.year_from;
        $scope.month_from = form_data.month_from;
        $scope.year_to = form_data.year_to;
        $scope.month_to =  form_data.month_to;
        $scope.description = form_data.description;

        if(form_data.id !== undefined){
            $scope.id = form_data.id;
        }

        $scope.select_month_to = function(data){
            $scope.month_to = data;
        }

        $scope.select_month_from = function(data){
            $scope.month_from = data;
        }
    }


    $scope.set_primary = function(id){
        var request_url = base_uri+'/set_primary/'+id;

        $http.get(request_url).then(function (response) {
            if(response.data.message !== 'Success'){
                window.location = base_uri;
            }
        });
    }


});
