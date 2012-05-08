<div class="boards form">
<?php echo $this->Form->create('Board');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Board'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Board.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Board.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Boards'), array('action' => 'index'));?></li>
	</ul>
</div>
