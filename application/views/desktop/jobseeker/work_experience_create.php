<?php $this->load->view('desktop/'.$role.'/crud_nav')?>
<form>
    <div class="form-group">
        <label for="email">Position:</label>
        <input type="text" class="form-control" id="" name="">
    </div>

    <div class="form-group">
        <label for="email">Company:</label>
        <input type="text" class="form-control" id="" name="">
    </div>

    <div class="form-group">
        <label for="email">Time Period From:</label>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">

            <div class="btn-group" role="group">
                <div class="dropdown">
                    <input type="hidden" ng-model="month_from">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" ng-bind="month_from">
                        Month
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li ng-repeat="month in months"><a href="#" ng-click="select_month_from(month)" >{{month}}</a></li>
                    </ul>
                </div>
            </div>

            <div class="btn-group" role="group">
                <input type="text" class="form-control" id="" name="">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="email">Time Period To:</label>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">

            <div class="btn-group" role="group">
                <div class="dropdown">
                    <input type="hidden" ng-model="month_to">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" ng-bind="month_to">
                        Month
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li ng-repeat="month in months"><a href="#" ng-click="select_month_to(month)" >{{month}}</a></li>
                    </ul>
                </div>
            </div>

            <div class="btn-group" role="group">
                <input type="text" class="form-control" id="" name="">
            </div>
        </div>
    </div>



    <div class="form-group">
        <label for="email">Position:</label>
        <textarea></textarea>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

</form>