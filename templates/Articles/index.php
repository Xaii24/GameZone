<?= $this->Html->css('articlestyle.css') ?>
<?= $this->Html->css('gifs.css') ?>
<?= $this->Html->css('backbanner.css') ?>

<div class="left-border-image">
    <?= $this->Html->image('zombie.png', [
        'alt' => 'Zombie Image',
        'class' => 'left-border-image',
    ]) ?>
</div>

<div class="right-border-image">
    <?= $this->Html->image('duke.png', [
        'alt' => 'Duke Image',
        'class' => 'right-border-image',
    ]) ?>
</div>

<div class="top-image">
    <?= $this->Html->image('gamezone.png', [
        'alt' => 'Game Zone',
        'class' => 'top-image',
    ]) ?>
    <!-- <img src="img/nintendo.gif" class="nintendo-gif" alt="Nintendo GIF"> -->
    <img src="img/nintendo.gif?t=<?= time() ?>" class="nintendo-gif" alt="Nintendo GIF">
    <img src="img/gameboy.gif" class="gameboy-gif" alt="Gameboy GIF">
    <img src="img/Rectangle.png" alt="Rectangle" class="Rectangle">
    
</div>

<?= $this->Form->create(null, [
    'url' => ['action' => 'index'],
    'type' => 'get',
]) ?>
    <?= $this->Form->control('search', [
        'label' => false,
        'placeholder' => 'Search Articles by Title',
        'class' => 'search-bar',
    ]) ?>
    <?= $this->Form->button(__('Search'), ['class' => 'search-button']) ?>
<?= $this->Form->end() ?>

<?= $this->Html->link(
    __('Create Article'),
    ['action' => 'add'],
    ['class' => 'custom-button']
) ?>

<table>
    <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td>
                    <?= $this->Html->link(
                        $article->title,
                        [
                            'action' => 'view',
                            $article->slug,
                        ],
                        ['style' => 'font-size: 20px;']
                    ) ?>

                    <?php if ($article->image): ?>
                        <div style="display: flex; align-items: flex-start; margin-bottom: 20px;">
                            <div style="margin-right: 20px;">
                                <?= $this->Html->link(
                                    $this->Html->image(
                                        'articles/' . $article->image,
                                        [
                                            'alt' => $article->title,
                                            'style' =>
                                                'max-width: 300px; max-height: 200px;',
                                        ]
                                    ),
                                    [
                                        'action' => 'view',
                                        $article->slug,
                                    ],
                                    ['escape' => false]
                                ) ?>

                                <!-- Like Button Form -->
                                <?= $this->Form->create(null, [
                                    'url' => [
                                        'controller' => 'Likes',
                                        'action' => 'add',
                                        $article->id,
                                    ],
                                    'type' => 'post',
                                ]) ?>
                                    <?= $this->Form->button(__('❤️ Like'), [
                                        'class' => 'like-button',
                                    ]) ?>
                                <?= $this->Form->end() ?>

                                <div class="like-info">
                                    <span class="like-count"><?= isset(
                                        $likeCountsArray[$article->id]
                                    )
                                        ? h($likeCountsArray[$article->id])
                                        : 0 ?></span>
                                </div>

                                <!-- Action Links -->
                                <div class="action-links">
                                    <?= $this->Html->link('Edit', [
                                        'action' => 'edit',
                                        $article->slug,
                                    ]) ?><br>
                                    
                                    <?= $this->Form->postLink(
                                        'Delete',
                                        ['action' => 'delete', $article->slug],
                                        [
                                            'confirm' =>
                                                'Are you sure you want to delete this article?',
                                        ]
                                    ) ?>
                                </div>
                            </div>
                            <div>
                                <p>
                                    <?= $this->Text->truncate(
                                        h($article->body),
                                        600,
                                        [
                                            'ellipsis' =>
                                                '... ' .
                                                $this->Html->link('Read more', [
                                                    'action' => 'view',
                                                    $article->slug,
                                                ]),
                                            'exact' => false,
                                            'html' => true,
                                        ]
                                    ) ?>
                                </p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div>No Image</div>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
