<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Projet $projet
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des projets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des financements'), ['controller' => 'Financements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nouveau financement'), ['controller' => 'Financements', 'action' => 'edit']) ?></li>
    </ul>
</nav>
<div class="projets form large-9 medium-8 columns content">
    <?= $this->Form->create($projet) ?>
    <fieldset>
        <legend><?= $projet->id==0 ? __('Ajout d\'un projet') : __('Edition d\'un projet');  ?></legend>
        <?php
            echo $this->Form->control('titre');
            echo $this->Form->control('description');
            echo $this->Form->control('type');
            echo $this->Form->control('budget');
            echo $this->Form->control('date_debut', ['empty' => true]);
            echo $this->Form->control('date_fin', ['empty' => true]);
            echo $this->Form->control('financement_id', ['options' => $financements, 'empty' => true]);
            echo $this->Form->control('equipes._ids', ['options' => $equipes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>
