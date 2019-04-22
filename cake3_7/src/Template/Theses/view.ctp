<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Thesis $thesis
 */

echo $this->element('navbar');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Thesis'), ['action' => 'edit', $thesis->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Thesis'), ['action' => 'delete', $thesis->id], ['confirm' => __('Are you sure you want to delete # {0}?', $thesis->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Theses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Thesis'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Membres'), ['controller' => 'Membres', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Membre'), ['controller' => 'Membres', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Dirigeants'), ['controller' => 'Dirigeants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dirigeant'), ['controller' => 'Dirigeants', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Encadrants'), ['controller' => 'Encadrants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Encadrant'), ['controller' => 'Encadrants', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="theses view large-9 medium-8 columns content">
    <h3><?= h($thesis->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Sujet') ?></th>
            <td><?= h($thesis->sujet) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($thesis->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Signature') ?></th>
            <td><?= h($thesis->signature) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Membre') ?></th>
            <td><?= $thesis->has('membre') ? $this->Html->link($thesis->membre->id, ['controller' => 'Membres', 'action' => 'view', $thesis->membre->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($thesis->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Debut') ?></th>
            <td><?= h($thesis->date_debut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Fin') ?></th>
            <td><?= h($thesis->date_fin) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Dirigeants') ?></h4>
        <?php if (!empty($thesis->dirigeants)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Dirigeant Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($thesis->dirigeants as $dirigeants): ?>
            <tr>
                <td><?= h($dirigeants->dirigeant_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Dirigeants', 'action' => 'view', $dirigeants->]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Dirigeants', 'action' => 'edit', $dirigeants->]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Dirigeants', 'action' => 'delete', $dirigeants->], ['confirm' => __('Are you sure you want to delete # {0}?', $dirigeants->)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Encadrants') ?></h4>
        <?php if (!empty($thesis->encadrants)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Encadrant Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($thesis->encadrants as $encadrants): ?>
            <tr>
                <td><?= h($encadrants->encadrant_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Encadrants', 'action' => 'view', $encadrants->]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Encadrants', 'action' => 'edit', $encadrants->]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Encadrants', 'action' => 'delete', $encadrants->], ['confirm' => __('Are you sure you want to delete # {0}?', $encadrants->)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
