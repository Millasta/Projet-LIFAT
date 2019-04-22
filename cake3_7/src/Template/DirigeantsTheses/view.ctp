<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DirigeantsThesis $dirigeantsThesis
 */

echo $this->element('navbar');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Dirigeants Thesis'), ['action' => 'edit', $dirigeantsThesis->dirigeant_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Dirigeants Thesis'), ['action' => 'delete', $dirigeantsThesis->dirigeant_id], ['confirm' => __('Are you sure you want to delete # {0}?', $dirigeantsThesis->dirigeant_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Dirigeants Theses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dirigeants Thesis'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Dirigeants'), ['controller' => 'Dirigeants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dirigeant'), ['controller' => 'Dirigeants', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Theses'), ['controller' => 'Theses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Thesis'), ['controller' => 'Theses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dirigeantsTheses view large-9 medium-8 columns content">
    <h3><?= h($dirigeantsThesis->dirigeant_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Dirigeant') ?></th>
            <td><?= $dirigeantsThesis->has('dirigeant') ? $this->Html->link($dirigeantsThesis->dirigeant->, ['controller' => 'Dirigeants', 'action' => 'view', $dirigeantsThesis->dirigeant->]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Thesis') ?></th>
            <td><?= $dirigeantsThesis->has('thesis') ? $this->Html->link($dirigeantsThesis->thesis->id, ['controller' => 'Theses', 'action' => 'view', $dirigeantsThesis->thesis->id]) : '' ?></td>
        </tr>
    </table>
</div>
