<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Thesis $thesis
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $thesis->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $thesis->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Theses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Membres'), ['controller' => 'Membres', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Membre'), ['controller' => 'Membres', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Dirigeants'), ['controller' => 'Dirigeants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Dirigeant'), ['controller' => 'Dirigeants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Encadrants'), ['controller' => 'Encadrants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Encadrant'), ['controller' => 'Encadrants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="theses form large-9 medium-8 columns content">
    <?= $this->Form->create($thesis) ?>
    <fieldset>
        <legend><?= __('Edit Thesis') ?></legend>
        <?php
            echo $this->Form->control('sujet');
            echo $this->Form->control('type');
            echo $this->Form->control('date_debut', ['empty' => true]);
            echo $this->Form->control('date_fin', ['empty' => true]);
            echo $this->Form->control('signature');
            echo $this->Form->control('auteur_id', ['options' => $membres, 'empty' => true]);
            echo $this->Form->control('dirigeants._ids', ['options' => $dirigeants]);
            echo $this->Form->control('encadrants._ids', ['options' => $encadrants]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
