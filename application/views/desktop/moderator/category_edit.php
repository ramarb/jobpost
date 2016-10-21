<?php $this->load->view('desktop/'.$role.'/crud_nav')?>

<?php if($alert_type != 'Success'):?>
	<div class="container">
		<div class="col-md-10">
		    <form class="form-horizontal" action="<?php echo base_url($role . '/'.$this->uri->segment(2).'/validate_edit/' . $id . '/')?>" method="post">
		        <input type="hidden" name="category_id" value="<?php echo $id?>" />
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">Industry</label>
		            <div class="col-sm-6">
		                <select class="form-control" name="industry_id">
		                    <option value="">Select One</option>
		                    <?php if($industries->num_rows() !== null && $industries->num_rows() > 0):?>
		                    	<?php foreach($industries->result() as $index => $value):?>
		                    		<?php echo '<option value="'.$value->id.'">'.$value->name.'</option>'?>
		                    	<?php endforeach;?>	
		                    <?php endif;?>	
		                </select>
		            </div>
		        </div>
		        
		        <div class="form-group">
		            <label for="" class="col-sm-2 control-label">Category</label>
		            <div class="col-sm-6">
		                <input type="text" class="form-control" name="category" id="inputEmail3" value="<?php echo $category ?>" placeholder="">
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
	var industry_id = '<?php echo $industry_id ?>';
	
	$(window).load(function(){
		$('select[name="industry_id"]').val(industry_id);
	});	
	</script>
<?php endif;?>	