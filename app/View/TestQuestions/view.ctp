<div class="testQuestions view">
<h2><?php  echo __('Test Question');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($testQuestion['TestQuestion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Test'); ?></dt>
		<dd>
			<?php echo $this->Html->link($testQuestion['Test']['id'], array('controller' => 'tests', 'action' => 'view', $testQuestion['Test']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($testQuestion['TestQuestion']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option 1'); ?></dt>
		<dd>
			<?php echo h($testQuestion['TestQuestion']['option_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option 2'); ?></dt>
		<dd>
			<?php echo h($testQuestion['TestQuestion']['option_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option 3'); ?></dt>
		<dd>
			<?php echo h($testQuestion['TestQuestion']['option_3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option 4'); ?></dt>
		<dd>
			<?php echo h($testQuestion['TestQuestion']['option_4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer'); ?></dt>
		<dd>
			<?php echo h($testQuestion['TestQuestion']['answer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Selected Option'); ?></dt>
		<dd>
			<?php echo h($testQuestion['TestQuestion']['selected_option']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($testQuestion['TestQuestion']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($testQuestion['TestQuestion']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($testQuestion['TestQuestion']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php echo $this->element('sidebar'); ?>
