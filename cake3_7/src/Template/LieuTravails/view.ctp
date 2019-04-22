<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LieuTravail $lieuTravail
 */

echo $this->element('navbar');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Lieu Travail'), ['action' => 'edit', $lieuTravail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lieu Travail'), ['action' => 'delete', $lieuTravail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lieuTravail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Lieu Travails'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lieu Travail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Membres'), ['controller' => 'Membres', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Membre'), ['controller' => 'Membres', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lieuTravails view large-9 medium-8 columns content">
    <h3><?= h($lieuTravail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom Lieu') ?></th>
            <td><?= h($lieuTravail->nom_lieu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($lieuTravail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Est Dans Liste') ?></th>
            <td><?= $lieuTravail->est_dans_liste ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Membres') ?></h4>
        <?php if (!empty($lieuTravail->membres)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Role') ?></th>
                <th scope="col"><?= __('Nom') ?></th>
                <th scope="col"><?= __('Prenom') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Passwd') ?></th>
                <th scope="col"><?= __('Adresse Agent 1') ?></th>
                <th scope="col"><?= __('Adresse Agent 2') ?></th>
                <th scope="col"><?= __('Residence Admin 1') ?></th>
                <th scope="col"><?= __('Residence Admin 2') ?></th>
                <th scope="col"><?= __('Type Personnel') ?></th>
                <th scope="col"><?= __('Intitule') ?></th>
                <th scope="col"><?= __('Grade') ?></th>
                <th scope="col"><?= __('Im Vehicule') ?></th>
                <th scope="col"><?= __('Pf Vehicule') ?></th>
                <th scope="col"><?= __('Signature Name') ?></th>
                <th scope="col"><?= __('Login Cas') ?></th>
                <th scope="col"><?= __('Carte Sncf') ?></th>
                <th scope="col"><?= __('Matricule') ?></th>
                <th scope="col"><?= __('Date Naissance') ?></th>
                <th scope="col"><?= __('Actif') ?></th>
                <th scope="col"><?= __('Lieu Travail Id') ?></th>
                <th scope="col"><?= __('Nationalite') ?></th>
                <th scope="col"><?= __('Est Francais') ?></th>
                <th scope="col"><?= __('Genre') ?></th>
                <th scope="col"><?= __('Hdr') ?></th>
                <th scope="col"><?= __('Permanent') ?></th>
                <th scope="col"><?= __('Est Porteur') ?></th>
                <th scope="col"><?= __('Date Creation') ?></th>
                <th scope="col"><?= __('Date Sortie') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($lieuTravail->membres as $membres): ?>
            <tr>
                <td><?= h($membres->id) ?></td>
                <td><?= h($membres->role) ?></td>
                <td><?= h($membres->nom) ?></td>
                <td><?= h($membres->prenom) ?></td>
                <td><?= h($membres->email) ?></td>
                <td><?= h($membres->passwd) ?></td>
                <td><?= h($membres->adresse_agent_1) ?></td>
                <td><?= h($membres->adresse_agent_2) ?></td>
                <td><?= h($membres->residence_admin_1) ?></td>
                <td><?= h($membres->residence_admin_2) ?></td>
                <td><?= h($membres->type_personnel) ?></td>
                <td><?= h($membres->intitule) ?></td>
                <td><?= h($membres->grade) ?></td>
                <td><?= h($membres->im_vehicule) ?></td>
                <td><?= h($membres->pf_vehicule) ?></td>
                <td><?= h($membres->signature_name) ?></td>
                <td><?= h($membres->login_cas) ?></td>
                <td><?= h($membres->carte_sncf) ?></td>
                <td><?= h($membres->matricule) ?></td>
                <td><?= h($membres->date_naissance) ?></td>
                <td><?= h($membres->actif) ?></td>
                <td><?= h($membres->lieu_travail_id) ?></td>
                <td><?= h($membres->nationalite) ?></td>
                <td><?= h($membres->est_francais) ?></td>
                <td><?= h($membres->genre) ?></td>
                <td><?= h($membres->hdr) ?></td>
                <td><?= h($membres->permanent) ?></td>
                <td><?= h($membres->est_porteur) ?></td>
                <td><?= h($membres->date_creation) ?></td>
                <td><?= h($membres->date_sortie) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Membres', 'action' => 'view', $membres->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Membres', 'action' => 'edit', $membres->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Membres', 'action' => 'delete', $membres->id], ['confirm' => __('Are you sure you want to delete # {0}?', $membres->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
