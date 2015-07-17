<?php
$h1 = array(
	'vacancies' => 'Vacancies',
	'users' => 'Users'
);
?>
<h2><?php echo $h1[$this->uri->segment(2)] ?></h2>
<?php
$active_nav = array(
	'mylist'=>'',
	'sort'=>'',
	'create'=>'',
	'validate_create'=>'',
	'edit'=>'',
	'validate_edit'=>''
);

$active_nav[$this->uri->segment(3)] = 'active';

$default = ((strlen(trim($this->uri->segment(3)))>0)?'':'active');

?>
<ul class="nav nav-tabs">
  <li role="presentation" class="<?php echo $active_nav['mylist'] . $active_nav['sort'] . $default?>"><a href="<?php echo base_url($role . '/' . $this->uri->segment(2) . '/mylist') ?>">List</a></li>
  <li role="presentation" class="<?php echo $active_nav['create'] . $active_nav['validate_create'] ?>"><a href="<?php echo base_url($role . '/' . $this->uri->segment(2) . '/create') ?>">Create</a></li>
  <li role="presentation" class="<?php echo $active_nav['edit'] . $active_nav['validate_edit'] ?>"><a href="#">Edit</a></li>
</ul>
<br>