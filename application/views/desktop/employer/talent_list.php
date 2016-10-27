<h1>Talents</h1>
<div class="container">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Full Name</th>
            <th>email</th>
            <th>Position</th>
        </tr>
        </thead>
        <tbody>
            <tr ng-repeat="job_seeker in job_seekers">
                <td>
                    <a href="<?php echo base_url($role.'/'.$controller.'/detail')?>/{{job_seeker.id}}" ng-bind="job_seeker.last_name + ' ' + job_seeker.first_name">

                    </a>
                </td>
                <td ng-bind="job_seeker.email"></td>
                <td ng-bind="job_seeker.position + ' at ' + job_seeker.company"></td>
            </tr>
        </tbody>
    </table>
</div>