<h1>Registration</h1>



<?php if($alert_type != 'Success'):?>
		<div class="col-md-10">
	    <form class="form-horizontal" action="<?php echo base_url('registration/validate_registration')?>" method="post">
	    	
	        <div class="form-group">
	            <?php
	                $options = "";
	                foreach(array('job seeker'=>'Job Seeker','employee' => 'Employer') as $index => $value){
	                    $selected = ((set_value('role')==$value)?'selected="selected"':'');
	                    $options .= '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
	                }
	            ?>
	            <label for="" class="col-sm-2 control-label">Account Type</label>
	            <div class="col-sm-6">
	                <select class="form-control" name="role_name">
	                    <option value="">Select One</option>
	                    <?php echo $options?>
	                </select>
	            </div>
	        </div>
	
	        <div class="form-group">
	            <label for="" class="col-sm-2 control-label">First Name</label>
	            <div class="col-sm-6">
	                <input type="text" class="form-control" name="first_name" id="inputEmail3" value="<?php echo set_value('first_name') ?>" placeholder="">
	            </div>
	        </div>
	        <div class="form-group">
	            <label for="" class="col-sm-2 control-label">Last Name</label>
	            <div class="col-sm-6">
	                <input type="text" class="form-control" name="last_name" id="inputEmail3" value="<?php echo set_value('last_name') ?>" placeholder="">
	            </div>
	        </div>
	        <div class="form-group">
	            <label for="" class="col-sm-2 control-label">Email</label>
	            <div class="col-sm-6">
	                <input type="email" class="form-control" name="email" id="inputEmail3" value="<?php echo set_value('email') ?>" placeholder="">
	            </div>
	        </div>
	        <div class="form-group">
	            <label for="" class="col-sm-2 control-label">Password</label>
	            <div class="col-sm-6">
	                <input type="password" class="form-control" name="password" id="inputPassword3" value="<?php echo set_value('password') ?>" placeholder="">
	            </div>
	        </div>
	        <div class="form-group">
	            <label for="" class="col-sm-2 control-label">Repeat Password</label>
	            <div class="col-sm-6">
	                <input type="password" class="form-control" name="repeat_password" id="inputPassword3" value="<?php echo set_value('repeat_password') ?>" placeholder="">
	            </div>
	        </div>
	
	        <div class="form-group">
	            <div class="col-sm-offset-2 col-sm-6">
	                <button type="submit" class="btn btn-default">Save</button>
	            </div>
	        </div>
	    </form>
	</div>
<?php endif;?>	