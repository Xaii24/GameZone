<!-- File: templates/Articles/view.php -->
<?= $this->Html->css('view.css') ?> 
<?= $this->Html->css('backbanner.css') ?> 


<div class="background-layer"></div>
<div class="background-layer1"></div>

 

<div class="articles-view-container">  

<div class="top-image">
    <?= $this->Html->image('gamezone.png', [
        'alt' => 'Game Zone',
        'class' => 'top-image10',
    ]) ?>
    </div>

    <div class="black-rectangle"></div>


<?= $this->Html->css('comment') ?>
<?= $this->Html->link(
    __('Back to Articles'),
    ['controller' => 'Articles', 'action' => 'index'],
    ['class' => 'buttonfloat-right']
) ?>

<h1 class="article-title"><?= h($article->title) ?></h1>

<?php if ($article->image): ?>
    <div>
        <?= $this->Html->image('articles/' . $article->image, [
            'alt' => $article->title,
            'style' => 'max-width: 50%; height: 80%;',
        ]) ?>
    </div>
<?php else: ?>
    <p>No Image Available</p>
<?php endif; ?>

<p><?= h($article->body) ?></p>
<p><b>Tags:</b> <?= h($article->tag_string) ?></p>
<p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?></p>

<h3>Comments</h3>

<?php if (!empty($article->comments)): ?>
    <table class="comments">
        <thead>
        </thead>
        <tbody>
        <?php foreach ($article->comments as $comment): ?>
            <tr>
                <td>
                    <?= h($comment->body) ?>
                    <br>
                    <small>Posted by: <?= h($comment->user->email) ?></small>
                    <br>
                    <small><?= $comment->created->format(DATE_RFC850) ?></small>
                    <br>
                    <span class="likes-count1"><?= h(
                        $comment->likes_count
                    ) ?></span>
                        <span class="heart1">❤️</span>
                    <?= $this->Form->create(null, [
                        'url' => [
                            'controller' => 'Comments',
                            'action' => 'delete',
                            $comment->id,
                        ],
                        'type' => 'post',
                    ]) ?>
                    <?= $this->Form->button(__('Delete'), [
                        'type' => 'submit',
                        'class' => 'Delete-View',
                        'style' =>
                            'border: none; background: none; padding: 0; color: #007bff; text-decoration: ;',
                        'onclick' =>
                            'return confirm("Are you sure you want to delete this comment?")',
                    ]) ?>
                    <?= $this->Form->end() ?>
                </td>
                <td>
    <?= $this->Form->create(null, [
        'url' => [
            'controller' => 'CommentLikes',
            'action' => 'add',
            $comment->id,
        ],
        'type' => 'post',
    ]) ?>
    <?= $this->Form->button(__('❤️ Like'), [
        'class' => 'like-buttonview',
    ]) ?> <!-- Added class 'like-button' -->
    <?= $this->Form->end() ?>
</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Be the first to comment!</p>
<?php endif; ?>

<h4>Leave a Comment</h4>
<?= $this->Form->create(null, [
    'url' => ['controller' => 'Comments', 'action' => 'add'],
]) ?>
<?= $this->Form->control('body', ['label' => '']) ?>
<?= $this->Form->hidden('article_id', ['value' => $article->id]) ?>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>


</div>




