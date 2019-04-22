<table align="right">
	<tr>
		<td>
			<?= $this->Html->link(__('Membres'), ['controller' => 'membres', 'action' => 'index']) ?>
		</td>
		<td>
			<?= $this->Html->link(__('Équipes'), ['controller' => 'equipes', 'action' => 'index']) ?>
		</td>
		<td>
			<?= $this->Html->link(__('Missions'), ['controller' => 'missions', 'action' => 'index']) ?>
		</td>
		<td>
			<?= $this->Html->link(__('Projets'), ['controller' => 'projets', 'action' => 'index']) ?>
		</td>
		<td>
			<?= $this->Html->link(__('Thèses'), ['controller' => 'theses', 'action' => 'index']) ?>
		</td>
		<td>
			<?= $this->Html->link(__('Lieux'), ['controller' => 'lieux', 'action' => 'index']) ?>
		</td>
		<td>
			<?= $this->Html->link(__('Transports'), ['controller' => 'transports', 'action' => 'index']) ?>
		</td>
		<td>
			<?= $this->Html->link(__('Motifs'), ['controller' => 'motifs', 'action' => 'index']) ?>
		</td>
		<td>
			<?= $this->Html->link(__('Financements'), ['controller' => 'financements', 'action' => 'index']) ?>
		</td>
		<td>
			<i><b><?= $this->Html->link(__('Déconnexion'), ['controller' => 'membres', 'action' => 'logout']) ?></b></i>
		</td>
	</tr>
</table>