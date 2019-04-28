<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Theses[]|\Cake\Collection\CollectionInterface $theses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Theses'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Membres'), ['controller' => 'Membres', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Membre'), ['controller' => 'Membres', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Dirigeants'), ['controller' => 'Dirigeants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Dirigeant'), ['controller' => 'Dirigeants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Encadrants'), ['controller' => 'Encadrants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Encadrant'), ['controller' => 'Encadrants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="theses index large-9 medium-8 columns content">
    <h3><?= __('Theses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sujet') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_debut') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_fin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('autre_info') ?></th>
                <th scope="col"><?= $this->Paginator->sort('auteur_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($theses as $theses): ?>
            <tr>
                <td><?= $this->Number->format($theses->id) ?></td>
                <td><?= h($theses->sujet) ?></td>
                <td><?= h($theses->type) ?></td>
                <td><?= h($theses->date_debut) ?></td>
                <td><?= h($theses->date_fin) ?></td>
                <td><?= h($theses->autre_info) ?></td>
                <td><?= $theses->has('membre') ? $this->Html->link($theses->membre->id, ['controller' => 'Membres', 'action' => 'view', $theses->membre->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $theses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $theses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $theses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $theses->id)]) ?>
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
