
var app = angular.module('jobBoard',[]);
var init_towns = 0;
var init_category = 0;

app.controller('jobBoardCtrl',function($scope, $http, $location, $timeout){

    $scope.provinces = provinces;

    $scope.industries = industries;

    $scope.select_city = function(){
        if(init_towns === 0){
            $scope.towns = towns;
        }
    }

    $scope.select_category = function(){
        if(init_category === 0){
            $scope.categories = categories;
        }
    };

    $scope.toggle_clear = function(){
        $scope.do_clear = 1;
    }

    var province_id = parseInt(form_data.provinces_id);
    var cities_id = parseInt(form_data.cities_id);
    var job_industries_id = parseInt(form_data.job_industries_id);
    var job_categories_id = parseInt(form_data.job_categories_id);

    if(province_id > 0){
        $scope.province = {province_id:form_data.provinces_id};
        init_towns = 1;
        $scope.towns = towns;

        if(cities_id > 0){
            $scope.town = form_data.cities_id;
        }
    }

    if(job_industries_id > 0){
        $scope.industry = {job_industry_id:form_data.job_industries_id};
        init_category = 1;

        $scope.categories = categories;
        if(job_categories_id > 0){
            $scope.category = form_data.job_categories_id;
        }
    }

});