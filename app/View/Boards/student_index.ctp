<div class="boards index">
	<h2><?php echo __('Tutorial & Test');?></h2>
	<table class="table table-condensed table-striped table-bordered">
    <tr>			
			<th><?php echo 'Board';?></th>	
			<th><?php echo 'Course';?></th>	
			<th><?php echo 'Subject';?></th>		
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php	
	
	foreach ($boards['Subject'] as $subject):?>
	
	<tr>
	    <td><?php echo  $subject['Course']['Board']['name']; ?>&nbsp;</td>
	    <td><?php echo $subject['Course']['name']; ?>&nbsp;</td>		
		<td><?php echo h($subject['name']); ?>&nbsp;</td>		
		<td>
            <?php echo $this->Html->link(__('Tutorial'), array('controller' => 'tutorials', 'action' => 'index', $subject['id']), array('class' => 'btn btn-info btn-mini')); ?>
			<?php echo $this->Html->link(__('Test'), array('controller' => "tests", 'action' => 'index', $subject['id']), array('class' => 'btn btn-success btn-mini')); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	
</div>
