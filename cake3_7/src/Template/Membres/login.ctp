<?php $title='Login'; ?>
<title><?php echo $title; ?></title>
<h2>Connexion par mot de passe</h2>
<div class="login form">
    <fieldset>
        <?php
            echo $this->Form->create('Membre');
            echo $this->Form->control('email');
            echo $this->Form->control('passwd', ['label' => "Mot de passe"]);
            echo $this->Form->button('Connexion');
            echo $this->Form->end();
        ?>
    </fieldset>
</div>
<p>Mot de passe oublié : </p>
<?= $this->Html->link('Changer mon mot de passe.') ?>

