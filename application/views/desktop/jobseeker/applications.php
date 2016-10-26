<h1>Job Applications</h1>

<div class="container">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Position</th>
            <th>Company</th>
            <th>Category</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
            <tr ng-repeat="job_application in job_applications">
                <td>
                    <a href="<?php echo base_url('vacancies/detail')?>/{{job_application.vacancies_id}}">{{job_application.title}}</a>
                </td>
                <td>{{job_application.company}}</td>
                <td>{{job_application.category}}</td>
                <td>{{job_application.application_status}}</td>
            </tr>
        </tbody>
    </table>
</div>