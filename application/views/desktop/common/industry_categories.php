
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Industry</label>
    <div class="col-sm-6">
        <select class="form-control" name="industry"><option value="">Select One</option></select>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Category</label>
    <div class="col-sm-6">
        <select class="form-control" name="category"><option value="">Select One</option></select>
    </div>
</div>

<script type="text/javascript">
	var industry_categories;
	$(window).load(function(){
		$.ajax(
			{
				url:"<?php echo base_url('miscellaneous/industry_categories')?>",
				dataType:"json"
			}
		).done(function(data){
			industry_categories = data;
			
			var options = '';
			$.each(data,function(index,value){
				$.each(value,function(i,v){
					options = options.concat('<option value="'+v.job_industry_id+'">'+v.job_industry+'</option>');
					return false;
				});
			});
			$('select[name="industry"]').append(options);
			
			var industry = '<?php echo ((isset($industry)===true)?$industry:'')?>';
			var category = '<?php echo ((isset($category)===true)?$category:'')?>';
			
			if(parseInt(industry) > 0){
				$('select[name="industry"]').val(industry);
				generate_categories(industry_categories,industry,category);
			}
			
		});
	});
	
	$('select[name="industry"]').on('change',function(){
		var val = $(this).val();
		generate_categories(industry_categories, val, "");
	});
	
	function generate_categories(industry_categories, industry, category){
		
		var options = '<option value="">Select One</option>';
		$.each(industry_categories,function(index,value){
			if(index == industry){
				$.each(value,function(i,v){
					options = options.concat('<option value="'+v.job_category_id+'">'+v.job_category+'</option>');
				});
				return false;
			}
		});
		$('select[name="category"]').html(options);
		if(parseInt(category) > 0){
			$('select[name="category"]').val(category);	
		}
	}
</script>
