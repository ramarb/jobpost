<h2>Vacancies</h2>

<style>
	.my-grid div{
		padding-top:7px;
		padding-bottom:7px;
	}
	
	.my-grid div.header{
		font-weight:bold;
	}
	
	.grid-body:hover div{
		background-color:#DDFFDD;
		cursor:pointer;
	}
	
</style>
<div class="row my-grid">
  <div class="col-sm-2 header">Industry</div>
  <div class="col-sm-4"><?php echo $vacancy->industry_name?>&nbsp;</div>
</div>
<div class="row my-grid">
  <div class="col-sm-2 header">Category</div>
  <div class="col-sm-4"><?php echo $vacancy->category_name?>&nbsp;</div>
</div>
<div class="row my-grid">
  <div class="col-sm-2 header">Title</div>
  <div class="col-sm-4"><?php echo $vacancy->title ?>&nbsp;</div>
</div>
<div class="row my-grid">
  <div class="col-sm-2 header">Description</div>
  <div class="col-sm-4"><?php echo $vacancy->description ?>&nbsp;</div>
</div>
<div class="row my-grid">
  <div class="col-sm-2 header">Company</div>
  <div class="col-sm-4"><?php echo $vacancy->company ?>&nbsp;</div>
</div>
<div class="row my-grid">
  <div class="col-sm-2 header">Salary</div>
  <div class="col-sm-4"><?php echo $vacancy->salary ?>&nbsp;</div>
</div>
<div class="row my-grid">
  <div class="col-sm-2 header">Provice</div>
  <div class="col-sm-4"><?php echo $vacancy->provice_name ?>&nbsp;</div>
</div>
<div class="row my-grid">
  <div class="col-sm-2 header">City</div>
  <div class="col-sm-4"><?php echo $vacancy->city_name ?>&nbsp;</div>
</div>
<div class="row my-grid">
  <div class="col-sm-2 header">Address</div>
  <div class="col-sm-4"><?php echo $vacancy->address ?>&nbsp;</div>
</div>
<div class="row my-grid">
  <div class="col-sm-2 header">Date Posted</div>
  <div class="col-sm-4"><?php echo $vacancy->date_added ?>&nbsp;</div>
</div>

<?php echo $application_form?>
