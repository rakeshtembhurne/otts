<div class="courses form">
	<h2><?php echo __('Add Course'); ?></h2>	
	<?php
		echo $this->Form->create('Course', $twitterBootstrapCreateOptions);
		echo $this->Form->input('board_id', array('empty' => '--select--'));
		echo $this->Form->input('name');
		echo $this->Form->end($twitterBootstrapEndOptions);
	?>
</div>
