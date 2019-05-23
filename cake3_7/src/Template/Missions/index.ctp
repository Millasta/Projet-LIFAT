<?php
/**
 * @var AppView $this
 * @var Mission[]|CollectionInterface $missions
 */

use App\Model\Entity\Mission;
use App\View\AppView;
use Cake\Collection\CollectionInterface; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('New Mission'), ['action' => 'edit']) ?></li>
		<li><?= $this->Html->link(__('List Projets'), ['controller' => 'Projets', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Projet'), ['controller' => 'Projets', 'action' => 'edit']) ?></li>
		<li><?= $this->Html->link(__('List Lieus'), ['controller' => 'Lieus', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Lieus'), ['controller' => 'Lieus', 'action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Motifs'), ['controller' => 'Motifs', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Motif'), ['controller' => 'Motifs', 'action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Transports'), ['controller' => 'Transports', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Transport'), ['controller' => 'Transports', 'action' => 'add']) ?></li>
	</ul>
</nav>
<div class="missions index large-9 medium-8 columns content">
	<h3><?= __('Missions') ?></h3>
	<table cellpadding="0" cellspacing="0">
		<thead>
		<tr>
			<th scope="col"><?= $this->Paginator->sort('id') ?></th>
			<th scope="col"><?= $this->Paginator->sort('complement_motif') ?></th>
			<th scope="col"><?= $this->Paginator->sort('date_depart') ?></th>
			<th scope="col"><?= $this->Paginator->sort('date_retour') ?></th>
			<th scope="col"><?= $this->Paginator->sort('sans_frais') ?></th>
			<th scope="col"><?= $this->Paginator->sort('etat') ?></th>
			<th scope="col"><?= $this->Paginator->sort('nb_nuites') ?></th>
			<th scope="col"><?= $this->Paginator->sort('nb_repas') ?></th>
			<th scope="col"><?= $this->Paginator->sort('billet_agence') ?></th>
			<th scope="col"><?= $this->Paginator->sort('projet_id') ?></th>
			<th scope="col"><?= $this->Paginator->sort('lieu_id') ?></th>
			<th scope="col"><?= $this->Paginator->sort('motif_id') ?></th>
			<th scope="col" class="actions"><?= __('Actions') ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($missions as $mission): ?>
			<tr>
				<td><?= $this->Number->format($mission->id) ?></td>
				<td><?= h($mission->complement_motif) ?></td>
				<td><?= h($mission->date_depart) ?></td>
				<td><?= h($mission->date_retour) ?></td>
				<td><?= h($mission->sans_frais) ?></td>
				<td><?= h($mission->etat) ?></td>
				<td><?= $this->Number->format($mission->nb_nuites) ?></td>
				<td><?= $this->Number->format($mission->nb_repas) ?></td>
				<td><?= h($mission->billet_agence) ?></td>
				<td><?= $mission->has('projet') ? $this->Html->link($mission->projet->id, ['controller' => 'Projets', 'action' => 'view', $mission->projet->id]) : '' ?></td>
				<td><?= $mission->has('lieus') ? $this->Html->link($mission->lieus->id, ['controller' => 'Lieus', 'action' => 'view', $mission->lieus->id]) : '' ?></td>
				<td><?= $mission->has('motif') ? $this->Html->link($mission->motif->id, ['controller' => 'Motifs', 'action' => 'view', $mission->motif->id]) : '' ?></td>
				<td class="actions">
					<?= $this->Html->link(__('View'), ['action' => 'view', $mission->id]) ?>
					<?= $this->Html->link(__('Edit'), ['action' => 'edit', $mission->id]) ?>
					<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mission->id)]) ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<div class="paginator">
		<ul class="pagination">
			<?= $this->Paginator->first('<< ' . __('first')) ?>
			<?= $this->Paginator->prev('< ' . __('previous')) ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->next(__('next') . ' >') ?>
			<?= $this->Paginator->last(__('last') . ' >>') ?>
		</ul>
		<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
	</div>
</div>
