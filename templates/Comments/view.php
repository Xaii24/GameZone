<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comment $comment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(
                __('Edit Comment'),
                ['action' => 'edit', $comment->id],
                ['class' => 'side-nav-item']
            ) ?>
            <?= $this->Form->postLink(
                __('Delete Comment'),
                ['action' => 'delete', $comment->id],
                [
                    'confirm' => __(
                        'Are you sure you want to delete # {0}?',
                        $comment->id
                    ),
                    'class' => 'side-nav-item',
                ]
            ) ?>
            <?= $this->Html->link(
                __('List Comments'),
                ['action' => 'index'],
                ['class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(
                __('New Comment'),
                ['action' => 'add'],
                ['class' => 'side-nav-item']
            ) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="comments view content">
            <h3><?= h($comment->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Article') ?></th>
                    <td><?= $comment->hasValue('article')
                        ? $this->Html->link($comment->article->title, [
                            'controller' => 'Articles',
                            'action' => 'view',
                            $comment->article->id,
                        ])
                        : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $comment->hasValue('user')
                        ? $this->Html->link($comment->user->username, [
                            'controller' => 'Users',
                            'action' => 'view',
                            $comment->user->id,
                        ])
                        : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($comment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($comment->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($comment->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($comment->body)) ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
