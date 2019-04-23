<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Membre $membre
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $membre->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $membre->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des membres'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des lieux de travail'), ['controller' => 'LieuTravails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nouveau lieu de travail'), ['controller' => 'LieuTravails', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="membres form large-9 medium-8 columns content">
    <?= $this->Form->create($membre) ?>
    <fieldset>
        <legend><?= __('Edition d\'un membre') ?></legend>
        <?php
            echo $this->Form->control('role');
            echo $this->Form->control('nom');
            echo $this->Form->control('prenom');
            echo $this->Form->control('email');
            echo $this->Form->control('passwd');
            echo $this->Form->control('adresse_agent_1');
            echo $this->Form->control('adresse_agent_2');
            echo $this->Form->control('residence_admin_1');
            echo $this->Form->control('residence_admin_2');
            echo $this->Form->control('type_personnel');
            echo $this->Form->control('intitule');
            echo $this->Form->control('grade');
            echo $this->Form->control('im_vehicule');
            echo $this->Form->control('pf_vehicule');
            echo $this->Form->control('signature_name');
            echo $this->Form->control('login_cas');
            echo $this->Form->control('carte_sncf');
            echo $this->Form->control('matricule');
            echo $this->Form->control('date_naissance', ['empty' => true]);
            echo $this->Form->control('actif');
            echo $this->Form->control('lieu_travail_id', ['options' => $lieuTravails, 'empty' => true]);
            echo $this->Form->control('nationalite');
            echo $this->Form->control('est_francais');
            echo $this->Form->control('genre');
            echo $this->Form->control('hdr');
            echo $this->Form->control('permanent');
            echo $this->Form->control('est_porteur');
            echo $this->Form->control('date_creation', ['empty' => true]);
            echo $this->Form->control('date_sortie', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
