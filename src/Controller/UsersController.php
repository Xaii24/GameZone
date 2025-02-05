<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();

        $user = $this->Users->get($id, contain: ['Articles']);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        $this->_form($user);
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, ['contain' => []]);
        $this->_form($user);
    }

    protected function _form($user)
    {
        $this->Authorization->skipAuthorization();

        if ($this->request->is(['post', 'put', 'patch'])) {
            // Patch the user data from the form submission
            $user = $this->Users->patchEntity($user, $this->request->getData());

            // Save the user to the database
            if ($this->Users->save($user)) {
                // Now authenticate the user after successful registration
                $this->Authentication->setIdentity($user); // Manually authenticate the user

                // Success flash message
                $this->Flash->success(
                    __('User Created and Logged In Successfully!')
                );

                // Redirect to the ArticlesController index action after successful registration and login
                return $this->redirect([
                    'controller' => 'Articles',
                    'action' => 'index',
                ]);
            }

            // Display an error message if the user could not be saved
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }

        // Pass the user data to the view
        $this->set(compact('user'));
        $this->render('_form');
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(
                __('The user could not be deleted. Please, try again.')
            );
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    public function login()
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['get', 'post']);

        $result = $this->Authentication->getResult();
        // Get the result of the authentication process
        if ($result && $result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Articles',
                'action' => 'index',
            ]);
            return $this->redirect($redirect);
        }
        // display error
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout()
    {
        $this->Authorization->skipAuthorization();

        // Get the current authentication result
        $result = $this->Authentication->getResult();

        // If we have a result and it shows that the user is logged in
        if ($result && $result->isValid()) {
            // Log the user out by clearing their session
            $this->Authentication->logout();
            // Redirect to login
            return $this->redirect([
                'controller' => 'Users',
                'action' => 'login',
            ]);
        }
    }

    // In UsersController.php

    public function resetPassword()
    {
        if ($this->request->is('post')) {
            // Process the email entered by the user
            $email = $this->request->getData('email');
            $user = $this->Users->findByEmail($email)->first();

            if ($user) {
                // Generate the reset token and expiration time
                $token = Security::hash(Text::uuid(), 'sha256', true);
                $user->password_reset_token = $token;
                $user->password_reset_expires = new Time('+1 hour');
                $this->Users->save($user);

                // Send email with reset link
                $resetLink = Router::url(
                    [
                        'controller' => 'Users',
                        'action' => 'resetPasswordConfirm',
                        $token,
                    ],
                    true
                );
                // Send the email with the link (use your mailer setup here)
                // You might use Email::deliver or a custom email class

                $this->Flash->success(
                    'Check your email for a password reset link.'
                );
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error('No user found with that email address.');
            }
        }
    }

    // UsersController.php
    public function resetPasswordConfirm($token = null)
    {
        if (!$token) {
            $this->Flash->error('Invalid token.');
            return $this->redirect(['action' => 'login']);
        }

        // Look for the user by reset token
        $user = $this->Users
            ->find()
            ->where([
                'password_reset_token' => $token,
                'password_reset_expires >' => new Time(),
            ])
            ->first();

        if (!$user) {
            $this->Flash->error('Invalid or expired token.');
            return $this->redirect(['action' => 'login']);
        }

        if ($this->request->is('post')) {
            // Save the new password
            $user = $this->Users->patchEntity(
                $user,
                $this->request->getData(),
                [
                    'validate' => 'password',
                ]
            );

            if ($this->Users->save($user)) {
                // Clear the reset token and expiration time
                $user->password_reset_token = null;
                $user->password_reset_expires = null;
                $this->Users->save($user);

                $this->Flash->success('Your password has been reset.');
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(
                    'There was an error resetting your password.'
                );
            }
        }

        $this->set(compact('user'));
    }
}
