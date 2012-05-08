<div class="boards form">
	<h2><?php echo __('Add Board'); ?></h2>	
	<?php
		echo $this->Form->create('Board', $twitterBootstrapCreateOptions);
		echo $this->Form->input('name');
		echo $this->Form->end($twitterBootstrapEndOptions);
	?>
</div>