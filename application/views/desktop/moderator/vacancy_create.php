<?php $this->load->view('desktop/'.$role.'/crud_nav')?>
<?php echo $this->load->view('desktop/common/alert_message',array(),true)?>
<?php if($alert_type != 'Success'):?>
	<div class="container">
		<div class="col-md-10">
		    <form class="form-horizontal" action="<?php echo base_url($role . '/'.$this->uri->segment(2).'/validate_create')?>" method="post">
		        
		        <?php $this->load->view('desktop/common/industry_categories',array('industry'=>set_value('industry'),'category'=>set_value('category'))) ?>
		        
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">Company</label>
		            <div class="col-sm-6">
		                <input type="text" class="form-control" name="company" id="inputEmail3" value="<?php echo set_value('company') ?>" placeholder="">
		            </div>
		        </div>
		        
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">Title</label>
		            <div class="col-sm-6">
		                <input type="text" class="form-control" name="title" id="inputEmail3" value="<?php echo set_value('title') ?>" placeholder="">
		            </div>
		        </div>
		        
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">Description</label>
		            <div class="col-sm-6">
		                <textarea class="form-control" name="description" id="inputEmail3"><?php echo set_value('description') ?></textarea> 
		            </div>
		        </div>
		        
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">Salary</label>
		            <div class="col-sm-6">
		                <input type="text" class="form-control" name="salary" id="inputEmail3" value="<?php echo set_value('salary') ?>" placeholder="">
		            </div>
		        </div>
		        
		        <?php $this->load->view('desktop/common/addresses',array('province'=>set_value('province'),'city'=>set_value('city'))) ?>
		
		        
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">Address</label>
		            <div class="col-sm-6">
		                <input type="text" class="form-control" name="address" id="inputEmail3" value="<?php echo set_value('address') ?>" placeholder="">
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
		
<?php endif;?>	