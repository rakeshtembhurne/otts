<div class="subjects form">
<?php echo $this->Form->create('Subject', $twitterBootstrapCreateOptions);?>
	
		<h2><?php echo __('Add Subject'); ?></h2>
	<?php	
	    
		echo $this->Form->input('name');
	?>

<?php echo $this->Form->end($twitterBootstrapEndOptions);?>
</div>
<?php echo $this->element('sidebar'); ?>
