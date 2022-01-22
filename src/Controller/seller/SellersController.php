<?php
namespace App\Controller\seller;

use Cake\Controller\Controller;
use App\Controller\AppController;

/**
 * Sellers Controller
 *
 * @property \App\Model\Table\SellersTable $Sellers
 *
 * @method \App\Model\Entity\Seller[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SellersController extends AppController
{

    public $paginate = [
        'limit' => 25,
        /*'order' => [
            'Articles.title' => 'asc'
        ]*/
    ];

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['signup']);
        $this->sellerId = $this->request->session()->read('Auth.Sellers.id');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {

        $sellers = $this->paginate($this->Sellers->find()
                    ->where(['id' => $this->sellerId]));

        $this->set(compact('sellers'));
    }

    /**
     * View method
     *
     * @param string|null $id Seller id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $seller = $this->Sellers->get($this->sellerId, [
        'contain' => [],
        ]);
        $this->set('seller', $seller);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $seller = $this->Sellers->newEntity();
    //     if ($this->request->is('post')) {
    //         $seller = $this->Sellers->patchEntity($seller, $this->request->getData());
    //         if ($this->Sellers->save($seller)) {
    //             $this->Flash->success(__('The seller has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The seller could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('seller'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id Seller id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $seller = $this->Sellers->get($this->sellerId, [
            'contain' => [],
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $seller = $this->Sellers->patchEntity($seller, $this->request->getData());
            if ($this->Sellers->save($seller)) {
                $this->Flash->success(__('The seller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The seller could not be saved. Please, try again.'));
        }
        $this->set(compact('seller'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Seller id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $seller = $this->Sellers->get($id);
    //     if ($this->Sellers->delete($seller)) {
    //         $this->Flash->success(__('The seller has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The seller could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }

    public function login(){
        if ($this->request->session()->read('Auth.Sellers'))
        {
           return $this->redirect($this->Auth->redirectUrl('/seller/sellers'));
        } else {
            if ($this->request->is('post'))
            {
                $seller = $this->Auth->identify();
                if ($seller) {
                    if($seller['status'] != 'active'){
                        $this->Flash->error(__('Your User Id is '.$seller['status']));
                        // return $this->redirect($this->Auth->logout());
                    }else{
                        $this->Auth->setUser($seller);
                        return $this->redirect($this->Auth->redirectUrl('/seller/sellers'));
                    }
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
        $seller = $this->Sellers->get($id, [
            'contain' => [],
        ]);
        $seller = $this->Sellers->get($this->request->session()->read('Auth.Sellers.id'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $seller = $this->Sellers->patchEntity($seller, [  
                    'current_password'=> $this->request->data['current_password'], 
                    'password'=> $this->request->data['password'], 
                    'confirm_password'=> $this->request->data['confirm_password'] 
                ],  
                ['validate' => 'password']  
            );
            if($seller->errors()){
                $error_msg = [];
                foreach( $seller->errors() as $errors){
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
                if ($this->Sellers->save($seller)) {
                $this->Flash->success(__('The seller has been saved password.'));
                return $this->redirect(['action' => 'index']);
                //return $this->redirect($this->Auth->logout());
                } else {
                    $this->Flash->error(__('The seller could not be saved. Please, try again.'));
                }
            }
            
        }
    $this->set(compact('seller'));
    $this->set('_serialize', ['seller']);
        $this->set(compact('seller'));
    }

    public function signup()
    {
        $seller = $this->Sellers->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
           
            $data['status'] = 'pending' ;
            $seller = $this->Sellers->patchEntity($seller, $data);
            if ($this->Sellers->save($seller)) {
                $this->Flash->success(__('The seller has been saved.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The seller could not be saved. Please, try again.'));
        }
        $this->set(compact('seller'));
    }

}
