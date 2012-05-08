<?php //debug($question);
echo $this->Html->script('jquery-1.7.1');
echo $this->Html->script('custom');
?>
<div class="tests form">
    <div id="clock" style=float:right">&nbsp;</div>
    <div class="timer" style="display:none"><?php echo $timeRemaining;?></div>
<?php
    echo $this->Form->create(null, array('action' => "/take_test"));
    echo $this->Form->hidden('TestQuestion.test_id', array('value' => $question['test_id']));
    echo $this->Form->hidden('TestQuestion.id', array('value' => $question['id']));
    echo $this->Form->hidden('index', array('value' => $question['index']));
?>
    <p><strong><?php echo $question['title']; ?></strong></p>
    <?php
        echo $this->Form->input('TestQuestion.selected_option', array(
            'type' => 'radio',
            'options' => array(
                          '1' => $question['option_1'],
                          '2' => $question['option_2'],
                          '3' => $question['option_3'],
                          '4' => $question['option_4'],
                         ),
            'value' => ($question['selected_option']) ? $question['selected_option'] : null,
            'legend' => false,
        ));
    ?>
    <?php
        if ($question['prev']) {
        echo $this->Form->submit(
            'Previous',
            array(
                'name' => 'btnPrevNext',
                'value' => 'Previous',
                'div' => array('class' => 'submit'),
                'class' => 'prev',
            )
          );
        }
    ?>
    <?php
        if ($question['next']) {
        echo $this->Form->submit(
                'Next',
                array(
                    'name' => 'btnPrevNext',
                    'value' => 'Next',
                    'div' => array('class' => 'submit'),
                    'class' => 'next',
                )
            );
        }
    ?>
    <?php
        if ($question['submit']) {
            echo $this->Form->submit(
                'Submit Test',
                array(
                    'name' => 'btnSubmitTest',
                    'value' => 'Submit',
                    'div' => array('class' => 'submit'),
                    'class' => 'next',
                )
            );
        }
    ?>
<?php //echo $this->Form->end(array('name' => __('btnPrevNext'), 'label' => __('Next'), 'value' => __('Next')));?>
</div>
<?php echo $this->element('sidebar'); ?>
