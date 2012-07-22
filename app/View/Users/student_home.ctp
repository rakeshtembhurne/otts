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

<div class="tests index">
    <h2><?php echo __('Tests');?></h2>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Tests</th>
            <th>Link</th>
            
    </tr>
    <?php
    foreach ($tests as $test): ?>
    <tr>
        <td><?php echo $test['Test']['name']; ?>&nbsp;</td>
        <td>
            <?php echo $this->Html->link($test['Test']['name'], array('controller' => 'tests', 'action' => 'test', $test['Test']['id'], 'student' => true)); ?>
        </td> 
        
    </tr>
<?php endforeach; ?>
    </table>
    <p>
    <?php
    echo $this->Paginator->counter(array(
    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
    ?>  </p>

    <div class="paging">
    <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
    </div>
</div>
<?php echo $this->element('sidebar'); ?>
