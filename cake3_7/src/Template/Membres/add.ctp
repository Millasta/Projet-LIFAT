<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Membre $membre
 */
?>
<?php
$optionsMembres = [
    'CHEFEQUIPE' => 'Chef d\'équipe',
    'SECRETARIAT' => 'Secretariat',
    'MEMBRE' => 'Membre'
];
$optionsGenre = [
    'H' => 'Homme',
    'F' => 'Femme'
];
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des membres'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des lieux de travail'), ['controller' => 'LieuTravails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nouveau lieu de travail'), ['controller' => 'LieuTravails', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="membres form large-9 medium-8 columns content">
    <?= $this->Form->create($membre) ?>
    <fieldset>
        <legend><?= __('Ajout d\'un Membre') ?></legend>
        <?php
            echo $this->Form->select('role', $optionsMembres);
            echo $this->Form->control('nom', ['empty' => false]);
            echo $this->Form->control('prenom', ['empty' => false]);
            echo $this->Form->control('email', ['empty' => false]);
            echo $this->Form->control('passwd', ['label' => "Mot de passe"]);
            echo $this->Form->control('adresse_agent_1', ['empty' => false]);
            echo $this->Form->control('adresse_agent_2');
            echo $this->Form->control('residence_admin_1', ['empty' => false]);
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
            echo $this->Form->control('lieu_travail_id', ['options' => $lieuTravails, 'empty' => false]);
            echo $this->Form->control('equipe_id', ['options' => $equipes, 'empty' => true]);
            echo $this->Form->control('nationalite');
            echo $this->Form->control('est_francais', ['label' => "Français"]);
            echo $this->Form->select('genre', $optionsGenre);
            echo $this->Form->control('hdr');
            echo $this->Form->control('permanent', ['label' => "Membre permanent"]);
            echo $this->Form->control('est_porteur', ['label' => "Membre porteur"]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>
