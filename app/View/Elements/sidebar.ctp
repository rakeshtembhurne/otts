<?php if ($userId = AuthComponent::user('id')): ?>
    <div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li>
                Manage Subjects
                <ul>
                    <li><?php echo $this->Html->link(__('List Subjects'), array('controller' => 'subjects', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__('New Subject'), array('controller' => 'subjects', 'action' => 'add')); ?> </li>
                </ul>
            </li>
            <li>
                Manage Candidates
                <ul>
                    <li><?php echo $this->Html->link(__('List Candidates'), array('controller' => 'candidates', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__('New Candidate'), array('controller' => 'candidates', 'action' => 'add')); ?> </li>
                </ul>
            </li>
            <li>
                Manage Questions
                <ul>
                    <li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
                </ul>
            </li>
            <li>
                Manage Tests
                <ul>
                    <li><?php echo $this->Html->link(__('List Tests'), array('controller' => 'tests', 'action' => 'index'));?></li>
                    <li><?php echo $this->Html->link(__('New Test'), array('controller' => 'tests', 'action' => 'add'));?></li>
                    <li><?php echo $this->Html->link(__('Take Test'), array('controller' => 'tests', 'action' => 'take_test'));?></li>
                </ul>
            </li>
            <li>
                Admin
                <ul>
                    <li><?php echo $this->Html->link(__('Change Password'), array('controller' => 'users', 'action' => 'edit', $userId));?></li>
                    <li><?php echo $this->Html->link(__('Log out'), array('controller' => 'users', 'action' => 'logout'));?></li>
                </ul>
            </li>
        </ul>
    </div>
<?php else: ?>
    <p class="pad_10">Please submit the code and start answering questions one by one. You can move to next or previous questions. </p>
<?php endif; ?>
