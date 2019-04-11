 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?= $this->Html->charset() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>
			
			<?= $this->fetch('title') ?>
		</title>
		
		<?= $this->Html->meta('icon') ?>

		<?= $this->Html->css('base.css') ?>
		<?= $this->Html->css('style_lifat.css') ?>

		<?= $this->fetch('meta') ?>
		<?= $this->fetch('css') ?>
		<?= $this->fetch('script') ?>
	</head>
	<body>
		<div id="main">
			<!-- Header -->
			<?php
				// titre du site (banniere)
				echo $this->Html->div('',null, array('id' => 'header'));
				echo $this->Html->tag('h1','LIFAT Manager');
				echo '</div>'; 
			?>
			<div id="menu">
				<?php
					// Définition des liens à afficher
					$accueil = $this->Html->link('Accueil',array('controller' => 'pages', 'action' => 'index'));
					$profil = $this->Html->link('Mon Profil', array('controller' => 'users', 'action' => 'profil'));	// TODO
					$missions = $this->Html->link('Mes Missions', array('controller' => 'missions', 'action' => 'getAllMissions')); // TODO
					$missionsAValider = $this->Html->link('Mission à Valider', array('controller' => 'missions', 'action' => 'needValidation')); // TODO
					$missionsValides = $this->Html->link('Missions Validées', array('controller' => 'missions', 'action' => 'listAllMissions')); // TODO
					$administration = $this->Html->link('Administration', array('controller' => 'administration', 'action' => 'index')); // TODO
					$deconnexion = $this->Html->link('Deconnexion', array('controller' => 'users', 'action' => 'logout')); // TODO
					$connexion = $this->Html->link('Connexion',array('controller' => 'users', 'action' => 'login')); // TODO
					$inscription = $this->Html->link('Inscription',array('controller' => 'users', 'action' => 'register')); // TODO
					$deconnexionCas = $this->Html->link('Déconnexion du service CAS',array('controller' => 'users', 'action' => 'logoutCas')); // TODO
					$inscription = $this->Html->link('Inscription', array('controller' => 'users', 'action' => 'register')); // TODO

					// Liens de l'administration
					$projets = $this->Html->link('Projets', array('controller' => 'projets', 'action' => 'index')); // TODO
					$equipes = $this->Html->link('Equipes', array('controller' => 'equipes', 'action' => 'index')); // TODO
					$motifs = $this->Html->link('Motifs', array('controller' => 'motifs', 'action' => 'index')); // TODO
					$matricules = $this->Html->link('Matricules', array('controller' => 'users', 'action' => 'editMatricule')); // TODO
					$loginCas = $this->Html->link('Identifiant CAS/ENT', array('controller' => 'users', 'action' => 'editLoginCas')); // TODO
					$lieux = $this->Html->link('Lieux', array('controller' => 'lieux', 'action' => 'index')); // TODO
					$mail = $this->Html->link('Configuration Mail', array('controller' => 'administration', 'action' => 'mail')); // TODO
					$utilisateurs = $this->Html->link('Utilisateurs', array('controller' => 'users', 'action' => 'administration')); // TODO

					// Mise en place des menus en fonction du rôle
					$menuDeconnecte = array(
						$accueil,
						$connexion,
						$inscription
						);

					$menuDeconnecteCas = array(
						$accueil,
						$connexion,
						$inscription,
						$deconnexionCas
						);

					$menuConnecte = array(
						$accueil,
						$profil,
						$missions,
						$deconnexion
						);

					$menuAdmin = array(
						$accueil,
						$profil,
						$missions,
						$missionsAValider,
						$missionsValides,
						$administration => array(
							$utilisateurs,
							$mail
							),
						$deconnexion
						);

					$menuSecretary = array(
						$accueil,
						$profil,
						$missions,
						$missionsValides,
						$administration => array(
							$projets,
							$equipes,
							$motifs,
							$lieux,
							$utilisateurs,
							$matricules,
							$loginCas,
							$mail
							),
						$deconnexion
						);
					
					$session = $this->request->session();
					if ($session->read('Auth.User.id') != null) {
						if ( $session->read('Auth.User.role') == 'admin') {
							echo $this->Html->nestedList($menuAdmin);
						} else if ( $session->read('Auth.User.role') == 'secretary') {
							echo $this->Html->nestedList($menuSecretary);
						} else {
							echo $this->Html->nestedList($menuConnecte);
						}
					} 
					else {
						# TODO : login CAS
						#if ($this->cas->isAuthenticated()){
						#	echo $this->Html->nestedList($menuDeconnecteCas);
						#} else {
							echo $this->Html->nestedList($menuDeconnecte);
						#}
					}
				?>
			</div>
				
			<!-- Contenu -->
			<div id="content">
				<div class="container clearfix">
					<?= $this->fetch('content') ?>
				</div>
			</div>
		 
			<!-- Pied de page -->
			<?php 
				echo $this->Html->div('',null, array('id' => 'footer'));
				echo $this->Html->para('','Site réalisé à l\'initiative du Laboratoire d\'Informatique de l\'université François Rabelais');
				echo '</div>';
			?>
		</div>
	</body>
</html>