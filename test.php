
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Job Board Jr.</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://eugene/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="http://eugene/assets/css/style.css" />
    <link rel="stylesheet" href="http://eugene/assets/css/angular-material.min.css" />



    <script type="text/javascript" src="http://eugene/assets/js/jquery-1.11.2.min.js"> </script>

    <script type="text/javascript" src="http://eugene/assets/js/bootstrap.min.js"> </script>
    <script type="text/javascript" src="http://eugene/assets/js/angular.min.js"> </script>
    <script type="text/javascript" src="http://eugene/assets/js/angular/angular-animate.min.js"> </script>
    <script type="text/javascript" src="http://eugene/assets/js/angular/angular-aria.min.js"> </script>
    <script type="text/javascript" src="http://eugene/assets/js/angular/angular-material.min.js"> </script>
    <script type="text/javascript" src="http://eugene/assets/js/angular/angular-messages.min.js"> </script>
    <script type="text/javascript" src="http://eugene/assets/js/angular/angular-route.min.js"> </script>
    <script type="text/javascript" src="http://eugene/assets/js/angular/svg-assets-cache.js"> </script>
</head>
<body>




<div class="container">
    <div class="row container-entry-form">

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://eugene/">Home</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class=""><a href="http://eugene/vacancies">Vacancies</a></li>
                    </ul>
                    <form class="navbar-form navbar-left" id="public-search-vacancy" role="search" method="post" action="http://eugene/vacancies/search">
                        <div class="form-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Search" value="">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="submit" class="btn btn-default" id="clear-public-search">Clear Search</button>
                    </form>
                    <script type="text/javascript">
                        $(window).load(function(){
                            $("#public-search-vacancy").on('submit',function(){
                                if($('#public-search-vacancy div input[name="keyword"]').val().length < 4 && $('#public-search-vacancy div input[name="keyword"]').val().length > 0){
                                    alert('Please type at least 4 characters!');
                                    return false;
                                }
                            });
                            $("#clear-public-search").on('click',function(){
                                $('#public-search-vacancy div input[name="keyword"]').val('');
                            });
                        });
                    </script>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gleigh<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="http://eugene/employer/account/edit">Edit Profile</a></li>
                                <li><a href="http://eugene/employer/vacancies/mylist">My Vacancies</a></li>
                                <li><a href="http://eugene/employer/vacancies/applicants">Applicants</a></li>
                                <li><a href="http://eugene/employer/talents">Find Talents</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="http://eugene/employer/account">Dashboard</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="http://eugene/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <h1>Test</h1>

        <div ng-controller="DemoCtrl as ctrl" layout="column" ng-cloak="" class="autocompletedemoBasicUsage" ng-app="MyApp">
            <md-content class="md-padding">
                <form ng-submit="$event.preventDefault()">
                    <p>Use <code>md-autocomplete</code> to search for matches from local or remote data sources.</p>
                    <md-autocomplete ng-disabled="ctrl.isDisabled" md-no-cache="ctrl.noCache" md-selected-item="ctrl.selectedItem" md-search-text-change="ctrl.searchTextChange(ctrl.searchText)" md-search-text="ctrl.searchText" md-selected-item-change="ctrl.selectedItemChange(item)" md-items="item in ctrl.querySearch(ctrl.searchText)" md-item-text="item.display" md-min-length="0" placeholder="What is your favorite US state?">
                        <md-item-template>
                            <span md-highlight-text="ctrl.searchText" md-highlight-flags="^i">{{item.display}}</span>
                        </md-item-template>
                        <md-not-found>
                            No states matching "{{ctrl.searchText}}" were found.
                            <a ng-click="ctrl.newState(ctrl.searchText)">Create a new one!</a>
                        </md-not-found>
                    </md-autocomplete>
                    <br>
                    <md-checkbox ng-model="ctrl.simulateQuery">Simulate query for results?</md-checkbox>
                    <md-checkbox ng-model="ctrl.noCache">Disable caching of queries?</md-checkbox>
                    <md-checkbox ng-model="ctrl.isDisabled">Disable the input?</md-checkbox>

                    <p>By default, <code>md-autocomplete</code> will cache results when performing a query.  After the initial call is performed, it will use the cached results to eliminate unnecessary server requests or lookup logic. This can be disabled above.</p>
                </form>
            </md-content>
        </div></div>
</div>
<script type="application/javascript">
    var base_url = 'http://eugene/';
    var controller = '';
    var jquery_switch = '1';
    var role = 'employer';
    var base_uri = 'http://eugene/employer';
</script>
<script type="text/javascript" src="http://eugene/assets/js/test.js"> </script>
<script type="text/javascript" src="http://eugene/assets/js/helper.js"> </script>
</body>
</html>