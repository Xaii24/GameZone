<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CommentLikes Model
 *
 * @property \App\Model\Table\CommentsTable&\Cake\ORM\Association\BelongsTo $Comments
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\CommentLike newEmptyEntity()
 * @method \App\Model\Entity\CommentLike newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CommentLike> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CommentLike get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CommentLike findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CommentLike patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CommentLike> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CommentLike|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CommentLike saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CommentLike>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CommentLike>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CommentLike>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CommentLike> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CommentLike>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CommentLike>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CommentLike>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CommentLike> deleteManyOrFail(iterable $entities, array $options = [])
 */
class CommentLikesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('comment_likes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Comments', [
            'foreignKey' => 'comment_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
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
        $validator
            ->integer('comment_id')
            ->notEmptyString('comment_id');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

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
        $rules->add($rules->existsIn(['comment_id'], 'Comments'), ['errorField' => 'comment_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
