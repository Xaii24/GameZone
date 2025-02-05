<h3>Reset your password</h3>

<?= $this->Form->create($user) ?>
    <?= $this->Form->control('password', [
        'type' => 'password',
        'label' => 'New Password',
    ]) ?>
    <?= $this->Form->control('password_confirmation', [
        'type' => 'password',
        'label' => 'Confirm New Password',
    ]) ?>
    <?= $this->Form->button('Reset Password') ?>
<?= $this->Form->end() ?>
