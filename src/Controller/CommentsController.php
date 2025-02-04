<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $query = $this->Comments->find()->contain(['Articles', 'Users']);
        $comments = $this->paginate($query);

        $this->set(compact('comments'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();

        $comment = $this->Comments->get($id, contain: ['Articles', 'Users']);
        $this->set(compact('comment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // Skip authorization check for this action
        $this->Authorization->skipAuthorization();

        // Check if the user is authenticated (logged in)
        $identity = $this->request->getAttribute('identity');
        if (!$identity) {
            // Redirect to login if no user is authenticated
            return $this->redirect([
                'controller' => 'Users',
                'action' => 'login',
            ]);
        }

        // Create a new empty comment entity
        $comment = $this->Comments->newEmptyEntity();

        // Check if the request method is POST
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity(
                $comment,
                $this->request->getData()
            );

            // Assign the current user's ID to the comment
            $comment->user_id = $identity->getIdentifier();

            // Find the article that the comment is linked to using the article ID from the comments table
            $article = $this->Comments->Articles->get($comment->article_id);

            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('Your comment has been saved.'));
            } else {
                $this->Flash->error(__('Unable to add your comment.'));
            }

            return $this->redirect([
                'controller' => 'Articles',
                'action' => 'view',
                $article->slug,
            ]);
        }

        // Pass comment to view
        $this->set('comment', $comment);
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Authorization->skipAuthorization();

        $comment = $this->Comments->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity(
                $comment,
                $this->request->getData()
            );
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(
                __('The comment could not be saved. Please, try again.')
            );
        }
        $articles = $this->Comments->Articles->find('list', limit: 200)->all();
        $users = $this->Comments->Users->find('list', limit: 200)->all();
        $this->set(compact('comment', 'articles', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        \Cake\Log\Log::write('debug', 'Delete method called');
        \Cake\Log\Log::write('debug', 'Article ID: ' . $id);

        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post', 'delete']);

        // Retrieve the comment from the database using the provided ID
        $comment = $this->Comments->get($id);

        // Get the currently authenticated user
        $user = $this->request->getAttribute('identity');

        // Check if the logged-in user is the owner of the comment
        if ($comment->user_id !== $user->getIdentifier()) {
            // If not the owner, show an error message
            $this->Flash->error(
                __('You are not authorized to delete that comment.')
            );

            // Redirect back to the article view page
            return $this->redirect([
                'controller' => 'Articles',
                'action' => 'view',
                $comment->article_id, // Redirect to the article where the comment belongs
            ]);
        }

        // Proceed with the deletion if the user is the owner
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(
                __('The comment could not be deleted. Please, try again.')
            );
        }

        // Explicitly redirect back to the article view page
        return $this->redirect([
            'controller' => 'Articles',
            'action' => 'view',
            $comment->article_id, // Ensure the user is taken back to the article page
        ]);
    }
}
