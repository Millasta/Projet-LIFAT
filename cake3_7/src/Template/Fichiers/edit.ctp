<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fichier $fichier
 */
?>
<div class="fichiers form large-9 medium-8 columns content">
    <?= $this->Form->create($fichier) ?>
    <fieldset>
        <legend><?= __('Edit Fichier') ?></legend>
        <?php
            echo $this->Form->control('nom');
            echo $this->Form->control('titre');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Sauvegarder')) ?>
    <?= $this->Form->end() ?>
</div>
