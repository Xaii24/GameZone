<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Likes Controller
 *
 */
class LikesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Likes->find();
        $likes = $this->paginate($query);

        $this->set(compact('likes'));
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    // public function add($articleId = null)
    // {
    //     $this->Authorization->skipAuthorization();

    //     // Allow POST requests
    //     $this->request->allowMethod(['post']);

    //     // Check if articleId is null
    //     if ($articleId === null) {
    //         $this->Flash->error(__('Invalid article.'));
    //         return $this->redirect($this->referer());
    //     }

    //     // Get the current user's ID
    //     $userId = $this->request->getAttribute('identity')->get('id');

    //     // Check if the user has already liked this article
    //     $existingLike = $this->Likes
    //         ->find()
    //         ->where(['article_id' => $articleId, 'user_id' => $userId])
    //         ->first();

    //     if ($existingLike) {
    //         $this->Flash->error(__('You have already liked this article.'));
    //         return $this->redirect($this->referer());
    //     }

    //     // Create a new like entity
    //     $like = $this->Likes->newEmptyEntity();
    //     $like->article_id = $articleId;
    //     $like->user_id = $userId;

    //     // Save the like
    //     if ($this->Likes->save($like)) {
    //         $this->Flash->success(__('The article has been liked.'));
    //     } else {
    //         $this->Flash->error(
    //             __('Unable to like the article. Please try again.')
    //         );
    //     }

    //     return $this->redirect($this->referer());
    // }

    public function add($articleId = null)
    {
        $this->Authorization->skipAuthorization();

        // Allow POST requests
        $this->request->allowMethod(['post']);

        // Check if articleId is null
        if ($articleId === null) {
            $this->Flash->error(__('Invalid article.'));
            return $this->redirect($this->referer());
        }

        // Get the current user's ID
        $userId = $this->request->getAttribute('identity')->get('id');

        // Check if the user has already liked this article
        $existingLike = $this->Likes
            ->find()
            ->where(['article_id' => $articleId, 'user_id' => $userId])
            ->first();

        if ($existingLike) {
            $this->Flash->error(__('You have already liked this article.'));
            return $this->redirect([
                'controller' => 'Articles',
                'action' => 'index',
                $article->slug,
            ]);
        }

        // Create a new like entity
        $like = $this->Likes->newEmptyEntity();
        $like->article_id = $articleId;
        $like->user_id = $userId;

        // Save the like
        if ($this->Likes->save($like)) {
            $this->Flash->success(__('The article has been liked.'));
        } else {
            $this->Flash->error(
                __('Unable to like the article. Please try again.')
            );
        }

        // Load the Articles table
        $articlesTable = \Cake\ORM\TableRegistry::getTableLocator()->get(
            'Articles'
        );

        // Fetch the article using its ID
        $article = $articlesTable->get($articleId);

        // Redirect to the article view page using slug
        return $this->redirect([
            'controller' => 'Articles',
            'action' => 'index',
            $article->slug,
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Like id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $like = $this->Likes->get($id, contain: []);
        $this->set(compact('like'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Like id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $like = $this->Likes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $like = $this->Likes->patchEntity($like, $this->request->getData());
            if ($this->Likes->save($like)) {
                $this->Flash->success(__('The like has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(
                __('The like could not be saved. Please, try again.')
            );
        }
        $this->set(compact('like'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Like id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $like = $this->Likes->get($id);
        if ($this->Likes->delete($like)) {
            $this->Flash->success(__('The like has been deleted.'));
        } else {
            $this->Flash->error(
                __('The like could not be deleted. Please, try again.')
            );
        }

        return $this->redirect(['action' => 'index']);
    }
}
