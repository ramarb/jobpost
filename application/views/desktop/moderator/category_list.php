
<?php $this->load->view('desktop/'.$role.'/crud_nav')?>


<?php

    $a_sort = array(
    	'name' => array('asc','','Category'),
        'industry' => array('asc','','Industry')
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
					<?php echo "<th><a href=\"".base_url($role.'/categories/sort/' . $index . '/' . $value[0])."\">{$value[2]}</a> {$value[1]}</th>"?>
				<?php endforeach;?>
				<th>Action</th>	
			</tr>
		</thead>
		<tbody>
			<?php if($categories->num_rows() > 0):?>
				<?php foreach($categories->result() as $index => $value):?>
					<tr>
						<td><?php echo $value->name ?></td>
						<td><?php echo $value->industry ?></td>
						<td><a href="<?php echo base_url($role . '/categories/edit/' . $value->id . '/')?>">Edit</a></td>
					</tr>
				<?php endforeach;?>	
			<?php endif;?>	
		</tbody>
	</table>
	<?php echo $pagination?>
</div>


