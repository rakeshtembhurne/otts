<div class="student index">
	<h2><?php echo __('Student');?></h2>
    <?php
    echo $this->Form->create('User');
    echo $this->Form->input('email');
    echo $this->Form->submit('Search',array('class' => 'btn btn-info'));
    echo $this->Form->end();
    ?>
	<table class="table table-condensed table-striped table-bordered">
	<tr>			
		<th><?php echo $this->Paginator->sort('email');?></th>
		<th><?php echo $this->Paginator->sort('username');?></th>
		<th><?php echo $this->Paginator->sort('Tutorial & Test');?></th>
		<th><?php echo $this->Paginator->sort('Quiz');?></th>        
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($users as $user): ?>
	<tr>		
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>		
		<td><?php echo $this->Form->input('tnt', array('label' => false, 'id' => $user['User']['id'], 'class' => 'registeredTnt', 'type' => 'checkbox', 'default' => $user['User']['tnt'])); ?></td>
		<td><?php echo $this->Form->input('quiz', array('label' => false, 'id' => $user['User']['id'], 'class' => 'registeredQuiz', 'type' => 'checkbox', 'default' => $user['User']['quiz'])); ?></td>		       
		<td class="actions">			
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'], 'admin' => true), array('class' => 'btn btn-info btn-mini')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'student_edit', $user['User']['id']), array('class' => 'btn btn-success btn-mini')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('paging'); ?>
</div>

<script type="text/javascript">
$(function() {
    $('.registeredTnt').click(function(){
        var studentId = (this).id;
        var tnt = (this).checked;
        var data = 'tnt='+tnt+'&studentId='+studentId;
        $.ajax({
        	type:'POST',
        	data:data,
        	url:'approve_student',
        	success : function(data) {
               alert('process done');
        	}

        });
    });

    $('.registeredQuiz').click(function(){
        var studentId = (this).id;
        var quiz = (this).checked;
        var data = 'quiz='+quiz+'&studentId='+studentId;
        $.ajax({
        	type:'POST',
        	data:data,
        	url:'approve_student',
        	success : function(data) {
               alert('process done');
        	}

        });
    });

}); 
</script>