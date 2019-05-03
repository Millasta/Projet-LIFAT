<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LieuTravail[]|\Cake\Collection\CollectionInterface $lieuTravails
 */
?>
<div class="lieuTravails index large-9 medium-8 columns content">
    <h3><?= __('Lieux de travail')?> <font size="+1">[<?= $this->Html->link(__('Nouveau lieu de travail'), ['action' => 'edit']) ?>]</font> </h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_lieu') ?></th>
                <th scope="col"><?= $this->Paginator->sort('est_dans_liste') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lieuTravails as $lieuTravail): ?>
            <tr>
                <td><?= $this->Number->format($lieuTravail->id) ?></td>
                <td><?= h($lieuTravail->nom_lieu) ?></td>
                <td><?= $lieuTravail->est_dans_liste ? h("Oui") : h("Non"); ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Details'), ['action' => 'view', $lieuTravail->id]) ?>
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $lieuTravail->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $lieuTravail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lieuTravail->id)]) ?>
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
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} sur {{pages}}, affiche {{current}} lieu de travail sur {{count}}')]) ?></p>
        </div>
    </div>
