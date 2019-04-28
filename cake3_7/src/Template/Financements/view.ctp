<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Financement $financement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Financement'), ['action' => 'edit', $financement->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Financement'), ['action' => 'delete', $financement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $financement->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Financements'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Financement'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projets'), ['controller' => 'Projets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Projet'), ['controller' => 'Projets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="financements view large-9 medium-8 columns content">
    <h3><?= h($financement->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nationalite Financement') ?></th>
            <td><?= h($financement->nationalite_financement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Financement') ?></th>
            <td><?= h($financement->financement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($financement->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('International') ?></th>
            <td><?= $financement->international ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Financement Prive') ?></th>
            <td><?= $financement->financement_prive ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Projets') ?></h4>
        <?php if (!empty($financement->projets)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Titre') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Budget') ?></th>
                <th scope="col"><?= __('Date Debut') ?></th>
                <th scope="col"><?= __('Date Fin') ?></th>
                <th scope="col"><?= __('Financement Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($financement->projets as $projets): ?>
            <tr>
                <td><?= h($projets->id) ?></td>
                <td><?= h($projets->titre) ?></td>
                <td><?= h($projets->description) ?></td>
                <td><?= h($projets->type) ?></td>
                <td><?= h($projets->budget) ?></td>
                <td><?= h($projets->date_debut) ?></td>
                <td><?= h($projets->date_fin) ?></td>
                <td><?= h($projets->financement_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Projets', 'action' => 'view', $projets->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Projets', 'action' => 'edit', $projets->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Projets', 'action' => 'delete', $projets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projets->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
