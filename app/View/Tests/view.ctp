<div class="tests view">
    <h2><?php  echo __('View Test');?></h2>
    <p><strong>Question <?php echo $this->Session->read('Test.current_question') + 1;?>: </strong><?php echo __($question['Question']['title']); ?></p>
    <?php for ($i=1; $i <= 4; $i++) { ?>
        <p>
            <?php 
                echo __($i .') '. $question['Question']['option_'.$i]);                 
            ?>
        </p>
    <?php } ?>
    <div class="row">
        <?php echo $this->Form->create(); ?>
        <div class="span4">
            <?php if ($this->Session->read('Test.current_question') > 0): ?>                
                <input type="submit" value="<< Prev" name="btnPrev" class="btn btn-primary" />
            <?php endif; ?>            
            <?php if ($this->Session->read('Test.current_question') <
                            $this->Session->read('Test.question_count') - 1): ?>
                <input type="submit" value="Next >>" name="btnNext" class="btn btn-primary" />
            <?php endif; ?>            
        </div>
        </form>
    </div>
</div>