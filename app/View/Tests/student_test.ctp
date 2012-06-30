<div class="tests view">
    <h2><?php  echo __('Test');?></h2>
    <p><strong>Question <?php echo $this->Session->read('Test.current_question') + 1;?>: </strong><?php echo __($question['Question']['title']); ?></p>
    <?php //debug($this->request->data);  //debug($question); ?>
    <?php echo $this->Form->create('TestUser'); ?>
    <?php for ($i=1; $i <= 4; $i++) { ?>
        <p>
            <?php
            echo $this->Form->input('question_id', array('type' => 'hidden', 'value' => $question['Question']['id']));
            echo $i. ' ';
            echo $this->Form->input('Option.'.$i, array('type' => 'checkbox', 'div' => false, 'label' => array('div' => false, 'text' => $question['Question']['option_'.$i]))); 
                //echo __($i .') '. $question['Question']['option_'.$i]);                 
            ?>
        </p>
    <?php } ?>
    <div class="row">
        <?php //echo $this->Form->create(); ?>
        <div class="span4">
            <?php if ($this->Session->read('Test.current_question') > 0): ?>                
                <input type="submit" value="<< Prev" name="btnPrev" class="btn btn-primary" />
            <?php endif; ?>            
            <?php if ($this->Session->read('Test.current_question') <
                            $this->Session->read('Test.question_count') - 1): ?>
                <input type="submit" value="Next >>" name="btnNext" class="btn btn-primary" />
            <?php endif; ?> 
            <?php if ($this->Session->read('Test.current_question') ==
                            $this->Session->read('Test.question_count') - 1): ?>
                <input type="submit" value="Submit Test" name="submit" class="btn btn-success" />
            <?php endif; ?>            
        </div>
        <?php echo $this->Form->end(); ?>
        
    </div>
</div>