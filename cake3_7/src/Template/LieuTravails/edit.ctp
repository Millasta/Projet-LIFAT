<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LieuTravail $lieuTravail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des lieux de travail'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des membres'), ['controller' => 'Membres', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="lieuTravails form large-9 medium-8 columns content">
    <?= $this->Form->create($lieuTravail) ?>
    <fieldset>
        <legend><?= $lieuTravail->id==0 ? __('Ajout d\'un lieu de travail') : __('Edition d\'un lieu de travail');  ?></legend>
        <?php
            echo $this->Form->control('nom_lieu');
            echo $this->Form->control('est_dans_liste');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>
