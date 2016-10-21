
<?php $this->load->view('desktop/'.$role.'/crud_nav')?>

<div class="container">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th>Industry</th>
				<th>Category</th>
				<th>Company</th>
				<th>Title</th>
				<th>Status</th>
				<th>Date Added</th>
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


