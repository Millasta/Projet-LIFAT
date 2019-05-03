<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Projet $projet
 * @var \App\Model\Entity\Membre $membre
 */
?>


<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Modifier le projet'), ['action' => 'edit', $projet->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer le projet'), ['action' => 'delete', $projet->id], ['confirm' => __('Etes-vous sûr de vouloir supprimer le projet #{0}?', $projet->titre)]) ?> </li>
    </ul>
</nav>
<div class="projets view large-9 medium-8 columns content">
    <h3><?= h("Titre du projet : ".$projet->titre) ?></h3>
    <table class="vertical-table">
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
        <h4><?= __('Equipes associés') ?></h4>
        <?php if (!empty($projet->equipes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nom de l\'équipe') ?></th>
                <th scope="col"><?= __('Nom et prénom du responsable') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($projet->equipes as $equipes): ?>
            <tr>
                <td><?= h($equipes->id) ?></td>
                <td><?= h($equipes->nom_equipe) ?></td>
                <td><?= h($projet->responsables->nom." ".$projet->responsables->prenom) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Equipes', 'action' => 'view', $equipes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Equipes', 'action' => 'edit', $equipes->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
