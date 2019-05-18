<table id="menu">
	<tr>
		<?php if (!empty($user)): ?>
					<td>
			<?=$this->Html->link(__('Membres'), ['controller' => 'membres', 'action' => 'index'])?>
			</td>
			<td>
				<?=$this->Html->link(__('Équipes'), ['controller' => 'equipes', 'action' => 'index'])?>
			</td>
			<td>
				<?=$this->Html->link(__('Projets'), ['controller' => 'projets', 'action' => 'index'])?>
			</td>
			<td>
				<?=$this->Html->link(__('Thèses'), ['controller' => 'theses', 'action' => 'index'])?>
			</td>
			<td>
				<?=$this->Html->link(__('Lieux de travail'), ['controller' => 'lieu-travails', 'action' => 'index'])?>
			</td>
			<td>
				<?=$this->Html->link(__('Financements'), ['controller' => 'financements', 'action' => 'index'])?>
			</td>
			<td>
                <?=$this->Html->link(__('Export'), ['controller' => 'export', 'action' => 'index'])?>
            </td>
			<td>
                <?=$this->Html->link(__('Fichiers'), ['controller' => 'share-file', 'action' => 'index'])?>
            </td>
   			<td>
				<?php
					echo $user['prenom'].' '.$user['nom'].' ('.$user['role'];
					if ($user['role'] != 'admin' && $user['permanent'] == true)
					{
						echo " permanent";
					}
					echo ") ";
				?>
				<?=$this->Html->link(__('Mon Profil'), ['controller' => 'membres', 'action' => 'view', $user['id']])?>
			</td>
			<td>
				<?= $this->Html->link(__('Déconnexion'), ['controller' => 'membres', 'action' => 'logout']) ?>
			</td>
		<?php else: ?>
			<td></td><td></td><td></td><td></td><td></td><td></td>
   			<td>
				<?= $this->Html->link(__('Connexion'), ['controller' => 'membres', 'action' => 'login']) ?>
			</td>
		<?php endif; ?>
	</tr>
</table>