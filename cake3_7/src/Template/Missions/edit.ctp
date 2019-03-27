<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mission $mission
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mission->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mission->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Missions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Projets'), ['controller' => 'Projets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Projet'), ['controller' => 'Projets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lieus'), ['controller' => 'Lieus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lieus'), ['controller' => 'Lieus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Motifs'), ['controller' => 'Motifs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Motif'), ['controller' => 'Motifs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Transports'), ['controller' => 'Transports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transport'), ['controller' => 'Transports', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="missions form large-9 medium-8 columns content">
    <?= $this->Form->create($mission) ?>
    <fieldset>
        <legend><?= __('Edit Mission') ?></legend>
        <?php
            echo $this->Form->control('complement_motif');
            echo $this->Form->control('date_depart', ['empty' => true]);
            echo $this->Form->control('date_retour', ['empty' => true]);
            echo $this->Form->control('sans_frais');
            echo $this->Form->control('etat');
            echo $this->Form->control('nb_nuites');
            echo $this->Form->control('nb_repas');
            echo $this->Form->control('billet_agence');
            echo $this->Form->control('commentaire_transport');
            echo $this->Form->control('projet_id', ['options' => $projets, 'empty' => true]);
            echo $this->Form->control('lieu_id', ['options' => $lieus, 'empty' => true]);
            echo $this->Form->control('motif_id', ['options' => $motifs, 'empty' => true]);
            echo $this->Form->control('transports._ids', ['options' => $transports]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
