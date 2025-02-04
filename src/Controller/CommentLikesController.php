<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CommentLikes Controller
 *
 * @property \App\Model\Table\CommentLikesTable $CommentLikes
 */
class CommentLikesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->CommentLikes->find()->contain(['Comments', 'Users']);
        $commentLikes = $this->paginate($query);

        $this->set(compact('commentLikes'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment Like id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commentLike = $this->CommentLikes->get(
            $id,
            contain: ['Comments', 'Users']
        );
        $this->set(compact('commentLike'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($commentId = null)
    {
        $this->Authorization->skipAuthorization();

        // Allow POST requests
        $this->request->allowMethod(['post']);

        // Check if commentId is null
        if ($commentId === null) {
            $this->Flash->error(__('Invalid comment.'));
            return $this->redirect($this->referer());
        }

        // Get the current user's ID
        $userId = $this->request->getAttribute('identity')->get('id');

        // Check if the user has already liked this comment
        $existingLike = $this->CommentLikes
            ->find()
            ->where(['comment_id' => $commentId, 'user_id' => $userId])
            ->first();

        if ($existingLike) {
            $this->Flash->error(__('You have already liked this comment.'));
            return $this->redirect($this->referer());
        }

        // Create a new like entity
        $like = $this->CommentLikes->newEmptyEntity();
        $like->comment_id = $commentId;
        $like->user_id = $userId;

        // Save the like
        if ($this->CommentLikes->save($like)) {
            $this->Flash->success(__('The comment has been liked.'));
        } else {
            $this->Flash->error(
                __('Unable to like the comment. Please try again.')
            );
        }

        return $this->redirect([
            'controller' => 'Articles',
            'action' => 'view',
            $articleId,
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment Like id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commentLike = $this->CommentLikes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commentLike = $this->CommentLikes->patchEntity(
                $commentLike,
                $this->request->getData()
            );
            if ($this->CommentLikes->save($commentLike)) {
                $this->Flash->success(__('The comment like has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(
                __('The comment like could not be saved. Please, try again.')
            );
        }
        $comments = $this->CommentLikes->Comments
            ->find('list', limit: 200)
            ->all();
        $users = $this->CommentLikes->Users->find('list', limit: 200)->all();
        $this->set(compact('commentLike', 'comments', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment Like id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commentLike = $this->CommentLikes->get($id);
        if ($this->CommentLikes->delete($commentLike)) {
            $this->Flash->success(__('The comment like has been deleted.'));
        } else {
            $this->Flash->error(
                __('The comment like could not be deleted. Please, try again.')
            );
        }

        return $this->redirect(['action' => 'index']);
    }
}
