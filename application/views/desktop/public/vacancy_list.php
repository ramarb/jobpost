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

<div class="row my-grid">
  <div class="col-sm-2 header">Industry</div>
  <div class="col-sm-2 header">Cateogry</div>
  <div class="col-sm-2 header">Title</div>
  <div class="col-sm-2 header">Company</div>
  <div class="col-sm-2 header">Province</div>
  <div class="col-sm-2 header">Date Posted</div>
</div>
<?php if($vacancies->num_rows() > 0):?>
	<?php foreach($vacancies->result() as $index => $value):?>
		<div class="row my-grid grid-body" id="<?php echo $value->id?>">
		  <div class="col-sm-2"><?php echo $value->industry ?>&nbsp;</div>
		  <div class="col-sm-2"><?php echo $value->category ?>&nbsp;</div>
		  <div class="col-sm-2"><?php echo $value->title ?>&nbsp;</div>
		  <div class="col-sm-2"><?php echo $value->company ?>&nbsp;</div>
		  <div class="col-sm-2"><?php echo $value->provice ?>&nbsp;</div>
		  <div class="col-sm-2"><?php echo date('M d, Y',strtotime($value->date_added)) ?></div>
		</div>
	<?php endforeach;?>	
<?php endif;?>	
<?php echo $pagination?>
<script type="text/javascript">
	$(window).load(function(){
		$(".grid-body").on('click',function(){
			window.location = "<?php echo base_url('vacancies/detail') ?>/" + $(this).attr('id');
		});
	});
</script>