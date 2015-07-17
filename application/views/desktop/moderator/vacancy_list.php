
<?php $this->load->view('desktop/'.$role.'/crud_nav')?>
<?php $this->load->view('desktop/common/alert_message')?>

<?php

    $a_sort = array(
        'industry' => array('asc','','Industry'),
        'category' => array('asc','','Category'),
        'company' => array('asc','','Company'),
        'title' => array('asc','','Title'),
        'vacancy_state' => array('asc','','Status'),
        'date_added' => array('asc','','Date Added'),
    );

    if($order == 'asc'){
        $a_sort[$sort][0] = 'desc';
        $a_sort[$sort][1] = '<span class="glyphicon glyphicon-sort-by-alphabet pull-right"></span>';
    }else{
        $a_sort[$sort][1] = '<span class="glyphicon glyphicon-sort-by-alphabet-alt pull-right"></span>';
    }
?>
<div class="container">
	<table class="table table-condensed">
		<thead>
			<tr>
				<?php foreach($a_sort as $index => $value):?>
					<?php echo "<th><a href=\"".base_url($role.'/vacancies/sort/' . $index . '/' . $value[0])."\">{$value[2]}</a> {$value[1]}</th>"?>
				<?php endforeach;?>
				<th>Action</th>	
			</tr>
		</thead>
		<tbody>
			<?php if($vacancies->num_rows() > 0):?>
				<?php foreach($vacancies->result() as $index => $value):?>
					<tr>
						<td><?php echo $value->industry ?></td>
						<td><?php echo $value->category ?></td>
						<td><?php echo $value->company ?></td>
						<td><?php echo $value->title ?></td>
						<td><?php echo $value->vacancy_state ?></td>
						<td><?php echo $value->date_added ?></td>
						<td><a href="<?php echo base_url($role . '/vacancies/edit/' . $value->id . '/')?>">Edit</a></td>
					</tr>
				<?php endforeach;?>	
			<?php endif;?>	
		</tbody>
	</table>
	<?php echo $pagination?>
</div>


