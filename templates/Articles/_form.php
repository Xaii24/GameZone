<?= $this->Html->css('articlestyle.css') ?> 
<?= $this->Form->create($article, ['type' => 'file']) ?>

<h1>Create Article</h1>
<fieldset>
    <?php
    echo $this->Form->control('title', ['required' => true]);
    echo $this->Form->control('body', ['required' => true]);
    echo $this->Form->control('tags._ids', [
        'options' => $tags,
        'label' => 'Select Tags (Optional)',
        'required' => false,
        'empty' => 'No Tags', // Allows users to leave it blank
    ]);
    echo $this->Form->control('image_file', [
        'type' => 'file',
        'required' => true,
        'label' => 'Upload Image',
    ]);
    ?>
</fieldset>
<?= $this->Form->button(__('Save Article')) ?>
<?= $this->Form->end() ?>
