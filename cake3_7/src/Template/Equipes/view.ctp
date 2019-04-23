<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Equipe $equipe
 */

echo $this->element('navbar');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Equipe'), ['action' => 'edit', $equipe->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Equipe'), ['action' => 'delete', $equipe->id], ['confirm' => __('Are you sure you want to delete # {0}?', $equipe->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Equipes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipe'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Membres'), ['controller' => 'Membres', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Membre'), ['controller' => 'Membres', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Equipes Responsables'), ['controller' => 'EquipesResponsables', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipes Responsable'), ['controller' => 'EquipesResponsables', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projets'), ['controller' => 'Projets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Projet'), ['controller' => 'Projets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="equipes view large-9 medium-8 columns content">
    <h3><?= h($equipe->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom Equipe') ?></th>
            <td><?= h($equipe->nom_equipe) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Membre') ?></th>
            <td><?= $equipe->has('membre') ? $this->Html->link($equipe->membre->id, ['controller' => 'Membres', 'action' => 'view', $equipe->membre->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($equipe->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Projets') ?></h4>
        <?php if (!empty($equipe->projets)): ?>
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
            <?php foreach ($equipe->projets as $projets): ?>
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
    <div class="related">
        <h4><?= __('Related Equipes Responsables') ?></h4>
        <?php if (!empty($equipe->equipes_responsables)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Equipe Id') ?></th>
                <th scope="col"><?= __('Responsable Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($equipe->equipes_responsables as $equipesResponsables): ?>
            <tr>
                <td><?= h($equipesResponsables->equipe_id) ?></td>
                <td><?= h($equipesResponsables->responsable_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EquipesResponsables', 'action' => 'view', $equipesResponsables->equipe_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EquipesResponsables', 'action' => 'edit', $equipesResponsables->equipe_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EquipesResponsables', 'action' => 'delete', $equipesResponsables->equipe_id], ['confirm' => __('Are you sure you want to delete # {0}?', $equipesResponsables->equipe_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
