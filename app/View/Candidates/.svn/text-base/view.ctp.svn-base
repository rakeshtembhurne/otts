<div class="candidates view">
<h2><?php  echo __('Candidate');?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($candidate['Candidate']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($candidate['Candidate']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Email'); ?></dt>
        <dd>
            <?php echo h($candidate['Candidate']['email']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Experience Months'); ?></dt>
        <dd>
            <?php echo h($candidate['Candidate']['experience_months']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Experience Years'); ?></dt>
        <dd>
            <?php echo h($candidate['Candidate']['experience_years']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($candidate['Candidate']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($candidate['Candidate']['modified']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<?php echo $this->element('sidebar'); ?>
<div class="related">
    <h3><?php echo __('Related Tests');?></h3>
    <?php if (!empty($candidate['Test'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php echo __('Id'); ?></th>
        <th><?php echo __('Candidate Id'); ?></th>
        <th><?php echo __('Code'); ?></th>
        <th><?php echo __('Created'); ?></th>
        <th><?php echo __('Modified'); ?></th>
        <th class="actions"><?php echo __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($candidate['Test'] as $test): ?>
        <tr>
            <td><?php echo $test['id'];?></td>
            <td><?php echo $test['candidate_id'];?></td>
            <td><?php echo $test['code'];?></td>
            <td><?php echo $test['created'];?></td>
            <td><?php echo $test['modified'];?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('controller' => 'tests', 'action' => 'view', $test['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('controller' => 'tests', 'action' => 'edit', $test['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tests', 'action' => 'delete', $test['id']), null, __('Are you sure you want to delete # %s?', $test['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>
