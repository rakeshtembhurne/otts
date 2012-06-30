<div class="subjects view">
<h2><?php  echo __('Subject');?></h2>
    <dl>
        <dt class="span3"><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($subject['Subject']['id']); ?>
            &nbsp;
        </dd>
        <dt class="span3"><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($subject['Subject']['name']); ?>
            &nbsp;
        </dd>
        <dt class="span3"><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($subject['Course']['name']); ?>
            &nbsp;
        </dd>
        <dt class="span3"><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($subject['Subject']['created']); ?>
            &nbsp;
        </dd>
        <dt class="span3"><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($subject['Subject']['modified']); ?>
            &nbsp;
        </dd>
    </dl>
</div>

