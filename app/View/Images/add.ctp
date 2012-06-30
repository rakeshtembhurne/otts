<div class="images form">
<?php echo $this->Form->create(null, array_merge($twitterBootstrapCreateOptions, array('type' => 'file')));?>
		<h2><?php echo __('Upload image'); ?></h2>
	<?php
		echo $this->Form->input(
            'filename',
            array(
             'type' => 'file',
             'label' => array('text' => 'Image', 'class' =>'control-label'),
            )
        );    
	?>	
  <?php echo $this->Form->end($twitterBootstrapEndOptions); ?>

</div>
<?php echo $this->element('sidebar'); ?>
