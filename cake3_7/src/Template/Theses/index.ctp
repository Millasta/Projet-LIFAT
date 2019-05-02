<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Theses[]|\Cake\Collection\CollectionInterface $theses
 */
?>
<div class="theses index columns content">
    <h3><?= __('Thèses') ?><font size="+1">  [<?= $this->Html->link(__('Nouvelle thèse'), ['action' => 'edit']) ?>]</font></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Sujet') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Date de début') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Date de fin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Auteur') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($theses as $theses): ?>
            <tr>
                <td><?= h($theses->sujet) ?></td>
                <td><?= h($theses->type) ?></td>
                <td><?= h($theses->date_debut) ?></td>
                <td><?= h($theses->date_fin) ?></td>
                <td><?= $theses->has('membre') ? $this->Html->link($theses->membre->nom." ".$theses->membre->prenom, ['controller' => 'Membres', 'action' => 'view', $theses->membre->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Details'), ['action' => 'view', $theses->id]) ?>
                    <?= $this->Html->link(__('Editer'), ['action' => 'edit', $theses->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $theses->id], ['confirm' => __('Confirmer la suppression de la thèse "{0}" ?', $theses->sujet)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('début')) ?>
            <?= $this->Paginator->prev('< ' . __('précédent')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('suivant') . ' >') ?>
            <?= $this->Paginator->last(__('dernier') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} sur {{pages}}, {{current}} entrée(s) sur {{count}} au total')]) ?></p>
    </div>
</div>
