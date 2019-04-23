<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Membre $membre
 */

echo $this->element('navbar');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $membre->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $membre->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Membres'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Lieu Travails'), ['controller' => 'LieuTravails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lieu Travail'), ['controller' => 'LieuTravails', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="membres form large-9 medium-8 columns content">

    <div class="note">Les informations du profil utilisateur sont utilisées pour la génération de l'OdM</div>

    <div class="profil" id="profil">
        <h2>Profil utilisateur</h2>
        <?= $this->Form->create($membre) ?>
        <fieldset>
            <legend><?= __('Identifiant') ?></legend>
            <?php
                echo $this->Form->control('nom', ['label' => 'Nom']);
                echo $this->Form->control('prenom', ['label' => 'Prénom']);
                echo $this->Form->control('email', ['label' => 'Courriel', 'type' => 'email']);
                echo $this->Form->control('date_naissance', ['label' => 'Date de naissance', 'type' => 'date']);
            ?>
        </fieldset>
        <fieldset>
            <legend><?= __('Adresse Personnelle') ?></legend>
            <?php
                echo $this->Form->control('adresse_agent_1', ['label' => '']);
                echo $this->Form->control('adresse_agent_2', ['label' => '']);
            ?>
        </fieldset>
        <fieldset>
            <legend><?= __('Equipe') ?></legend>
            <?php
                echo $this->Form->control('equipe_id', ['options' => $equipes, 'multiple' => false, 'label' => '']);
            ?>
        </fieldset>
        <fieldset>
            <legend><?= __('Equipe') ?></legend>
            <?php
                echo $this->Form->control('type_personnel', [ 'options' => array ( 'PU' => 'Personnel Université',
                                                                                            'PE' => 'Personnalité Exterieur',
                                                                                            'Do' => 'Doctorant'),
                                                                        'type' => 'select',
                                                                        'label' => '']);
                echo $this->Form->control('intitule', ['label' => 'Intitulé (si personnel université']);
                echo $this->Form->control('grade', ['label' => 'Grade (si personnel université']);
            ?>
        </fieldset>
        <fieldset>
            <legend><?= __('Véhicule principal') ?></legend>
            <?php
                echo $this->Form->control('im_vehicule', ['label' => 'Immatriculation']);
                echo $this->Form->control('pf_vehicule', ['label' => 'Puissance fiscale', 'type' => 'number']);
            ?>
        </fieldset>
        <fieldset>
            <legend><?= __('Carte de réduction') ?></legend>
            <?php
                echo $this->Form->control('carte_sncf', ['label' => 'Carte de réduction SNCF']);
            ?>
        </fieldset>
        <!--
        <fieldset>
            <legend><?= __('A SUPPRIMER') ?></legend>
            <?php
                echo $this->Form->control('role');
                echo $this->Form->control('passwd');
                echo $this->Form->control('residence_admin_1');
                echo $this->Form->control('residence_admin_2');
                echo $this->Form->control('signature_name');
                echo $this->Form->control('login_cas');
                echo $this->Form->control('matricule');
                echo $this->Form->control('date_naissance', ['empty' => true]);
                echo $this->Form->control('actif');
                echo $this->Form->control('lieu_travail_id', ['options' => $lieuTravails, 'empty' => true]);
                echo $this->Form->control('nationalite');
                echo $this->Form->control('est_francais');
                echo $this->Form->control('genre');
                echo $this->Form->control('hdr');
                echo $this->Form->control('permanent');
                echo $this->Form->control('est_porteur');
                echo $this->Form->control('date_creation', ['empty' => true]);
                echo $this->Form->control('date_sortie', ['empty' => true]);
            ?>
        </fieldset>
        -->

        <?= $this->Form->button('Sauver le profil', ['type' => 'submit']) ?>
        <?= $this->Form->end() ?>
    </div>

    <div id="signature">

        <h2>Complément</h2>

        <div class="note">Si vous avez modifié votre profil utilisateur, sauvegardez-le<br/>
            avant d'utiliser les fonctionnalités ci-dessous.</div>

        <?php
            $signaturePath = "sign/".$membre['signature_name'].".jpg";
            $fullSignaturePath ='./img/'.$signaturePath;
            $verifSignature = file_exists($fullSignaturePath);

            // TODO : upload fichier signature pour le membre courant
            echo $this->Form->create('Membres', array('action' => 'signature', 'type' => 'file')); ?>

        <fieldset>
            <legend><?= __('Signature') ?></legend>
            <?php
                echo $this->Form->control('submittedfile', ['label'=> ['text' => 'Image au <span class="attention"> format jpg uniquement</span>, format idéal : 600 × 145', 'escape' => false], 'type' => 'file']);
            ?>
        </fieldset>

        <?php
            echo $this->Form->button('Envoyer la signature', ['type' => 'submit']);
            echo $this->Form->end();


            //affichage de la signature ou d'un message d'erreur
            if (!$verifSignature) {
                echo '<div class="note">Merci de bien vouloir ajouter votre signature éléctronique.<br/>
                                        Sans cette signature vous devrez aller signer l\'OdM au secrétariat.</div>';
            }
            else {
                echo $this->Html->div('signature',
                    '<p>Aperçu de la signature actuelle : </p>'.
                    $this->Html->image($signaturePath,array('alt' => 'signature', 'width' => '235', 'height' => '50', 'class' => 'signature_img'))
                );
            }
        ?>

        <hr>

        <fieldset id="password">
            <legend>Mot de passe</legend>
            <?php
                // TODO : membres.changePassword
                echo $this->Html->link('Changer le mot de passe', array(
                        'controller' => 'membres',
                        'action' => 'change_password'
                    )
                );
            ?>
        </fieldset>

        <fieldset id="loginCas">
            <legend>Identifiant ENT/CAS</legend>
            <?php
                if ($membre['login_cas'] != null && $membre['login_cas'] != '') {
                    echo "Votre compte est associé à l'identifiant « ".$membre['login_cas']." ».";
                } else {
                    echo "Vous pouvez associer ce profil avec votre compte ENT/CAS. Ceci vous permettra à l'avenir de vous connecter automatiquement en passant par cette plateforme. Pour associer votre compte ";
                    // TODO : membres.assocLoginCas
                    echo $this->Html->link('cliquez ici', array(
                            'controller' => 'membres',
                            'action' => 'assocLoginCas'
                        )
                    );
                    echo ".";
                }
            ?>
        </fieldset>
    </div>
</div>
