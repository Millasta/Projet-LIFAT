<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LieuTravail $lieuTravail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Lieu Travails'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Membres'), ['controller' => 'Membres', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Membre'), ['controller' => 'Membres', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lieuTravails form large-9 medium-8 columns content">
    <?= $this->Form->create($lieuTravail) ?>
    <fieldset>
        <legend><?= __('Add Lieu Travail') ?></legend>
        <?php
            echo $this->Form->control('nom_lieu');
            echo $this->Form->control('est_dans_liste');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
