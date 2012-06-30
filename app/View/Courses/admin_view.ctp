<div class="courses view">
<h2><?php  echo __('Course');?></h2>
	<dl>
		<dt class="span3"><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($course['Course']['id']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Board'); ?></dt>
		<dd>
			<?php echo h($course['Board']['name']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($course['Course']['name']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($course['Course']['created']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($course['Course']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Subjects');?></h3>
	<?php if (!empty($course['Subject'])):?>
	<table class="table table-condensed table-striped table-bordered">
	<tr>		
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Course'); ?></th>		
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($course['Subject'] as $subject): ?>
		<tr>			
			<td><?php echo $subject['name'];?></td>
			<td><?php echo $course['Course']['name'];?></td>			
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('admin' => true, 'controller' => 'subjects', 'action' => 'view', $subject['id']), array('class' => 'btn btn-info btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'subjects', 'action' => 'edit', $subject['id']), array('class' => 'btn btn-success btn-mini')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'subjects', 'action' => 'delete', $subject['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $subject['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('New Subject'), array('controller' => 'subjects', 'action' => 'add', $course['Course']['id']),array('class' => 'btn btn-primary'));?>		
	</div>
</div>
