<div class="row" ng-if="talent.profile_picture != null">
    <div class="col-md-3 col-xs-6">
        <a href="#" class="thumbnail">
            <img alt="100%x180" ng-src="<?php echo base_url()?>/php_uploads/{{talent.profile_picture}}" data-holder-rendered="true" style="height: 180px; width: 100%; display: block;">
        </a>
    </div>
</div>
<div class="row">
    <div class="col-lg-1">
        <a href="#" class="btn btn-primary">Send Message <span class="glyphicon glyphicon-envelope"></span></a>
    </div>

</div>
<h2 ng-bind="full_name"></h2>
<p>
    <span ng-bind="talent.age"></span> years old

</p>



<h3>Achievements</h3>

<p><span ng-bind="talent.achievements"></span></p>

<h4>Experiences</h4>
<div class="panel panel-default" ng-repeat="experience in experiences">
    <div class="panel-body">
        <h3>{{experience.position}}</h3>
        <h4>{{experience.company}}</h4>
        <p ng-if="experience.is_present != 1">{{experience.month_from}} {{experience.year_from}} - {{experience.month_to}} {{experience.year_to}}</p>
        <p ng-if="experience.is_present == 1">{{experience.month_from}} {{experience.year_from}} - Present</p>
        <h5>Description</h5>
        <pre ng-bind="experience.description"></pre>
    </div>
</div>