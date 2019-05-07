<div id="searchbar" class="large-9 medium-8" style="float: right">	<!--	TODO : css - faire marcher style_lifat.css	-->
	<?php
	echo $this->Form->create(null, ['valueSources' => 'query']);
	//	Le paramètre de recherche dans la classe Table correspondante doit se nommer 'Recherche'
	echo $this->Form->control('Recherche', [
		'label' => 'Recherche (nom ou prénom) :'
	]);
	echo $this->Form->button('Filtrer', ['type' => 'submit']);
	echo ' ';
	if ($this->Search->isSearch()) {
		echo $this->Search->resetLink(__('Réinitialiser'), ['class' => 'button']);
	}
	echo $this->Form->end();
	?>
</div>