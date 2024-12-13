<!-- File: templates/Articles/add.php -->
<?= $this->Html->css('articlestyle.css') ?> 

<div class="articles-add">  <!-- Add the class here -->

<h1>Add Article</h1>
<?php
echo $this->Form->create($article);
echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
echo $this->Form->control('tag_string', ['type' => 'text']);
echo $this->Form->control('title');
echo $this->Form->control('body', ['rows' => '3']);
echo $this->Form->button(__('Save Article'));
echo $this->Form->end();
?>
</div>