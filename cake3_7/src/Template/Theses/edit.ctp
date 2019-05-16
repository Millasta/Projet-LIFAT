<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Theses $theses
 */
?>
<div class="theses form large-9 medium-8 columns content">
	<?= $this->Form->create($theses) ?>
	<fieldset>
		<legend><?= __('Editer une thèse') ?></legend>
		<?php
			echo $this->Form->control('sujet');
			echo $this->Form->control('type');
			echo $this->Form->control('date_debut', ['empty' => true, 'type' => 'date']);
			echo $this->Form->control('date_fin', ['empty' => true]);
			echo $this->Form->control('autre_info');
			echo $this->Form->control('auteur_id', ['options' => $membres, 'empty' => true]);
			echo $this->Form->control('dirigeants._ids', ['options' => $membres]);
			echo $this->Form->control('encadrants._ids', ['options' => $membres]);
		?>
	</fieldset>
	<?= $this->Form->button(__('Envoyer')) ?>
	<?= $this->Form->end() ?>
</div>