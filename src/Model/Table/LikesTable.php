<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Likes Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Like newEmptyEntity()
 * @method \App\Model\Entity\Like newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Like> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Like get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Like findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Like patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Like> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Like|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Like saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Like>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Like>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Like>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Like> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Like>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Like>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Like>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Like> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LikesTable extends Table
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

        $this->setTable('likes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
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
            ->integer('article_id')
            ->notEmptyString('article_id');

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
        $rules->add($rules->existsIn(['article_id'], 'Articles'), ['errorField' => 'article_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
