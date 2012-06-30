<div class="questions view">
<h2><?php  echo __('Question');?></h2>
	<dl>
		<dt class="span3"><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($question['Question']['id']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo $this->Html->link($question['Subject']['name'], array('controller' => 'subjects', 'action' => 'view', $question['Subject']['id'])); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($question['Question']['title']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Option 1'); ?></dt>
		<dd>
			<?php echo h($question['Question']['option_1']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Option 2'); ?></dt>
		<dd>
			<?php echo h($question['Question']['option_2']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Option 3'); ?></dt>
		<dd>
			<?php echo h($question['Question']['option_3']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Option 4'); ?></dt>
		<dd>
			<?php echo h($question['Question']['option_4']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Answer'); ?></dt>
		<dd>
			<?php
            $i = 0;
			foreach (unserialize($question['Question']['answer']) as $key => $answer) {
				
				if($i == 0) {
                     if($answer) { echo $key; $i++;}
                
				} else {
					 if($answer) { echo ', '.$key;}
				}
			
		} ?>		
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($question['Question']['created']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($question['Question']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php echo $this->element('sidebar'); ?>
