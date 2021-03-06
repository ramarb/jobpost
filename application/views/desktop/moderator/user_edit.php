<?php $this->load->view('desktop/'.$role.'/crud_nav')?>

<?php if($alert_type != 'Success'):?>
	<div class="container">
		<div class="col-md-10">
		    <form class="form-horizontal" action="<?php echo base_url($role . '/'.$this->uri->segment(2).'/validate_edit/'.$id)?>" method="post">
		        <div class="form-group">
		            <input type="hidden" name="user_id" value="<?php echo $id?>" />
		            <label for="" class="col-sm-2 control-label">Account Type</label>
		            <div class="col-sm-6">
                        <?php $selected_role[$user_role_name] = 'selected="selected"'?>
                        <?php //p($roles->result())?>
		                <select class="form-control" name="role_name">
		                    <option value="">Select One</option>
		                    <?php if($roles->num_rows() !== null && $roles->num_rows() > 0):?>
		                    	<?php foreach($roles->result() as $index => $value):?>
		                    		<?php echo '<option ' . ((isset($selected_role[$value->name]) === true)?$selected_role[$value->name]:"") . ' value="'.$value->name.'">'.$value->name.'</option>'?>
		                    	<?php endforeach;?>	
		                    <?php endif;?>	
		                </select>
		            </div>
		        </div>
		        
		        <div class="form-group">
		            
		            <label for="" class="col-sm-2 control-label">Status</label>
		            <div class="col-sm-6">
		                <select class="form-control" name="user_state">
		                    <option value="">Select One</option>
		                    <?php if($user_states->num_rows() !== null && $user_states->num_rows() > 0):?>
		                    	<?php foreach($user_states->result() as $index => $value):?>
		                    		<?php echo '<option value="'.$value->name.'">'.$value->name.'</option>'?>
		                    	<?php endforeach;?>	
		                    <?php endif;?>	
		                </select>
		            </div>
		        </div>
		
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">First Name</label>
		            <div class="col-sm-6">
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
	var user_role = '<?php echo $role_name ?>';
	var user_state = '<?php echo $user_state ?>';
	$(window).load(function(){

		$('select[name="user_state"]').val(user_state);
	});	
	</script>
<?php endif;?>	