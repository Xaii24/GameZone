<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
// the EventInterface class
use Cake\Event\EventInterface;

/**
 * Articles Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Article newEmptyEntity()
 * @method \App\Model\Entity\Article newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Article> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Article get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Article findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Article> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Article|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Article saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Article>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Article>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Article>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Article> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Article>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Article>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Article>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Article> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArticlesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */

    public function beforeSave(EventInterface $event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            $entity->slug = substr($sluggedTitle, 0, 191);
        }
    }

    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');

        $this->belongsToMany('Tags', [
            'joinTable' => 'articles_tags',
            'dependent' => true,
        ]);

        // Belongs to Users association
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('Likes', [
            'foreignKey' => 'article_id',
            'dependent' => true,
        ]);

        $this->hasMany('Comments', [
            'foreignKey' => 'article_id',
            'dependent' => true,
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator->integer('user_id')->notEmptyString('user_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title', 'A title is required')
            ->minLength(
                'title',
                1,
                'The title must be at least 1 characters long'
            );

        $validator
            ->scalar('slug')
            ->maxLength('slug', 191)
            ->allowEmptyString('slug', 'create') // Allow the slug to be empty only on create
            ->add('slug', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
            ]);

        $validator
            ->scalar('body')
            ->requirePresence('body', 'create')
            ->notEmptyString('body', 'A body is required')
            ->minLength(
                'body',
                10,
                'The body must be at least 10 characters long'
            );

        // Validation for likes_count
        $validator
            ->integer('likes_count')
            ->allowEmptyString('likes_count')
            ->greaterThanOrEqual(
                'likes_count',
                0,
                'Likes count must be a non-negative integer'
            );

        $validator->boolean('published')->allowEmptyString('published');

        // validation for image upload
        $validator
            ->add('image', 'fileType', [
                'rule' => [
                    'mimeType',
                    ['image/jpeg', 'image/png', 'image/gif'],
                ],
                'message' => 'Please upload a valid image (JPEG, PNG, GIF).',
            ])
            ->add('image', 'fileSize', [
                'rule' => ['fileSize', '<=', '2MB'],
                'message' => 'Image size must be less than 2MB.',
            ]);

        $validator
            ->notEmptyString('title', 'Title is required')
            ->notEmptyString('body', 'Body is required')
            ->add('image_file', 'file', [
                'rule' => function ($value, $context) {
                    return !empty($context['data']['image_file']) &&
                        $context['data']['image_file']->getError() ===
                            UPLOAD_ERR_OK;
                },
                'message' => 'An image file is required.',
            ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['slug']), ['errorField' => 'slug']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), [
            'errorField' => 'user_id',
        ]);

        return $rules;
    }

    public function findTagged(
        SelectQuery $query,
        array $tags = []
    ): SelectQuery {
        $columns = [
            'Articles.id',
            'Articles.user_id',
            'Articles.title',
            'Articles.body',
            'Articles.published',
            'Articles.created',
            'Articles.slug',
        ];

        $query = $query->select($columns)->distinct($columns);

        if (empty($tags)) {
            // If there are no tags provided, find articles that have no tags.
            $query->leftJoinWith('Tags')->where(['Tags.title IS' => null]);
        } else {
            // Find articles that have one or more of the provided tags.
            $query->innerJoinWith('Tags')->where(['Tags.title IN' => $tags]);
        }

        return $query->groupBy(['Articles.id']);
    }
}
