<div class="questions form">
<?php echo $this->Form->create('Question');?>
	<fieldset>
		<legend><?php echo __('Edit Question'); ?></legend>
	<?php
		echo $this->Form->input('subject_id', array('empty' => true));
		echo $this->Form->input('title');
        $optionParams = array(
                         'type' => 'text',
                         'label' => false,
                        );
        echo $this->Form->input(
                'answer',
                array(
                 'type'    => 'radio',
                 'options' => array(
                               '1' => $this->Form->input(
                                          'option_1',
                                          $optionParams
                                       ),
                               '2' => $this->Form->input(
                                          'option_2',
                                          $optionParams
                                       ),
                               '3' => $this->Form->input(
                                          'option_3',
                                          $optionParams
                                       ),
                               '4' => $this->Form->input(
                                          'option_4',
                                          $optionParams
                                       )
                              ),
                 'label'   => false,
                 'div'     => array('class' => 'required'),
                 'before'  => '<label for="answer">Options</label>',
                 'legend'  => false,
                )
             );
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<?php echo $this->element('sidebar'); ?>
