<!-- src/Template/Users/reset_password.ctp -->
<h3>Reset your password</h3>

<?= $this->Form->create() ?>
    <?= $this->Form->control('email', [
        'label' => 'Enter your email address',
    ]) ?>
    <?= $this->Form->button('Send reset link') ?>
<?= $this->Form->end() ?>
