<!-- in /templates/Users/login.php -->
<?= $this->Html->css('login.css') ?> 
<?= $this->Html->css('style.css') ?> 



<!DOCTYPE html>
<?= $this->Html->css('articlestyle') ?> 
<html>
<head>
    <meta charset="UTF-8">
    <?= $this->Html->css('style') ?> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="parent">
        <div class="background-overlay">
            <div id="login">
                <div class="users form">
                <div class="top-image1">
    <?= $this->Html->image('gamezone.png', [
        'alt' => 'Game Zone1',
        'class' => 'top-image1',
    ]) ?>
</div>         
                    <p class="slogan">Explore top game reviews, player insights, and community articles</p>
                    <?= $this->Flash->render() ?>
                    <h3>Login</h3>
                    <?= $this->Form->create(null, [
                        'url' => ['controller' => 'Users', 'action' => 'login'],
                    ]) ?>
                    <fieldset>
                        <legend><?= __(
                            'Please enter your email and password'
                        ) ?></legend>
                        <?= $this->Form->control('email', [
                            'required' => true,
                            'class' => 'white-text',
                        ]) ?>
                        <?= $this->Form->control('password', [
                            'required' => true,
                            'class' => 'white-text',
                        ]) ?>
                    </fieldset>
                    <?= $this->Form->submit(__('Enter')) ?>
                    <?= $this->Form->end() ?>

                    <?= $this->Html->link(
                        'Forgot your password?',
                        ['action' => 'resetPassword'],
                        ['class' => 'forgot-password-link']
                    ) ?>


                    <?= $this->Html->link(
                        'Create Account',
                        ['action' => 'add'],
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Html->image('flame.gif', [
        'class' => 'flame-gif',
        'alt' => 'Flame GIF',
    ]) ?>
<?= $this->Html->image('flame1.gif', [
    'class' => 'flame1-gif',
    'alt' => 'Flame1 GIF',
]) ?>
</body>
</html>


