<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Membre $membre
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Membre'), ['action' => 'edit', $membre->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Membre'), ['action' => 'delete', $membre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $membre->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Membres'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Membre'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lieu Travails'), ['controller' => 'LieuTravails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lieu Travail'), ['controller' => 'LieuTravails', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="membres view large-9 medium-8 columns content">
    <h3><?= h($membre->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= h($membre->role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nom') ?></th>
            <td><?= h($membre->nom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prenom') ?></th>
            <td><?= h($membre->prenom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($membre->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Passwd') ?></th>
            <td><?= h($membre->passwd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adresse Agent 1') ?></th>
            <td><?= h($membre->adresse_agent_1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adresse Agent 2') ?></th>
            <td><?= h($membre->adresse_agent_2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Residence Admin 1') ?></th>
            <td><?= h($membre->residence_admin_1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Residence Admin 2') ?></th>
            <td><?= h($membre->residence_admin_2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Personnel') ?></th>
            <td><?= h($membre->type_personnel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Intitule') ?></th>
            <td><?= h($membre->intitule) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grade') ?></th>
            <td><?= h($membre->grade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Im Vehicule') ?></th>
            <td><?= h($membre->im_vehicule) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Signature Name') ?></th>
            <td><?= h($membre->signature_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Login Cas') ?></th>
            <td><?= h($membre->login_cas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Carte Sncf') ?></th>
            <td><?= h($membre->carte_sncf) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lieu Travail') ?></th>
            <td><?= $membre->has('lieu_travail') ? $this->Html->link($membre->lieu_travail->id, ['controller' => 'LieuTravails', 'action' => 'view', $membre->lieu_travail->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nationalite') ?></th>
            <td><?= h($membre->nationalite) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Genre') ?></th>
            <td><?= h($membre->genre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($membre->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pf Vehicule') ?></th>
            <td><?= $this->Number->format($membre->pf_vehicule) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Matricule') ?></th>
            <td><?= $this->Number->format($membre->matricule) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Naissance') ?></th>
            <td><?= h($membre->date_naissance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Creation') ?></th>
            <td><?= h($membre->date_creation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Sortie') ?></th>
            <td><?= h($membre->date_sortie) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Actif') ?></th>
            <td><?= $membre->actif ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Est Francais') ?></th>
            <td><?= $membre->est_francais ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hdr') ?></th>
            <td><?= $membre->hdr ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Permanent') ?></th>
            <td><?= $membre->permanent ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Est Porteur') ?></th>
            <td><?= $membre->est_porteur ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
