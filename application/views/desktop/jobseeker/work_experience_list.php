<?php $this->load->view('desktop/'.$role.'/crud_nav')?>


<?php if($work_experiences->result_id->num_rows > 0):?>
    <?php foreach($work_experiences->result() as $index => $experience):?>
        <div class="panel panel-default">
            <div class="panel-body">
                <h2><?php echo $experience->position?></h2>
                <h4><?php echo $experience->company?></h4>
                <?php if((int)$experience->is_present === 1):?>
                    <p><?php echo $experience->month_from.' '.$experience->year_from . ' - Present'?></p>
                <?php else:?>
                    <p><?php echo $experience->month_from.' '.$experience->year_from . ' - ' . $experience->month_to.' '.$experience->year_to?></p>
                <?php endif;?>
                <p><?php echo nl2br($experience->description)?></p>
                <a href="<?php echo user_anchor('edit/'.$experience->id, $_role, $controller)?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Edit</a>
                <a href="<?php echo user_anchor('delete/'.$experience->id, $_role, $controller)?>" class="btn btn-danger btn-xs delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Delete</a>
                <input type="radio" ng-click="set_primary('<?php echo $experience->id?>')" <?php echo (((int)$experience->is_primary === 1)?'checked="checked':"") ?> value="<?php echo $experience->id?>" name="is_primary"><span>Primary</span>
            </div>
        </div>

    <?php endforeach;?>

<?php endif;?>


