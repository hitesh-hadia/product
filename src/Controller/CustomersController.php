<?php
namespace App\Controller;


/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 *
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['signup']);
        $this->customerId = $this->request->session()->read('Auth.Customers.id');
    }
    public function index()
    {
        $customers = $this->paginate($this->Customers->find()
                    ->where(['id' => $this->customerId]));
        $this->set(compact('customers'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($this->customerId, [
            'contain' => [],
        ]);
        $this->set('customer', $customer);
        }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $customer = $this->Customers->newEntity();
    //     if ($this->request->is('post')) {
    //         $customer = $this->Customers->patchEntity($customer, $this->request->getData());
    //         if ($this->Customers->save($customer)) {
    //             $this->Flash->success(__('The customer has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The customer could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('customer'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($this->customerId, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $customer = $this->Customers->get($id);
    //     if ($this->Customers->delete($customer)) {
    //         $this->Flash->success(__('The customer has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }

    public function login(){
        if ($this->request->session()->read('Auth.Customers'))
        {
           return $this->redirect($this->Auth->redirectUrl('/Customers'));
        } else {
            if ($this->request->is('post'))
            {
                // dd($this->Auth->identify());
                $customer = $this->Auth->identify();
                if ($customer) {
                    if($customer['status'] != 'active'){
                        $this->Flash->error(__('Your User Id is '.$customer['status']));
                        // return $this->redirect($this->Auth->logout());
                    }else{
                        $this->Auth->setUser($customer);
                        return $this->redirect($this->Auth->redirectUrl('/Customers'));
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
        $customer = $this->Customers->get($id, [
            'contain' => [],
        ]);
        $customer = $this->Customers->get($this->request->session()->read('Auth.Customers.id'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, [  
                    'current_password'=> $this->request->data['current_password'], 
                    'password'=> $this->request->data['password'], 
                    'confirm_password'=> $this->request->data['confirm_password'] 
                ],  
                ['validate' => 'password']  
            );
            if($customer->errors()){
                $error_msg = [];
                foreach( $customer->errors() as $errors){
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
                if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved password.'));
                return $this->redirect(['action' => 'index']);
                //return $this->redirect($this->Auth->logout());
                } else {
                    $this->Flash->error(__('The customer could not be saved. Please, try again.'));
                }
            }
            
        }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);
    }

    public function signup()
    {
        $customer = $this->Customers->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
           
            $data['status'] = 'active' ;
            $customer = $this->Customers->patchEntity($customer, $data);
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }
}
