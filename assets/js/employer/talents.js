/**
 * Created by ramon on 10/27/16.
 */

if(job_seekers === undefined){
    var job_seekers = '';
}

if(job_seeker === undefined){
    var job_seeker = '';
}
if(experiences === undefined){
    var experiences = '';
}

var app = angular.module('jobBoard',[]);
app.controller('jobBoardCtrl',function($scope, $http, $location, $timeout){
    $scope.job_seekers = job_seekers;
    if(job_seeker!==''){
        $scope.talent = job_seeker;
        $scope.full_name = job_seeker.first_name+' '+job_seeker.last_name;
    }

    $scope.experiences = experiences;

});
