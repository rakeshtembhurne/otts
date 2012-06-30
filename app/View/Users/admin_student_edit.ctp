<div class="users form">
<?php echo $this->Form->create('User', $twitterBootstrapCreateOptions);?>    
        <h2><?php echo __('Edit User'); ?></h2>
    <?php
        echo $this->Form->input('id');
        echo $this->Form->input('username');
        echo $this->Form->input('email');
        echo $this->Form->input('Subject', array('multiple' => true));
    ?>    
<?php echo $this->Form->end($twitterBootstrapEndOptions);?>
</div>
