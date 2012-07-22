<div id="questionEdit" class="questions form">
<?php echo $this->Form->create('Question', array_merge($twitterBootstrapCreateOptions, array('type' => 'file')));?>
		<h2><?php echo __('Edit Question'); ?></h2>
    <?php
    echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('topic_id', array('empty' => true));
		echo $this->Form->input(
        'title',
         array(
           'class' => 'input-xlarge',
           'label' => array('text' => 'question', 'class' =>'control-label'),
           'error' => array(
            'notempty' => __('Please enter question', true),
            'class'    => 'help-inline',
          ),
        )
    );
    foreach ($images as $image) {
        if ($image['Image']['image_of'] == 'question') {
            echo $this->Html->image(DS.'files'.DS.'images'.DS.$image['Image']['filename'], array('class' => 'thumbnail'));
        } 
    }
    echo $this->Form->error('answer', array('required' => 'Please select at least one correct answer'), array('class' => 'alert alert-error'));
    
    for($j = 1; $j <= 4; $j++) {
     ?>
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
       foreach ($images as $image) {
          if ($image['Image']['image_of'] == "option_$j") {
              echo $this->Html->image(DS.'files'.DS.'images'.DS.$image['Image']['filename'], array('class' => 'thumbnail'));
          } 
       }
     }
     echo $this->Form->error('answer', array('required' => 'Please check any correct answer'), array('class' => 'alert-error'));
	   echo $this->Form->end($twitterBootstrapEndOptions); 
     ?>

     <h2><?php echo __('Upload Question Images'); ?></h2>
     <h3><?php echo __('Questin Image'); ?></h3>
     <?php 
      echo $this->Form->create('Question', array_merge($twitterBootstrapCreateOptions, array('type' => 'file', 'url' => array('action' => 'edit_question_image', $question_id, 'admin' => true))));
      echo $this->Form->input('Image.image_of', array('value' => 'question', 'type' => 'hidden'));
      echo $this->Form->input('Image.question_id', array('value' => $question_id, 'type' => 'hidden'));
      foreach ($images as $image) {
          if ($image['Image']['image_of'] == 'question') {
              echo $this->Form->input('Image.id', array('value' => $image['Image']['id'], 'type' => 'hidden'));
          } 
      }
      echo $this->Form->input(
          'Image.filename',
          array(
           'type' => 'file',
           'label' => array('text' => 'Question Image', 'class' =>'control-label'),
          )
      );      
      echo $this->Form->end(array_merge($twitterBootstrapEndOptions, array('label' => 'Submit Question Image')));     
     ?>

     <?php for($j = 1; $j <= 4; $j++) { ?>
     <h3><?php echo __('Option %s Image', $j); ?></h3>
     <?php 
      echo $this->Form->create('Question', array_merge($twitterBootstrapCreateOptions, array('type' => 'file', 'url' => array('action' => 'edit_question_image', $question_id, 'admin' => true))));
      echo $this->Form->input('Image.image_of', array('value' => "option_$j", 'type' => 'hidden'));
      echo $this->Form->input('Image.question_id', array('value' => $question_id, 'type' => 'hidden'));
      foreach ($images as $image) {
          if ($image['Image']['image_of'] == "option_$j") {
              echo $this->Form->input('Image.id', array('value' => $image['Image']['id'], 'type' => 'hidden'));
          } 
      }
      echo $this->Form->input(
          'Image.filename',
          array(
           'type' => 'file',
           'label' => array('text' => "Option $j Image", 'class' =>'control-label'),
          )
      );      
      echo $this->Form->end(array_merge($twitterBootstrapEndOptions, array('label' => "Submit Option $j Image")));
      }
     ?>

</div>
<?php echo $this->element('sidebar'); ?>
<style>
  .thumbnail {width: 200px; height: 200px;}
</style>