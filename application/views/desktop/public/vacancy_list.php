<h2>Vacancies</h2>
<?php echo $this->load->view('desktop/common/alert_message',array(),true)?>
<style>
	.my-grid div{
		border-bottom:#CCCCCC solid 1px;
		padding-top:5px;
		padding-bottom:5px;
	}
	
	.my-grid div.header{
		font-weight:bold;
		border-bottom:#CCCCCC solid 2px;
	}
	
	.grid-body:hover div{
		background-color:#DDFFDD;
		cursor:pointer;
	}
	
</style>



<form method="post" action="<?php echo base_url('vacancies/filter')?>">
    <div class="row" id="filter-form" style="display: none">

        <div class="form-group col-xs-2">
            <label class="control-label" for="inputSuccess1">Province</label>
            <select class="form-control" ng-model="province.province_id" ng-change="select_city()" name="provinces_id">
                <option ng-repeat="x in provinces" value="{{x.id}}">{{x.name}}</option>
            </select>
        </div>

        <div class="form-group col-xs-3">
            <label class="control-label" for="inputSuccess1">City/Town</label>
            <select class="form-control" ng-model="town" name="cities_id">
                <option ng-repeat="x in towns | filter : province : true" value="{{x.city_id}}">{{x.city}}</option>
            </select>
        </div>

        <div class="form-group col-xs-2">
            <label class="control-label" for="inputSuccess1">Industry</label>
            <select class="form-control" ng-model="industry.job_industry_id" ng-change="select_category()" name="job_industries_id">
                <option ng-repeat="x in industries" value="{{x.id}}">{{x.name}}</option>
            </select>
        </div>

        <div class="form-group col-xs-3">
            <label class="control-label" for="inputSuccess1">Category</label>
            <select class="form-control" ng-model="category" name="job_categories_id">
                <option ng-repeat="x in categories | filter : industry : true" value="{{x.job_category_id}}">{{x.job_category}}</option>
            </select>
        </div>
        <input type="text" ng-model="do_clear" value="0" name="do_clear" style="display: none">
        <div class="btn-group" role="group" aria-label="..." style="margin-top: 25px">
            <button type="submit" class="btn btn-default btn-primary">&nbsp;&nbsp;Filter&nbsp;&nbsp;</button>
            <button type="submit" class="btn btn-default btn-primary" ng-click="toggle_clear()">&nbsp;&nbsp;Clear&nbsp;&nbsp;</button>
        </div>

    </div>
</form>

<div class="row my-grid">

  <div class="col-sm-3 header">Title</div>
  <div class="col-sm-3 header">Company</div>
  <div class="col-sm-2 header">Province</div>
  <div class="col-sm-2 header">City/Town</div>

  <div class="col-sm-2 header">Date Posted</div>
</div>
<?php if($vacancies->num_rows() > 0):?>
	<?php foreach($vacancies->result() as $index => $value):?>
		<div class="row my-grid grid-body" id="<?php echo $value->id?>">

		  <div class="col-sm-3"><?php echo $value->title ?>&nbsp;</div>
		  <div class="col-sm-3"><?php echo $value->company ?>&nbsp;</div>
		  <div class="col-sm-2"><?php echo $value->provice ?>&nbsp;</div>
            <div class="col-sm-2"><?php echo $value->city ?>&nbsp;</div>
		  <div class="col-sm-2"><?php echo date('M d, Y',strtotime($value->date_added)) ?></div>
		</div>
	<?php endforeach;?>	
<?php endif;?>	
<?php echo $pagination?>




<script type="text/javascript">
    var form_data = <?php echo $form_data?>;
	$(window).load(function(){
		$(".grid-body").on('click',function(){
			window.location = "<?php echo base_url('vacancies/detail') ?>/" + $(this).attr('id');
		});
	});

    $(document).ready(function(){
        $("#filter-form").show('slow');
    });
</script>