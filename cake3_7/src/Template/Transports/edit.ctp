<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transport $transport
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $transport->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $transport->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Transports'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transports form large-9 medium-8 columns content">
    <?= $this->Form->create($transport) ?>
    <fieldset>
        <legend><?= __('Edit Transport') ?></legend>
        <?php
            echo $this->Form->control('type_transport');
            echo $this->Form->control('im_vehicule');
            echo $this->Form->control('pf_vehicule');
            echo $this->Form->control('missions._ids', ['options' => $missions]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
