<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fichier $fichier
 */
?>
<div class="fichiers form large-9 medium-8 columns content">
    <?= $this->Form->create($fichier, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Ajouter un fichier PDF (<10Mo)') ?></legend>
        <?php
            echo $this->Form->control('nom', ['type' => 'file']);
            echo $this->Form->control('titre');
            echo $this->Form->control('description');
			echo $this->Form->control('membre_id', ['type' => 'hidden', 'value' => $user['id']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
