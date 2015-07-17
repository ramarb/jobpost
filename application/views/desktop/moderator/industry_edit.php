<?php $this->load->view('desktop/'.$role.'/crud_nav')?>
<?php echo $this->load->view('desktop/common/alert_message',array(),true)?>
<?php if($alert_type != 'Success'):?>
	<div class="container">
		<div class="col-md-10">
		    <form class="form-horizontal" action="<?php echo base_url($role . '/'.$this->uri->segment(2).'/validate_edit/'.$id)?>" method="post">
		        <input type="hidden" name="industry_id" value="<?php echo $id?>" />
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">Industry</label>
		            <div class="col-sm-6">
		                <input type="text" class="form-control" name="industry" id="inputEmail3" value="<?php echo $industry ?>" placeholder="">
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