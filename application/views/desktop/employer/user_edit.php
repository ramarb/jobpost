<ul class="nav nav-tabs">

    <li role="presentation" class="active"><a href="#">Edit Profile</a></li>
</ul>
<br>


	<div class="container">
		<div class="col-md-10">
		    <form class="form-horizontal" action="<?php echo base_url($_role . '/'.$this->uri->segment(2).'/validate_update_account/'.$id)?>" method="post" enctype="multipart/form-data">

                <?php if(strlen(trim($profile_picture))>0):?>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-3">
                            <a href="#" class="thumbnail">
                                <img alt="100%x180" data-src="holder.js/100%x180" src="<?php echo img_src($profile_picture)?>" data-holder-rendered="true" style="height: 180px; width: 100%; display: block;">
                            </a>
                        </div>
                    </div>
                <?php endif;?>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Profile Picture</label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control" name="profile_picture" id="inputEmail3" value="" placeholder="">
                    </div>
                </div>
		
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
                    <label for="" class="col-sm-2 control-label">Birth Date</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control date-picker" name="birth_date" id="" value="<?php echo $birth_date ?>" placeholder="YYYY-MM-DD">
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
                    <label for="" class="col-sm-2 control-label">Achievements</label>
                    <div class="col-sm-6">
                        <textarea name="achievements"><?php echo $achievements?></textarea>
                    </div>
                </div>
                <div class="">
                    <h4>Company Detail</h4>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Company Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" id="" value="<?php echo $name?>" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Overview</label>
                    <div class="col-sm-6">
                        <textarea name="description"><?php echo $description?></textarea>
                    </div>
                </div>

                <?php $this->load->view('desktop/common/industry_categories',array('industry'=>$industry,'category'=>$category)) ?>

                <?php $this->load->view('desktop/common/addresses',array('province'=>$province,'city'=>$city)) ?>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="address" id="" value="<?php echo $address?>" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Contact number</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="contact_number" id="" value="<?php echo $contact_number?>" placeholder="">
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
