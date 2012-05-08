<div class="subjects view">
<h2><?php  echo __('Subject');?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($subject['Subject']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($subject['Subject']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($subject['Subject']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($subject['Subject']['modified']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<?php echo $this->element('sidebar'); ?>
<div class="related">
    <h3><?php echo __('Related Questions');?></h3>
    <?php if (!empty($subject['Question'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php echo __('Id'); ?></th>
        <th><?php echo __('Subject Id'); ?></th>
        <th><?php echo __('Title'); ?></th>
        <th><?php echo __('Option 1'); ?></th>
        <th><?php echo __('Option 2'); ?></th>
        <th><?php echo __('Option 3'); ?></th>
        <th><?php echo __('Option 4'); ?></th>
        <th><?php echo __('Answer'); ?></th>
        <th><?php echo __('Created'); ?></th>
        <th><?php echo __('Modified'); ?></th>
        <th class="actions"><?php echo __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($subject['Question'] as $question): ?>
        <tr>
            <td><?php echo $question['id'];?></td>
            <td><?php echo $question['subject_id'];?></td>
            <td><?php echo $question['title'];?></td>
            <td><?php echo $question['option_1'];?></td>
            <td><?php echo $question['option_2'];?></td>
            <td><?php echo $question['option_3'];?></td>
            <td><?php echo $question['option_4'];?></td>
            <td><?php echo $question['answer'];?></td>
            <td><?php echo $question['created'];?></td>
            <td><?php echo $question['modified'];?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('controller' => 'questions', 'action' => 'view', $question['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('controller' => 'questions', 'action' => 'edit', $question['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'questions', 'action' => 'delete', $question['id']), null, __('Are you sure you want to delete # %s?', $question['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>
