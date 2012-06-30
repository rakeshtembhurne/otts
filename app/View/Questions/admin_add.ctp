<div class="questions form">
    <h2><?php echo __('Add Question'); ?></h2>
    <?php
        echo $this->Form->create('Question', $twitterBootstrapCreateOptions);
        echo $this->Form->input('subject_id', array('empty' => true));
        
        echo $this->Form->input(
            'title',
            array(
                'class' => 'input-xlarge',
                'label' => array('text' => 'Question', 'class' =>'control-label'),
                'error' => array(
                    'notempty' => __('Please enter question', true),
                    'class'    => 'help-inline',
                ),
            )
        );		

      echo $this->Form->error('answer', array('required' => 'Please select at least one correct answer'), array('class' => 'alert alert-error'));
    for($j = 1; $j <= 4; $j++) { ?>
    <?php
        $error = '';
        $divClass = 'control-group';
        if ($j <= 1) {
         $error = $this->Form->error("option", array(
           'required' => __('Please enter answer', true),
           'attributes' => array(
             'wrap'  => 'span',
             'class' => 'help-inline',
             )
           )
         );
         $divClass = !empty($error) ? 'control-group required error' : 'control-group required';
        }
        $correct = "<span class='add-on'>".$this->Form->input("Question.answer.$j", array(
                     'type'  => 'checkbox',                     
                     'div'   => false,
                     'label' => false,
                     'between' => false,
                   )
        )."</span></div>";       

        echo $this->Form->input("option_$j", array(
         'type'  => 'text',
         'class' => 'input-xlarge',
         'div'     => $divClass,
         'between' => '<div class="controls"><div class="input-append">',
         'error' => array(
           'attributes' => array(
             'wrap'  => 'span',
             'class' => 'hide',
             )
           ),
         'after' => $correct.$error,
         )
        );
    }
    
    echo $this->Form->end($twitterBootstrapEndOptions);
    ?>
</div>
