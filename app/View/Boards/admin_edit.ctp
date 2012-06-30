<div class="boards form">
<?php echo $this->Form->create('Board', $twitterBootstrapCreateOptions);?>
	<fieldset>
		<legend><?php echo __('Admin Edit Board'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end($twitterBootstrapEndOptions);?>
</div>

