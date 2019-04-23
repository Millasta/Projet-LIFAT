<table align="right">
	<tr>
		<td>
			<?=$this->Html->link(__('Membres'), ['controller' => 'membres', 'action' => 'index'])?>
		</td>
		<td>
			<?=$this->Html->link(__('Équipes'), ['controller' => 'equipes', 'action' => 'index'])?>
		</td>
		<td>
			<?=$this->Html->link(__('Missions'), ['controller' => 'missions', 'action' => 'index'])?>
		</td>
		<td>
			<?=$this->Html->link(__('Projets'), ['controller' => 'projets', 'action' => 'index'])?>
		</td>
		<td>
			<?=$this->Html->link(__('Thèses'), ['controller' => 'theses', 'action' => 'index'])?>
		</td>
		<td>
			<?=$this->Html->link(__('Lieux'), ['controller' => 'lieux', 'action' => 'index'])?>
		</td>
		<td>
			<?=$this->Html->link(__('Transports'), ['controller' => 'transports', 'action' => 'index'])?>
		</td>
		<td>
			<?=$this->Html->link(__('Motifs'), ['controller' => 'motifs', 'action' => 'index'])?>
		</td>
		<td>
			<?=$this->Html->link(__('Financements'), ['controller' => 'financements', 'action' => 'index'])?>
		</td>
		<?php if (!empty($user)): ?>
   			<td>
				<?php
					echo $user['prenom'].' '.$user['nom'].' ('.$user['role'];
					if ($user['permanent'] === true)
					{
						echo " permanent";
					}
					echo ")";
				?>
			</td>
			<td>
				<?= $this->Html->link(__('Déconnexion'), ['controller' => 'membres', 'action' => 'logout']) ?>
			</td>
		<?php else: ?>
   			<td>
				<?= $this->Html->link(__('Connexion'), ['controller' => 'membres', 'action' => 'login']) ?>
			</td>
		<?php endif; ?>
	</tr>
</table>
<!-- TODO : bouger des trucs selon droits	-->