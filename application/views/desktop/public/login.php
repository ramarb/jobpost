<h1>Login</h1>



<?php if($alert_type != 'Success'):?>
		<div class="col-md-10">
	    <form class="form-horizontal" action="<?php echo base_url('login/validate_login')?>" method="post">
	        
	        <div class="form-group">
	            <label for="" class="col-sm-2 control-label">Email/Username</label>
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
	            <div class="col-sm-offset-2 col-sm-6">
	                <button type="submit" class="btn btn-default">Authenticate</button>
	            </div>
	        </div>
	    </form>
	</div>
<?php endif;?>	