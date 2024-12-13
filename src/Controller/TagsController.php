<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 */
class TagsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $query = $this->Tags->find();
        $tags = $this->paginate($query);

        $this->set(compact('tags'));
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();

        $tag = $this->Tags->get($id, contain: ['Articles']);
        $this->set(compact('tag'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tag = $this->Tags->newEmptyEntity();
        $this->_form($tag);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function edit($id = null)
    {
        $tag = $this->Tags->get($id, contain: ['Articles']);
        $this->_form($tag);
    }

    protected function _form($tag)
    {
        $this->Authorization->skipAuthorization(); // Skip authorization

        if ($this->request->is(['post', 'put', 'patch'])) {
            // Check if the request is a form submission
            $tag = $this->Tags->patchEntity($tag, $this->request->getData()); // Patch the entity with request data
            if ($this->Tags->save($tag)) {
                // Attempt to save
                $this->Flash->success(__('The tag has been saved.')); // Set a success message
                return $this->redirect(['action' => 'index']); // Redirect to index after success
            }
            $this->Flash->error(
                __('The tag could not be saved. Please, try again.')
            ); // Set an error message
        }

        $articles = $this->Tags->Articles->find('list', limit: 200)->all(); // Retrieve list of articles
        $this->set(compact('tag', 'articles')); // Set variables for the view to display
        $this->render('_form');
    }

    /**
     * Delete method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('The tag has been deleted.'));
        } else {
            $this->Flash->error(
                __('The tag could not be deleted. Please, try again.')
            );
        }

        return $this->redirect(['action' => 'index']);
    }
}
