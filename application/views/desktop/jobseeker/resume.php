
<h1>Resume</h1>


<?php if($resumes->result_id->num_rows > 0):?>
    <?php $resume = $resumes->row()?>

    <ul class="list-group">

        <li ng-repeat="resume in resumes"  class="list-group-item">

            <div class="btn-group">
                <a href="<?php echo user_anchor('download_resume/'.$resume->files_id,$_role,$controller)?>" class="btn btn-primary">{{resume.file_name}} <span class="glyphicon glyphicon-download"></span></a>
            </div>

        </li>
    </ul>

<?php endif;?>


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