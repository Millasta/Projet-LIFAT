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
<div class="membres form large-9 medium-8 columns content">
	<?php $membre->passwd = "" ?>
    <?= $this->Form->create($membre) ?>
    <fieldset>
        <legend><?= $membre->id==0 ? __('Ajout d\'un membre') : __('Edition d\'un membre');  ?></legend>
        <?php
        echo $this->Form->select('role', $optionsMembres);
        echo $this->Form->control('nom');
        echo $this->Form->control('prenom');
        echo $this->Form->control('email');
        echo $this->Form->control('passwd', ['label' => "Mot de passe"]);
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
        echo $this->Form->control('date_naissance', ['empty' => true, 'minYear' => 1901, 'maxYear' => 2019]);
        echo $this->Form->control('actif');
        echo $this->Form->control('lieu_travail_id', ['options' => $lieuTravails, 'empty' => false, 'label' => "lieu de travail"]);
        echo $this->Form->control('equipe_id', ['options' => $equipes, 'empty' => true]);
        echo $this->Form->control('nationalite');
        echo $this->Form->control('est_francais');
        echo $this->Form->select('genre', $optionsGenre);
        echo $this->Form->control('hdr');
        echo $this->Form->control('permanent', ['label' => "Membre permanent"]);
        echo $this->Form->control('est_porteur', ['label' => "Membre porteur"]);
    ?>
</fieldset>
<?= $this->Form->button(__('Valider')) ?>
<?= $this->Form->end() ?>
</div>
