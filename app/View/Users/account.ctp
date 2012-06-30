<div class="users form well">
<?php echo $this->Form->create('User', $twitterBootstrapCreateOptions);?>    
        <h2><?php echo __('My Account'); ?></h2>
    <?php
        echo $this->Form->input('id');
        echo $this->Form->input('username', array('readonly' => true));
        echo $this->Form->input('email', array('readonly' => true));
        echo $this->Form->input('firstname', array(
            'error' => array(
                'notempty' => __('Please enter firstname'),
            )
        ));
        echo $this->Form->input('lastname', array(
            'error' => array(
                'notempty' => __('Please enter lastname'),
            )
        ));
        echo $this->Form->input('dob', array(		   
		    'type' => 'date',
		    'dateFormat' => 'DMY',
		    'minYear' => date('Y') - 70,
		    'maxYear' => date('Y') - 18,
		    'class' => 'span1',
		));

        echo $this->Form->input('mobile', array(
            'error' => array(
                'notempty' => __('Please enter mobile number'),
            )
        ));
        echo $this->Form->input('address');       
        echo $this->Form->input('pincode');
    ?>    
<?php echo $this->Form->end($twitterBootstrapEndOptions);?>
</div>
