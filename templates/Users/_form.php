<?= $this->Html->css('login.css') ?> 
<?= $this->Html->css('style.css') ?> 

<div class="column column-80">
    <div class="users-form-content">
        <!-- Top Image Container -->
        <div class="top-image1">
            <?= $this->Html->image('gamezone.png', [
                'alt' => 'Game Zone1',
                'class' => 'top-image1',
            ]) ?>
        </div>   
       
        <p class="slogan">Explore top game reviews, player insights, and community articles</p>
        <h1 class="custom-heading"><?= __('Create & Edit User') ?></h1>
        <legend><?= __('Please enter your email and password') ?></legend>

        <?= $this->Form->create($user) ?>
        <fieldset>
            <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Create')) ?>
        <?= $this->Form->end() ?>
            
    </div>
    <?= $this->Html->image('flame.gif', [
        'class' => 'flamenew-gif',
        'alt' => 'Flame GIF',
    ]) ?>

            <?= $this->Html->image('flame1.gif', [
                'class' => 'flame1new-gif',
                'alt' => 'Flame1 GIF',
            ]) ?>
</div>

