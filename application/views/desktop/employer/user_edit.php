<ul class="nav nav-tabs">

    <li role="presentation" class="active"><a href="#">Edit Profile</a></li>
</ul>
<br>

<?php if($alert_type != 'Success'):?>
	<div class="container">
		<div class="col-md-10">
		    <form class="form-horizontal" action="<?php echo base_url($_role . '/'.$this->uri->segment(2).'/validate_update_account/'.$id)?>" method="post">

		
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">First Name</label>
		            <div class="col-sm-6">
                        <input type="hidden" name="user_id" value="<?php echo $id?>" />
                        <input type="hidden" name="role_name" value="<?php echo $role_name?>" />
                        <input type="hidden" name="user_state" value="<?php echo $user_state?>" />
		                <input type="text" class="form-control" name="first_name" id="inputEmail3" value="<?php echo $first_name ?>" placeholder="">
		            </div>
		        </div>
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">Last Name</label>
		            <div class="col-sm-6">
		                <input type="text" class="form-control" name="last_name" id="inputEmail3" value="<?php echo $last_name ?>" placeholder="">
		            </div>
		        </div>
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">Email</label>
		            <div class="col-sm-6">
		                <input type="email" class="form-control" name="email" id="inputEmail3" value="<?php echo $email ?>" placeholder="">
		            </div>
		        </div>
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">Password</label>
		            <div class="col-sm-6">
		                <input type="password" class="form-control" name="password" id="inputPassword3" value="<?php echo $password ?>" placeholder="">
		            </div>
		        </div>
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">Repeat Password</label>
		            <div class="col-sm-6">
		                <input type="password" class="form-control" name="repeat_password" id="inputPassword3" value="<?php echo $repeat_password ?>" placeholder="">
		            </div>
		        </div>
		
		        <div class="form-group">
		            <div class="col-sm-offset-2 col-sm-6">
		                <button type="submit" class="btn btn-default">Save</button>
		            </div>
		        </div>
		    </form>
		</div>
	</div>
	
	<script type="text/javascript">
	var role = '<?php echo $role_name ?>';
	var user_state = '<?php echo $user_state ?>';
	$(window).load(function(){
		$('select[name="role_name"]').val(role);
		$('select[name="user_state"]').val(user_state);
	});	
	</script>
<?php endif;?>	