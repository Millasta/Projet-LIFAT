<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Financement $financement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Modifier le financement'), ['action' => 'edit', $financement->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer le financement'), ['action' => 'delete', $financement->id], ['confirm' => __('Etes-vous sur de vouloir supprimer le financement #{0}?', $financement->id)]) ?> </li>
    </ul>
</nav>
<div class="financements view large-9 medium-8 columns content">
    <h3><?= h('Financement') ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nationalite Financement') ?></th>
            <td><?= h($financement->nationalite_financement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Financement') ?></th>
            <td><?= h($financement->financement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($financement->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('International') ?></th>
            <td><?= $financement->international ? __('Oui') : __('Non'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Financement Prive') ?></th>
            <td><?= $financement->financement_prive ? __('Oui') : __('Non'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Projets financés') ?></h4>
        <?php if (!empty($financement->projets)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Titre') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Budget') ?></th>
                <th scope="col"><?= __('Date Debut') ?></th>
                <th scope="col"><?= __('Date Fin') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($financement->projets as $projets): ?>
            <tr>
                <td><?= h($projets->id) ?></td>
                <td><?= h($projets->titre) ?></td>
                <td><?= h($projets->description) ?></td>
                <td><?= h($projets->type) ?></td>
                <td><?= h($projets->budget) ?></td>
                <td><?= h($projets->date_debut) ?></td>
                <td><?= h($projets->date_fin) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Projets', 'action' => 'view', $projets->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Projets', 'action' => 'edit', $projets->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
