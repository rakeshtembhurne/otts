<div class="tutorials index">
	<h2><?php echo __('Tutorials');?></h2>
	<div class="row">		
		<div class="span10">
			<table class="table table-striped table-condensed table-bordered">
				<tr>
						<th><?php echo $this->Paginator->sort('id');?></th>
						<th><?php echo $this->Paginator->sort('subject_id');?></th>
						<th><?php echo $this->Paginator->sort('name');?></th>									
						<th class="actions"><?php echo __('Actions');?></th>
				</tr>
				<?php
				foreach ($tutorials as $tutorial): ?>
				<tr>
					<td><?php echo h($tutorial['Tutorial']['id']); ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link($tutorial['Subject']['name'], array('controller' => 'subjects', 'action' => 'view', $tutorial['Subject']['id'])); ?>
					</td>
					<td>
						<strong><?php echo h($tutorial['Tutorial']['name']); ?></strong><br />
					</td>
					
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $tutorial['Tutorial']['id']), array('class' => 'btn btn-mini btn-info')); ?>
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tutorial['Tutorial']['id']), array('class' => 'btn btn-mini btn-success')); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tutorial['Tutorial']['id']), array('class' => 'btn btn-mini btn-danger'), __('Are you sure you want to delete # %s?', $tutorial['Tutorial']['id'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
				</table>
				<?php echo $this->element('paging'); ?>
		</div>
		<div class="span2">
			<h3>Select Subject</h3>
			<ul class="">
				<li><?php 
					echo $this->Html->link(
						'All',
						array('action' => 'index')
					);
				?></li>
				<?php foreach ($subjects as $subjectId => $subjectName) : ?>
					<li><?php 
						echo $this->Html->link(
							$subjectName,
							array('action' => 'index', $subjectId)
						);
					?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>


</div>

