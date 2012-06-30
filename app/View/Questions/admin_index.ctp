<div class="questions index">
	<h2><?php echo __('Questions');?></h2>
	<div class="row">		
		<div class="span10">
			<table class="table table-striped table-condensed table-bordered">
				<tr>
						<th><?php echo $this->Paginator->sort('id');?></th>
						<th><?php echo $this->Paginator->sort('subject_id');?></th>
						<th><?php echo $this->Paginator->sort('title');?></th>			
						<th><?php echo $this->Paginator->sort('answer');?></th>
						<th class="actions"><?php echo __('Actions');?></th>
				</tr>
				<?php
				foreach ($questions as $question): ?>
				<tr>
					<td><?php echo h($question['Question']['id']); ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link($question['Subject']['name'], array('controller' => 'subjects', 'action' => 'view', $question['Subject']['id'])); ?>
					</td>
					<td>
						<strong><?php echo h($question['Question']['title']); ?></strong><br />
						<ol>
							<li><?php echo h($question['Question']['option_1']); ?></li>
							<li><?php echo h($question['Question']['option_2']); ?></2i>
							<li><?php echo h($question['Question']['option_3']); ?></li>
							<li><?php echo h($question['Question']['option_4']); ?></li>
						</ol>
					</td>
					<td><?php
			            $i = 0;
						foreach (unserialize($question['Question']['answer']) as $key => $answer) {
							
							if($i == 0) {
			                     if($answer) { echo $key; $i++;}
			                
							} else {
								 if($answer) { echo ', '.$key;}
							}
						
					} ?>&nbsp;</td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $question['Question']['id']), array('class' => 'btn btn-mini btn-info')); ?>
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $question['Question']['id']), array('class' => 'btn btn-mini btn-success')); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $question['Question']['id']), array('class' => 'btn btn-mini btn-danger'), __('Are you sure you want to delete # %s?', $question['Question']['id'])); ?>
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

