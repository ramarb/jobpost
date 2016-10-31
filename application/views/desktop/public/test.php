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
</div>