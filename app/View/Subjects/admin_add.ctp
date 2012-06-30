<div class="subjects form">
<?php echo $this->Form->create('Subject', $twitterBootstrapCreateOptions);?>
	
		<h2><?php echo __('Add Subject'); ?></h2>
	<?php	
	    echo $this->Form->input('course_id', array(
	    	'empty' => '--Select--', 	    	 
	    	'selected' => $courseId
	    	)
	    );
		echo $this->Form->input('name');
	?>

<?php echo $this->Form->end($twitterBootstrapEndOptions);?>
</div>
<?php echo $this->element('sidebar'); ?>
