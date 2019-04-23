<div class="note">Rappel : L'ordre de mission doit parvenir au secrétariat <span class="bold">5 jours ouvrés</span> avant le départ.</div>

<?php

	$this->assign('title', 'ODM');

	echo $this->Html->tag('h2','Présentation du site');
	echo $this->Html->para('','Ce site permet la création des ordres de mission. L\'ordre de mission est généré automatiquement en pdf et envoyé au secrétariat une fois la mission validée par votre chef d\'équipe.');

	echo $this->Html->para('','Afin de faciliter le remplissage de l\'ordre de mission, votre profil est enregistré. Ainsi, le remplissage des informations vous concernant ne sont saisies qu\'une seule fois.');

	echo $this->Html->para('','L\'historique de vos demandes est conservé et accessible. L\'ordre de mission peut-être corrigé jusqu\'à sa validation.');

	echo $this->Html->tag('h2','Inscription et connexion'); 
	echo '<p>Si vous n\'avez jamais utilisé le site, il faut vous inscrire en ';
	echo $this->Html->link('cliquant ici', array('controller' => 'membres', 'action' => 'register'));
	echo '.</p>';
	echo '<p>Si vous possédez déjà un compte, deux connexions sont possibles :<br>- Par ';

	echo $this->Html->link('l\'ENT/CAS', array('controller' => 'membres', 'action' => 'loginCas'));
	echo ', si vous avez associé votre compte lors de votre inscription ou dans votre profil.<br>
	- Par la "';
	echo $this->Html->link('Connexion par mot de passe', array('controller' => 'membres', 'action' => 'login'));
	echo '".</p>';

?>