<h1>Applicants</h1>
<div class="container">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Vacancy</th>
            <th colspan="2">Applicant</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <tr ng-repeat="applicant in applicants">
                <td>{{applicant.title}}</td>
                <td>{{applicant.first_name}}</td>
                <td>{{applicant.last_name}}</td>
                <td>{{applicant.vacancy_applicant_state}}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('employer/vacancies/download_resume/{{applicant.id}}')?>">Download Resume</a></li>
                            <li><a href="#">View Profile</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script type="application/javascript">
    var applicants = <?php
    if($applicants->result_id->num_rows > 0){
        echo json_encode($applicants->result());
    }else{
        echo "''";
    }
?>;
</script>
