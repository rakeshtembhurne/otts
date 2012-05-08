<div class="tests view">
<h2><?php  echo __('Test');?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($test['Test']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Candidate'); ?></dt>
        <dd>
            <?php echo $this->Html->link($test['Candidate']['name'], array('controller' => 'candidates', 'action' => 'view', $test['Candidate']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Code'); ?></dt>
        <dd>
            <?php echo h($test['Test']['code']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($test['Test']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Submitted'); ?></dt>
        <dd>
            <?php echo h($test['Test']['modified']); ?>
            &nbsp;
        </dd>
        <?php if ($test['Test']['started'] != null): ?>
        <dt><?php echo __('Score'); ?></dt>
        <dd>
            <?php echo h($score['totalScore'].'/'. $score['totalQuestions']); ?>
            &nbsp;
        </dd>
        <?php endif; ?>
    </dl>

    <?php foreach($test['TestQuestion'] as $count => $que): ?>
        <br /><br />
        <h4><strong>Que <?php echo ++$count.': ';?></strong><?php echo $que['title'];?></h4>
        <ul>
            <?php
                for($i = 1; $i <= 4; $i++) {
                    $liData = '<li>'.$que["option_{$i}"];

                    if ($que['selected_option'] == $i) {
                        $liData .= ' [selected]';
                    }

                    if ($que['answer'] == $i) {
                        $liData .= ' [answer]';
                    }

                    $liData .= '</li>';
                    echo $liData;
                }
            ?>
        </ul>
    <?php endforeach; ?>
</div>
<?php echo $this->element('sidebar'); ?>
<div class="related">
    <h3><?php echo __('Related Test Questions');?></h3>
    <?php if (!empty($test['TestQuestion'])):?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php echo __('Id'); ?></th>
        <th><?php echo __('Test Id'); ?></th>
        <th><?php echo __('Title'); ?></th>
        <th><?php echo __('Option 1'); ?></th>
        <th><?php echo __('Option 2'); ?></th>
        <th><?php echo __('Option 3'); ?></th>
        <th><?php echo __('Option 4'); ?></th>
        <th><?php echo __('Answer'); ?></th>
        <th><?php echo __('Selected Option'); ?></th>
        <th><?php echo __('Subject'); ?></th>
        <th><?php echo __('Created'); ?></th>
        <th><?php echo __('Modified'); ?></th>
        <th class="actions"><?php echo __('Actions');?></th>
    </tr>
    <?php
        $i = 0;
        foreach ($test['TestQuestion'] as $testQuestion): ?>
        <tr>
            <td><?php echo $testQuestion['id'];?></td>
            <td><?php echo $testQuestion['test_id'];?></td>
            <td><?php echo $testQuestion['title'];?></td>
            <td><?php echo $testQuestion['option_1'];?></td>
            <td><?php echo $testQuestion['option_2'];?></td>
            <td><?php echo $testQuestion['option_3'];?></td>
            <td><?php echo $testQuestion['option_4'];?></td>
            <td><?php echo $testQuestion['answer'];?></td>
            <td><?php echo $testQuestion['selected_option'];?></td>
            <td><?php echo $testQuestion['subject'];?></td>
            <td><?php echo $testQuestion['created'];?></td>
            <td><?php echo $testQuestion['modified'];?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('controller' => 'test_questions', 'action' => 'view', $testQuestion['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('controller' => 'test_questions', 'action' => 'edit', $testQuestion['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'test_questions', 'action' => 'delete', $testQuestion['id']), null, __('Are you sure you want to delete # %s?', $testQuestion['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>
