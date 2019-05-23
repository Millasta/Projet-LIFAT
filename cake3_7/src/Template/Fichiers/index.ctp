<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fichier[]|\Cake\Collection\CollectionInterface $fichiers
 */
?>
<div class="fichiers index large-9 medium-8 columns content">
    <h3><?= __('Fichiers') ?><font size="+1">  [<?= $this->Html->link(__('Envoyer un fichier'), ['action' => 'add']) ?>]</font></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('nom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('titre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_upload') ?></th>
                <th scope="col"><?= $this->Paginator->sort('membre_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fichiers as $fichier): ?>
            <tr>
                <td><?= $this->Html->link($fichier->nom, $uploadfolder.$fichier->nom) ?></td>
                <td><?= h($fichier->titre) ?></td>
                <td><?= h($fichier->date_upload) ?></td>
                <td><?= $fichier->has('membre') ? $this->Html->link($fichier->membre->nom, ['controller' => 'Membres', 'action' => 'view', $fichier->membre->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Detail'), ['action' => 'view', $fichier->id]) ?>
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $fichier->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $fichier->id], ['confirm' => __('Confirmer la suppression du fichier {0} ?', $fichier->nom)]) ?>
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