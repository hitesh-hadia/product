<?php
namespace App\Controller\admin;

use Cake\Controller\Controller;
use App\Controller\AppController;

/**
 * Admins Controller
 *
 * @property \App\Model\Table\AdminsTable $Admins
 *
 * @method \App\Model\Entity\Admin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $admins = $this->paginate($this->Admins);
        $this->set(compact('admins'));
        //api response
        $res = array();
        $res['admins'] = $this->paginate($this->Admins);
        $res['code'] = 200;
        $this->set(array(
            'response' => $res,
            '_serialize' => array('response')
        ));
    }

    /**
     * View method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $admin = $this->Admins->get($id, [
            'contain' => [],
        ]);
        $this->set('admin', $admin);
        //api response
        $res = array();
        $res['admin'] = $this->Admins->get($id, [
            'contain' => [],
        ]);

        $res['code'] = 200;
        $this->set(array(
            'response' => $res,
            '_serialize' => array('response')
        ));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $admin = $this->Admins->newEntity();
        if ($this->request->is('post')) {
            $admin = $this->Admins->patchEntity($admin, $this->request->getData());
            if ($this->Admins->save($admin)) {
                $this->Flash->success(__('The admin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin could not be saved. Please, try again.'));
        }
        $this->set(compact('admin'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $admin = $this->Admins->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin = $this->Admins->patchEntity($admin, $this->request->getData());
            if ($this->Admins->save($admin)) {
                $this->Flash->success(__('The admin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin could not be saved. Please, try again.'));
        }
        $this->set(compact('admin'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $admin = $this->Admins->get($id);
        if ($this->Admins->delete($admin)) {
            $this->Flash->success(__('The admin has been deleted.'));
        } else {
            $this->Flash->error(__('The admin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login(){
        if ($this->request->session()->read('Auth.Admins'))
        {
           return $this->redirect($this->Auth->redirectUrl('/admin/admins'));
        } else {
            if ($this->request->is('post'))
            {
                $admin = $this->Auth->identify();
                if ($admin) {
                    $this->Auth->setUser($admin);
                    return $this->redirect($this->Auth->redirectUrl('/admin/admins'));
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
        $admin = $this->Admins->get($id, [
            'contain' => [],
        ]);
        $admin = $this->Admins->get($this->request->session()->read('Auth.Admins.id'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin = $this->Admins->patchEntity($admin, [  
                    'current_password'=> $this->request->data['current_password'], 
                    'password'=> $this->request->data['password'], 
                    'confirm_password'=> $this->request->data['confirm_password'] 
                ],  
                ['validate' => 'password']  
            );
            if($admin->errors()){
                $error_msg = [];
                foreach( $admin->errors() as $errors){
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
                if ($this->Admins->save($admin)) {
                $this->Flash->success(__('The admin has been saved password.'));
                return $this->redirect(['action' => 'index']);
                //return $this->redirect($this->Auth->logout());
                } else {
                    $this->Flash->error(__('The admin could not be saved. Please, try again.'));
                }
            }
            
        }
        $this->set(compact('admin'));
        $this->set('_serialize', ['admin']);
    }
}
