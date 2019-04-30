<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Membre[]|\Cake\Collection\CollectionInterface $membres
 */
?>
<div class="membres index large-9 medium-8 columns content">
    <h3><?= __('Membres du laboratoire')?> <font size="+1">[<?= $this->Html->link(__('Nouveau membre'), ['action' => 'edit']) ?>]</font> </h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('role') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prenom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_naissance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('actif') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lieu_travail_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('equipe_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nationalite') ?></th>
                <th scope="col"><?= $this->Paginator->sort('genre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hdr') ?></th>
                <th scope="col"><?= $this->Paginator->sort('permanent') ?></th>
                <th scope="col"><?= $this->Paginator->sort('est_porteur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_creation') ?></th>
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
                <td><?= h($membre->date_naissance) ?></td>
                <td><?= $membre->actif ? h("Oui") : h("Non"); ?></td>
                <td><?= $membre->has('lieu_travail') ? $this->Html->link($membre->lieu_travail->id, ['controller' => 'LieuTravails', 'action' => 'view', $membre->lieu_travail->id]) : '' ?></td>
                <td><?= $membre->has('equipe') ? $this->Html->link($membre->equipe->id, ['controller' => 'Equipes', 'action' => 'view', $membre->equipe->id]) : '' ?></td>
                <td><?= h($membre->nationalite) ?></td>
                <td><?= h($membre->genre) ?></td>
                <td><?= $membre->hdr ? h("Oui") : h("Non"); ?></td>
                <td><?= $membre->permanent ? h("Oui") : h("Non"); ?></td>
                <td><?= $membre->est_porteur ? h("Oui") : h("Non"); ?></td>
                <td><?= h($membre->date_creation) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Details'), ['action' => 'view', $membre->id]) ?>
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $membre->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $membre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $membre->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('début')) ?>
            <?= $this->Paginator->prev('< ' . __('précedente')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('suivante') . ' >') ?>
            <?= $this->Paginator->last(__('fin') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} sur {{pages}}, affiche {{current}} membres sur {{count}}')]) ?></p>
    </div>
</div>
