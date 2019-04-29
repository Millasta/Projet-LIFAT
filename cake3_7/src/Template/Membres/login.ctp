<h1>Connexion par mot de passe</h1>
<?= $this->Form->create('Membre') ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('passwd') ?>
<?= $this->Form->button('Connexion') ?>
<?= $this->Form->end() ?>
