<?php
/**
 * @var AppView $this
 * @var BudgetsAnnuel[]|CollectionInterface $budgetsAnnuels
 */

use App\Model\Entity\BudgetsAnnuel;
use App\View\AppView;
use Cake\Collection\CollectionInterface; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('New Budgets Annuel'), ['action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Projets'), ['controller' => 'Projets', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Projet'), ['controller' => 'Projets', 'action' => 'add']) ?></li>
	</ul>
</nav>
<div class="budgetsAnnuels index large-9 medium-8 columns content">
	<h3><?= __('Budgets Annuels') ?></h3>
	<table cellpadding="0" cellspacing="0">
		<thead>
		<tr>
			<th scope="col"><?= $this->Paginator->sort('projet_id') ?></th>
			<th scope="col"><?= $this->Paginator->sort('annee') ?></th>
			<th scope="col"><?= $this->Paginator->sort('budget') ?></th>
			<th scope="col" class="actions"><?= __('Actions') ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($budgetsAnnuels as $budgetsAnnuel): ?>
			<tr>
				<td><?= $budgetsAnnuel->has('projet') ? $this->Html->link($budgetsAnnuel->projet->id, ['controller' => 'Projets', 'action' => 'view', $budgetsAnnuel->projet->id]) : '' ?></td>
				<td><?= $this->Number->format($budgetsAnnuel->annee) ?></td>
				<td><?= $this->Number->format($budgetsAnnuel->budget) ?></td>
				<td class="actions">
					<?= $this->Html->link(__('View'), ['action' => 'view', $budgetsAnnuel->projet_id]) ?>
					<?= $this->Html->link(__('Edit'), ['action' => 'edit', $budgetsAnnuel->projet_id]) ?>
					<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $budgetsAnnuel->projet_id], ['confirm' => __('Are you sure you want to delete # {0}?', $budgetsAnnuel->projet_id)]) ?>
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
