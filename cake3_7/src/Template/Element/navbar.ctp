<?php

use App\Model\Entity\Membre;

?>

<table id="menu">
	<tr>
		<?php if (!empty($user)): ?>				<!--	Si user non connecté : il ne peut faire que Connexion et Inscription	-->
			<?php if ($user['actif'] === true): ?>	<!--	Si user non activé : il ne peut faire que Mon Profil et Déconnexion	-->
				<td>
					<?= $this->Html->link(__('Membres'), ['controller' => 'membres', 'action' => 'index']) ?>
				</td>
				<td>
					<?= $this->Html->link(__('Équipes'), ['controller' => 'equipes', 'action' => 'index']) ?>
				</td>
				<td>
					<?= $this->Html->link(__('Projets'), ['controller' => 'projets', 'action' => 'index']) ?>
				</td>
				<td>
					<?= $this->Html->link(__('Thèses'), ['controller' => 'theses', 'action' => 'index']) ?>
				</td>
				<td>
					<?= $this->Html->link(__('Lieux de travail'), ['controller' => 'lieu-travails', 'action' => 'index']) ?>
				</td>
				<td>
					<?= $this->Html->link(__('Financements'), ['controller' => 'financements', 'action' => 'index']) ?>
				</td>
				<td>
					<?= $this->Html->link(__('Export'), ['controller' => 'export', 'action' => 'index']) ?>
				</td>
				<td>
					<?= $this->Html->link(__('Fichiers'), ['controller' => 'fichiers', 'action' => 'index']) ?>
				</td>
			<?php endif; ?>
			<td>
				<?php
				echo $user['prenom'] . ' ' . $user['nom'] . ' (';
				if ($user['actif'] === true) {
					echo $user['role'];
					if ($user['permanent'] === true && $user['role'] != Membre::ADMIN) {
						echo " permanent";
					}
				} else {
					echo "Compte désactivé";
				}
				echo ") ";
				?>
				<?= $this->Html->link(__('Mon Profil'), ['controller' => 'membres', 'action' => 'view', $user['id']]) ?>
			</td>
			<td>
				<?= $this->Html->link(__('Déconnexion'), ['controller' => 'membres', 'action' => 'logout']) ?>
			</td>
		<?php else: ?>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><?= $this->Html->link(__('Connexion'), ['controller' => 'membres', 'action' => 'login']) ?></td>
			<td><?= $this->Html->link(__('Inscription'), ['controller' => 'membres', 'action' => 'register']) ?></td>
		<?php endif; ?>
	</tr>
</table>