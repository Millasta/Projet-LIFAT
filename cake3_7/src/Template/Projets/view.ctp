<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Projet $projet
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Projet'), ['action' => 'edit', $projet->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Projet'), ['action' => 'delete', $projet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projet->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Projets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Projet'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Financements'), ['controller' => 'Financements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Financement'), ['controller' => 'Financements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Equipes'), ['controller' => 'Equipes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipe'), ['controller' => 'Equipes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="projets view large-9 medium-8 columns content">
    <h3><?= h($projet->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Titre') ?></th>
            <td><?= h($projet->titre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($projet->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($projet->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Financement') ?></th>
            <td><?= $projet->has('financement') ? $this->Html->link($projet->financement->id, ['controller' => 'Financements', 'action' => 'view', $projet->financement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($projet->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Budget') ?></th>
            <td><?= $this->Number->format($projet->budget) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Debut') ?></th>
            <td><?= h($projet->date_debut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Fin') ?></th>
            <td><?= h($projet->date_fin) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Equipes') ?></h4>
        <?php if (!empty($projet->equipes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nom Equipe') ?></th>
                <th scope="col"><?= __('Responsable Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($projet->equipes as $equipes): ?>
            <tr>
                <td><?= h($equipes->id) ?></td>
                <td><?= h($equipes->nom_equipe) ?></td>
                <td><?= h($equipes->responsable_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Equipes', 'action' => 'view', $equipes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Equipes', 'action' => 'edit', $equipes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Equipes', 'action' => 'delete', $equipes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $equipes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Missions') ?></h4>
        <?php if (!empty($projet->missions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Complement Motif') ?></th>
                <th scope="col"><?= __('Date Depart') ?></th>
                <th scope="col"><?= __('Date Retour') ?></th>
                <th scope="col"><?= __('Sans Frais') ?></th>
                <th scope="col"><?= __('Etat') ?></th>
                <th scope="col"><?= __('Nb Nuites') ?></th>
                <th scope="col"><?= __('Nb Repas') ?></th>
                <th scope="col"><?= __('Billet Agence') ?></th>
                <th scope="col"><?= __('Commentaire Transport') ?></th>
                <th scope="col"><?= __('Projet Id') ?></th>
                <th scope="col"><?= __('Lieu Id') ?></th>
                <th scope="col"><?= __('Motif Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($projet->missions as $missions): ?>
            <tr>
                <td><?= h($missions->id) ?></td>
                <td><?= h($missions->complement_motif) ?></td>
                <td><?= h($missions->date_depart) ?></td>
                <td><?= h($missions->date_retour) ?></td>
                <td><?= h($missions->sans_frais) ?></td>
                <td><?= h($missions->etat) ?></td>
                <td><?= h($missions->nb_nuites) ?></td>
                <td><?= h($missions->nb_repas) ?></td>
                <td><?= h($missions->billet_agence) ?></td>
                <td><?= h($missions->commentaire_transport) ?></td>
                <td><?= h($missions->projet_id) ?></td>
                <td><?= h($missions->lieu_id) ?></td>
                <td><?= h($missions->motif_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Missions', 'action' => 'view', $missions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Missions', 'action' => 'edit', $missions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Missions', 'action' => 'delete', $missions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $missions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
