<div class="span4 offset4">
  <?php  
  echo $this->Form->create('User', $inputDefaults);
  ?>
  <fieldset>
    <legend><?php echo __('Sign Up'); ?></legend>
    <?php
    echo $this->Form->input('email', array(
      'error' => array(
        'notempty' => __('Please enter email address'),         
        'email' => __('Please enter valid email address'),         
        'unique' => __('This email address already exist'),         
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
    echo $this->Form->input('invite_code', array(
      'error' => array(
        'notempty' => __('Please enter invite code'),
        'notexist' => __('You entered wrong invite code'),
        'expired' => __('Invite code has been expired'),
        'roomfull' => __('Room full for this invite code'),
        )
      )
    );
    echo $this->Form->end(
      array(
        'label' => __('Submit'),
        'class' => 'btn btn-primary',
        'div'  => array(
          'class' => 'form-actions'
        )
      )
    );
    ?>
  </fieldset>
</div>