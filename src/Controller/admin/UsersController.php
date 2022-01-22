<?php

namespace App\Controller\Admin;

use Cake\Controller\Controller;
use App\Controller\AppController;
// use Cake\Auth\DefaultPasswordHasher;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function initialize()
    {
        parent::initialize();
        //$this->viewBuilder()->setLayout('admin');
    }
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login(){
        if ($this->request->session()->read('Auth.User'))
        {
           return $this->redirect($this->Auth->redirectUrl('/admin/users'));
        } else {
            if ($this->request->is('post'))
            {
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    //debug($this->getRequest()->getSession()->read('Auth.User'));exit;
                    return $this->redirect($this->Auth->redirectUrl('/admin/users'));
                }else {
                    $this->Flash->error(__('Username or password is incorrect'));
                }
            }
        }
    }
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    public function resetPassword($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $user = $this->Users->get($this->Auth->user('id'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, [  
                    'current_password'=> $this->request->data['current_password'], 
                    'password'=> $this->request->data['password'], 
                    'confirm_password'=> $this->request->data['confirm_password'] 
                ],  
                ['validate' => 'password']  
            );
            if($user->errors()){
                $error_msg = [];
                foreach( $user->errors() as $errors){
                    if(is_array($errors)){
                        foreach($errors as $error){
                            $error_msg[]    =   $error;
                        }
                    }else{
                        $error_msg[]    =   $errors;
                    }
                }

                if(!empty($error_msg)){
                    $this->Flash->error(
                        __("Please fix the following error(s): \n".implode("\n \r", $error_msg))
                    );
                }
            } else {
                if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved password.'));
                return $this->redirect(['action' => 'index']);
                //return $this->redirect($this->Auth->logout());
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }
            
        }
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
        $this->set(compact('user'));
    }
    
}
