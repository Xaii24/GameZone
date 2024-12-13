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
                            'Please enter your username and password'
                        ) ?></legend>
                        <?= $this->Form->control('email', [
                            'required' => true,
                        ]) ?>
                        <?= $this->Form->control('password', [
                            'required' => true,
                        ]) ?>
                    </fieldset>
                    <?= $this->Form->submit(__('Enter')) ?>
                    <?= $this->Form->end() ?>

                    <?= $this->Html->link(
                        'Create Account',
                        ['action' => 'add'],
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
        </div>
    </div>
   
</body>
</html>
