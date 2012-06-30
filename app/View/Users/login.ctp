<?php echo $this->Html->link('New Student Registation', 
array('action' => 'signup'), 
array('class' => 'btn btn-info btn-large pull-right')
);?>
<div>
<?php echo $this->Session->flash('auth'); ?>
</div>
username:admin
password: 123456
<div class="">
	<h2>Login</h2>
	<?php echo $this->Form->create('User', $twitterBootstrapCreateOptions);?>
		   
	<?php
	    echo $this->Form->input('username');
	    echo $this->Form->input('password');
	?>
	<?php echo $this->Form->submit('Login', $twitterBootstrapEndOptions);?>	
	<?php echo $this->Form->end();?>	
</div>
