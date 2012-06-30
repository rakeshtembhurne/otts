
<div class="">
  <?php  
  echo $this->Form->create('User', $twitterBootstrapCreateOptions);
  ?>
  <fieldset>
    <legend><?php echo __('Employee Add'); ?></legend>
    <?php
    echo $this->Form->input('email', array(
      'error' => array(
        'notempty' => __('Please enter email address'),         
        'email' => __('Please enter valid email address'),         
        'unique' => __('This email address already exist'),         
        )
      )
    );
    echo $this->Form->input('username', array(
      'error' => array(
        'notempty' => __('Please enter user name'),                          
        'unique' => __('This user name already exist'),         
        )
      )
    );
    echo $this->Form->input('password', array(
      'error' => array(
        'required' => __('Please enter password'),
        )
      )
    );
    echo $this->Form->input('password2', array(
      'label' => array(
        'class' => 'control-label', 
        'text' => 'Confirm password'
        ),
      'type' => 'password',
      'error' => array(
        'required' => __('Please confirm your password'),
        'confirm' => __('password could not matched'),
        )
      )
    );
    ?>
    <div class="form-actions">
    <?php 
    echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'div' => false)).'&nbsp;&nbsp; ';          
    echo $this->Html->link('Cancel', 
        array('action' => 'employee', 'admin' => true), 
        array('class' => 'btn btn-inverse')
    );
    ?>
    </div>
    <?php
    echo $this->Form->end();
    ?>
  </fieldset>
</div>