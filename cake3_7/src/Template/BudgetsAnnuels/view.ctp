<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BudgetsAnnuel $budgetsAnnuel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Budgets Annuel'), ['action' => 'edit', $budgetsAnnuel->projet_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Budgets Annuel'), ['action' => 'delete', $budgetsAnnuel->projet_id], ['confirm' => __('Are you sure you want to delete # {0}?', $budgetsAnnuel->projet_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Budgets Annuels'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Budgets Annuel'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projets'), ['controller' => 'Projets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Projet'), ['controller' => 'Projets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="budgetsAnnuels view large-9 medium-8 columns content">
    <h3><?= h($budgetsAnnuel->projet_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Projet') ?></th>
            <td><?= $budgetsAnnuel->has('projet') ? $this->Html->link($budgetsAnnuel->projet->id, ['controller' => 'Projets', 'action' => 'view', $budgetsAnnuel->projet->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Annee') ?></th>
            <td><?= $this->Number->format($budgetsAnnuel->annee) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Budget') ?></th>
            <td><?= $this->Number->format($budgetsAnnuel->budget) ?></td>
        </tr>
    </table>
</div>
