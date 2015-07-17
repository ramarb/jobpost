<div class="form-group">
    <label for="" class="col-sm-2 control-label">Province</label>
    <div class="col-sm-6">
        <select class="form-control" name="province"><option value="">Select One</option></select>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Town</label>
    <div class="col-sm-6">
        <select class="form-control" name="city"><option value="">Select One</option></select>
    </div>
</div>

<script type="text/javascript">
	var locations;
	$(window).load(function(){
		$.ajax(
			{
				url:"<?php echo base_url('miscellaneous/addresses')?>",
				dataType:"json"
			}
		).done(function(data){
			locations = data;
			
			var options = '';
			$.each(data,function(index,value){
				$.each(value,function(i,v){
					options = options.concat('<option value="'+v.province_id+'">'+v.province+'</option>');
					return false;
				});
			});
			$('select[name="province"]').append(options);
			
			province = '<?php echo ((isset($province)===true)?$province:'')?>';
			city = '<?php echo ((isset($city)===true)?$city:'')?>';
			
			if(parseInt(province) > 0){
				$('select[name="province"]').val(province);
				generate_cities(locations,province,city);
			}
			
		});
	});
	
	$('select[name="province"]').on('change',function(){
		var val = $(this).val();
		generate_cities(locations, val, "");
	});
	
	function generate_cities(locations, province, city){
		var options = '<option value="">Select One</option>';
		$.each(locations,function(index,value){
			if(index == province){
				$.each(value,function(i,v){
					options = options.concat('<option value="'+v.city_id+'">'+v.city+'</option>');
				});
				return false;
			}
		});
		$('select[name="city"]').html(options);
		if(parseInt(city) > 0){
			$('select[name="city"]').val(city);	
		}
	}
</script>
