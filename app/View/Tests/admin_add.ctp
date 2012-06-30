<div class="tests form">
	<h2><?php echo __('Create Test'); ?></h2>
<?php echo $this->Form->create('Test', $twitterBootstrapCreateOptions);?>
	<?php
	    echo $this->Form->input('name');
		echo $this->Form->input('number_of_questions');
        echo $this->Form->input('subject_id', array('empty' => true));
		//echo $this->Form->input('code');
	?>
	</fieldset>
<?php echo $this->Form->end($twitterBootstrapEndOptions);?>
</div>
<?php echo $this->element('sidebar'); ?>
