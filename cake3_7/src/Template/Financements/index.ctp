<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Financement[]|\Cake\Collection\CollectionInterface $financements
 */
?>
<div class="financements index large-9 medium-8 columns content">
    <h3><?= __('Financements du laboratoire') ?> <font size="+1">[<?= $this->Html->link(__('Nouveau financement'), ['action' => 'edit']) ?>]</font> </h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('international') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nationalite_financement') ?></th>
                <th scope="col"><?= $this->Paginator->sort('financement_prive') ?></th>
                <th scope="col"><?= $this->Paginator->sort('financement') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($financements as $financement): ?>
            <tr>
                <td><?= $this->Number->format($financement->id) ?></td>
                <td><?= $financement->international ? h('Oui') : h('Non'); ?></td>
                <td><?= h($financement->nationalite_financement) ?></td>
                <td><?= h($financement->financement_prive) ?></td>
                <td><?= h($financement->financement) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Details'), ['action' => 'view', $financement->id]) ?>
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $financement->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $financement->id], ['confirm' => __('Etes-vous sur de vouloir supprimer le financement #{0}?', $financement->id)]) ?>
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
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} sur {{pages}}, affiche {{current}} financement sur {{count}}')]) ?></p>
    </div>
</div>
