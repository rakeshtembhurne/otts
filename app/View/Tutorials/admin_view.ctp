<div class="tutorials view">
	<h2><?php echo h($tutorial['Tutorial']['name']); ?></h2>
	<p><emp>Subject: <?php echo $this->Html->link($tutorial['Subject']['name'], array('controller' => 'subjects', 'action' => 'view', $tutorial['Subject']['id'])); ?></em></p>
	<div>
		<?php echo $tutorial['Tutorial']['content']; ?>
	</div>
</div>

<?php echo $this->element('sidebar'); ?>
