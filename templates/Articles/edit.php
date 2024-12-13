<!-- templates/Articles/edit.php -->
<h1>Edit Article</h1>
<?= $this->Form->create($article) ?>
<fieldset>
    <legend><?= __('Edit Article') ?></legend>
    <?php
    echo $this->Form->control('title');
    echo $this->Form->control('body');
    echo $this->Form->control('tags._ids', ['options' => $tags]);
    ?>
</fieldset>
<?= $this->Form->button(__('Save Article')) ?>
<?= $this->Form->end() ?>
