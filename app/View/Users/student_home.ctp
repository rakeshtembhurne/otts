<div class="student home">
	<h2>Welcome</h2>
	<?php if (empty($user['User']['firstname'])) { ?>
		<div class="alert alert-error"><b>
			<?php
			echo 'Please update your profile';
	        ?>
	    <b></div>
     <?php 	} ?>
</div>

 <div class="form-actions">
    <?php 
    if ($user['User']['tnt']) { 
        echo $this->Html->link('Tutorial & Test',
            array('controller' => 'boards', 'action' => 'index', 'student' => true),
            array('class' => 'btn btn-info btn-large span3 well', 'div' => false, 'style' => 'width:200px;padding:50px;font-weight:bold;font-size:20px')
        ).'&nbsp;&nbsp; ';          
    }
    if ($user['User']['quiz']) {
        echo $this->Html->link('Quiz Contest', 
            array('controller' => 'tests', 'action' => 'quiz', 'student' => true), 
            array('class' => 'btn btn-inverse btn-large span3 well', 'style' => 'width:200px;padding:50px;font-weight:bold;font-size:20px')
        );
    }
    ?>
</div>