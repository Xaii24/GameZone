<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\User> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\User> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Articles', [
            'foreignKey' => 'user_id',
        ]);

        $this->hasMany('Comments', [
            'foreignKey' => 'user_id',
        ]);

        $this->hasMany('CommentLikes', [
            'foreignKey' => 'comment_id',
        ]);
        // Association with Likes
        $this->hasMany('Likes', [
            'foreignKey' => 'user_id',
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
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

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
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }
}

// <?php
// declare(strict_types=1);

// namespace App\Model\Table;

// use Cake\ORM\Query\SelectQuery;
// use Cake\ORM\RulesChecker;
// use Cake\ORM\Table;
// use Cake\Validation\Validator;

// /**
//  * Likes Model
//  *
//  * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
//  *
//  * @method \App\Model\Entity\Like newEmptyEntity()
//  * @method \App\Model\Entity\Like newEntity(array $data, array $options = [])
//  * @method array<\App\Model\Entity\Like> newEntities(array $data, array $options = [])
//  * @method \App\Model\Entity\Like get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
//  * @method \App\Model\Entity\Like findOrCreate($search, ?callable $callback = null, array $options = [])
//  * @method \App\Model\Entity\Like patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
//  * @method array<\App\Model\Entity\Like> patchEntities(iterable $entities, array $data, array $options = [])
//  * @method \App\Model\Entity\Like|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
//  * @method \App\Model\Entity\Like saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
//  * @method iterable<\App\Model\Entity\Like>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Like>|false saveMany(iterable $entities, array $options = [])
//  * @method iterable<\App\Model\Entity\Like>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Like> saveManyOrFail(iterable $entities, array $options = [])
//  * @method iterable<\App\Model\Entity\Like>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Like>|false deleteMany(iterable $entities, array $options = [])
//  * @method iterable<\App\Model\Entity\Like>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Like> deleteManyOrFail(iterable $entities, array $options = [])
//  *
//  * @mixin \Cake\ORM\Behavior\TimestampBehavior
//  */
// class LikesTable extends Table
// {
//     /**
//      * Initialize method
//      *
//      * @param array<string, mixed> $config The configuration for the Table.
//      * @return void
//      */
//     public function initialize(array $config): void
//     {
//         parent::initialize($config);

//         $this->setTable('likes');
//         $this->setDisplayField('id');
//         $this->setPrimaryKey('id');

//         $this->addBehavior('Timestamp');

//         $this->belongsTo('Articles', [
//             'foreignKey' => 'article_id',
//             'joinType' => 'INNER',
//         ]);

//         $this->belongsTo('Users', [
//             'foreignKey' => 'user_id',
//             'joinType' => 'INNER',
//         ]);
//     }

//     /**
//      * Default validation rules.
//      *
//      * @param \Cake\Validation\Validator $validator Validator instance.
//      * @return \Cake\Validation\Validator
//      */
//     public function validationDefault(Validator $validator): Validator
//     {
//         $validator->integer('article_id')->notEmptyString('article_id');

//         $validator
//             ->integer('user_id') // Ensure user_id is validated as an integer
//             ->requirePresence('user_id', 'create')
//             ->notEmptyString('user_id', 'User ID is required');

//         $this->add('user_id', [
//             'type' => 'integer',
//             'allowEmptyString' => false,
//             'message' => 'User ID is required.',
//         ]);

//         return $validator; // Return after all rules are defined
//     }

//     /**
//      * Returns a rules checker object that will be used for validating
//      * application integrity.
//      *
//      * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
//      * @return \Cake\ORM\RulesChecker
//      */
//     public function buildRules(RulesChecker $rules): RulesChecker
//     {
//         $rules->add($rules->existsIn(['article_id'], 'Articles'), [
//             'errorField' => 'article_id',
//         ]);

//         $rules->add($rules->existsIn(['user_id'], 'Users'), [
//             'errorField' => 'user_id',
//         ]);
//         return $rules;
//     }
// }
