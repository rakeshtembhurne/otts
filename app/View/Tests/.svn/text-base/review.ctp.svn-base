<div class="tests form">
    <div id="clock" style=float:right">&nbsp;</div>
    <div class="timer" style="display:none"><?php echo $timeRemaining;?></div>
<?php
    echo $this->Form->create('Test', array('action' => "/review/{$question['test_id']}"));
    echo $this->Form->hidden('TestQuestion.test_id', array('value' => $question['test_id']));
    echo $this->Form->hidden('TestQuestion.id', array('value' => $question['id']));
    echo $this->Form->hidden('index', array('value' => $question['index']));
?>
    <p><strong><?php echo $question['title']; ?></strong></p>
    <?php
        $range = range(1, 4);
        foreach($range as $num) {
            if ($num == $question['answer']) {
                $options[$num] = $this->Form->label(
                    "TestQuestion.selected_option.{$num}",
                    $question["option_{$num}"],
                    array('class' => 'green')
                );
            } else {
                $options[$num] = $this->Form->label(
                    "TestQuestion.selected_option.{$num}",
                    $question["option_{$num}"]
                );
            }
        }
    ?>
    <?php
        echo $this->Form->input('TestQuestion.selected_option', array(
            'type' => 'radio',
            'options' => $options,
            'value' => ($question['selected_option']) ? $question['selected_option'] : null,
            'legend' => false,
            'label' => false,
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
</div>
<?php echo $this->element('sidebar'); ?>
