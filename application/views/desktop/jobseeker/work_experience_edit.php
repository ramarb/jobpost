<?php $this->load->view('desktop/'.$role.'/crud_nav')?>
<form action="<?php echo base_url($_role.'/'.$controller.'/validate_edit/'.$id)?>" method="post">
    <input type="text" style="display: none" ng-model="id" name="id">
    <div class="form-group">
        <label for="email">Position:</label>
        <input type="text" class="form-control" id="" ng-model="position" name="position">
    </div>

    <div class="form-group">
        <label for="email">Company:</label>
        <input type="text" class="form-control" id="" ng-model="company" name="company">
    </div>

    <div class="form-group">
        <label for="email">Time Period From:</label>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">

            <div class="btn-group" role="group">
                <div class="dropdown">
                    <input type="text" style="display: none" ng-model="month_from" name="month_from">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" ng-bind="month_from">
                        Month From
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li ng-repeat="month in months"><a href="#" ng-click="select_month_from(month)" >{{month}}</a></li>
                    </ul>
                </div>
            </div>

            <div class="btn-group" role="group">
                <input type="text" class="form-control" id="" ng-model="year_from" name="year_from" placeholder="Year(eg:YYYY)">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="email">Time Period To:</label>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">

            <div class="btn-group" role="group">
                <div class="dropdown">
                    <input type="text" style="display: none" ng-model="month_to" name="month_to">
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
                <input type="text" class="form-control" id="" ng-model="year_to" name="year_to" placeholder="Year(eg:YYYY)">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="email">Position:</label>
        <textarea style="" ng-model="description" name="description"></textarea>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

</form>
<?php echo $form_data?>