<div class="note">Rappel : L'ordre de mission doit parvenir au secrétariat <span class="bold">5 jours ouvrés</span> avant le départ.</div>

	echo $this->Html->tag('h2','Présentation du site');
	echo $this->Html->para('','Ce site permet la gestion du laboratoire d\'informatique de l\'université de Tours.');

	echo $this->Html->para('','Vous avez la possibilité de créer un compte sur notre site.');

	echo $this->Html->tag('h2','Inscription et connexion'); 
	echo '<p>Si vous n\'avez jamais utilisé le site, il faut vous inscrire en ';
	echo $this->Html->link('cliquant ici', array('controller' => 'membres', 'action' => 'add'));
	echo '.</p>';
	echo '<p>Si vous possédez déjà un compte, deux connexions sont possibles :<br>- Par ';

	echo $this->Html->link('l\'ENT/CAS', array('controller' => 'membres', 'action' => 'loginCas'));
	echo ', si vous avez associé votre compte lors de votre inscription ou dans votre profil.<br>
	- Par la "';
	echo $this->Html->link('Connexion par mot de passe', array('controller' => 'membres', 'action' => 'login'));
	echo '".</p>';

?>