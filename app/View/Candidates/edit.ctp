<div class="candidates form">
<?php echo $this->Form->create('Candidate');?>
	<fieldset>
		<legend><?php echo __('Edit Candidate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input(
                'experience_years',
                array(
                 'options' => range(0, 10),
                 'empty'   => true,
                )
            );
		echo $this->Form->input(
                'experience_months',
                array(
                 'options' => range(0, 11),
                 'empty'   => true,
                )
            );
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<?php echo $this->element('sidebar'); ?>
