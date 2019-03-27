<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Membre[]|\Cake\Collection\CollectionInterface $membres
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Membre'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lieu Travails'), ['controller' => 'LieuTravails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lieu Travail'), ['controller' => 'LieuTravails', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="membres index large-9 medium-8 columns content">
    <h3><?= __('Membres') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('role') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prenom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('passwd') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adresse_agent_1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adresse_agent_2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('residence_admin_1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('residence_admin_2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_personnel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('intitule') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grade') ?></th>
                <th scope="col"><?= $this->Paginator->sort('im_vehicule') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pf_vehicule') ?></th>
                <th scope="col"><?= $this->Paginator->sort('signature_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('login_cas') ?></th>
                <th scope="col"><?= $this->Paginator->sort('carte_sncf') ?></th>
                <th scope="col"><?= $this->Paginator->sort('matricule') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_naissance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('actif') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lieu_travail_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nationalite') ?></th>
                <th scope="col"><?= $this->Paginator->sort('est_francais') ?></th>
                <th scope="col"><?= $this->Paginator->sort('genre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hdr') ?></th>
                <th scope="col"><?= $this->Paginator->sort('permanent') ?></th>
                <th scope="col"><?= $this->Paginator->sort('est_porteur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_creation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_sortie') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($membres as $membre): ?>
            <tr>
                <td><?= $this->Number->format($membre->id) ?></td>
                <td><?= h($membre->role) ?></td>
                <td><?= h($membre->nom) ?></td>
                <td><?= h($membre->prenom) ?></td>
                <td><?= h($membre->email) ?></td>
                <td><?= h($membre->passwd) ?></td>
                <td><?= h($membre->adresse_agent_1) ?></td>
                <td><?= h($membre->adresse_agent_2) ?></td>
                <td><?= h($membre->residence_admin_1) ?></td>
                <td><?= h($membre->residence_admin_2) ?></td>
                <td><?= h($membre->type_personnel) ?></td>
                <td><?= h($membre->intitule) ?></td>
                <td><?= h($membre->grade) ?></td>
                <td><?= h($membre->im_vehicule) ?></td>
                <td><?= $this->Number->format($membre->pf_vehicule) ?></td>
                <td><?= h($membre->signature_name) ?></td>
                <td><?= h($membre->login_cas) ?></td>
                <td><?= h($membre->carte_sncf) ?></td>
                <td><?= $this->Number->format($membre->matricule) ?></td>
                <td><?= h($membre->date_naissance) ?></td>
                <td><?= h($membre->actif) ?></td>
                <td><?= $membre->has('lieu_travail') ? $this->Html->link($membre->lieu_travail->id, ['controller' => 'LieuTravails', 'action' => 'view', $membre->lieu_travail->id]) : '' ?></td>
                <td><?= h($membre->nationalite) ?></td>
                <td><?= h($membre->est_francais) ?></td>
                <td><?= h($membre->genre) ?></td>
                <td><?= h($membre->hdr) ?></td>
                <td><?= h($membre->permanent) ?></td>
                <td><?= h($membre->est_porteur) ?></td>
                <td><?= h($membre->date_creation) ?></td>
                <td><?= h($membre->date_sortie) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $membre->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $membre->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $membre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $membre->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
