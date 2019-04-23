<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Financement[]|\Cake\Collection\CollectionInterface $financements
 */

echo $this->element('navbar');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Financement'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projets'), ['controller' => 'Projets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Projet'), ['controller' => 'Projets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="financements index large-9 medium-8 columns content">
    <h3><?= __('Financements') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('international') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nationalite_financement') ?></th>
                <th scope="col"><?= $this->Paginator->sort('financement_prive') ?></th>
                <th scope="col"><?= $this->Paginator->sort('financement') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($financements as $financement): ?>
            <tr>
                <td><?= $this->Number->format($financement->id) ?></td>
                <td><?= h($financement->international) ?></td>
                <td><?= h($financement->nationalite_financement) ?></td>
                <td><?= h($financement->financement_prive) ?></td>
                <td><?= h($financement->financement) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $financement->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $financement->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $financement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $financement->id)]) ?>
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
