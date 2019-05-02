<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Equipe $equipe
 */
?>
<div class="equipes form large-9 medium-8 columns content">
    <?= $this->Form->create($equipe) ?>
    <fieldset>
        <legend><?= __('Editer une équipe') ?></legend>
        <?php
            echo $this->Form->control('nom_equipe', ['label' => 'Nom']);
            echo $this->Form->control('responsable_id', ['options' => $membres, 'empty' => true]);
            echo $this->Form->control('projets._ids', ['options' => $projets]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
