<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Financement $financement
 */
?>
<div class="financements form large-9 medium-8 columns content">
    <?= $this->Form->create($financement) ?>
    <fieldset>
        <legend><?= $financement->id==0 ? __('Ajout d\'un financement') : __('Edition d\'un financement');  ?></legend>
        <?php
            echo $this->Form->control('international');
            echo $this->Form->control('nationalite_financement');
            echo $this->Form->control('financement_prive');
            echo $this->Form->control('financement');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>
