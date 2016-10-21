<h1>Resume</h1>
<ul class="list-group">

    <li ng-repeat="resume in resumes"  class="list-group-item">

        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">Download</a></li>
                <li><a href="#">Edit</a></li>
            </ul>
        </div>
        {{resume.file_name}}

    </li>
</ul>




<form class="navbar-form navbar-left" role="search" enctype="multipart/form-data" method="post" action="<?php echo base_url($role.'/account/upload_resume')?>" >
    <div class="form-group">
        <input type="file" name="file" class="form-control" placeholder="Browse" />
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>


<script type="application/javascript">
    <?php if($resumes->result_id->num_rows > 0):?>
        var resumes = <?php echo json_encode($resumes->result()); ?>;
    <?php else: ?>
        var resumes = '';
    <?php endif;?>
</script>