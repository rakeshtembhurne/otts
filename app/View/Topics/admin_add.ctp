<div class="courses form">
	<h2><?php echo __('Add Topic'); ?></h2>	
	<?php
		echo $this->Form->create(null, $twitterBootstrapCreateOptions);
		echo $this->Form->input('subject_id', array('empty' => '--select--'));
		echo $this->Form->input('name');
		echo $this->Form->end($twitterBootstrapEndOptions);
	?>
</div>
