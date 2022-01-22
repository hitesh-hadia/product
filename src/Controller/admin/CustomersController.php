<?php
namespace App\Controller\admin;

use Cake\Controller\Controller;
use App\Controller\AppController;


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
        // $this->Auth->allow(['signup']);
        // $this->customerId = $this->request->session()->read('Auth.Customers.id');
    }
    public function index()
    {

        $customers = $this->paginate($this->Customers->find()
                                ->where(['Customers.status !=' => 'deleted']));
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
        $customer = $this->Customers->get($id, [
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
    // public function edit($id = null)
    // {
    //     $customer = $this->Customers->get($id, [
    //         'contain' => [],
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
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
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        $data['status'] = 'deleted';
        $customer = $this->Customers->patchEntity($customer, $data);
        if ($this->Customers->save($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
  
    public function active($id = null)
    {
        $this->request->allowMethod(['post','get']);
        $customer = $this->Customers->get($id);
        $data['status'] = 'active';
        $customer = $this->Customers->patchEntity($customer, $data);
        if ($this->Customers->save($customer)) {
            $this->Flash->success(__('The customer has been active.'));
        } else {
            $this->Flash->error(__('The customer could not be active. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function pending($id = null)
    {
        $this->request->allowMethod(['post','get']);
        $customer = $this->Customers->get($id);
        $data['status'] = 'pending';
        $customer = $this->Customers->patchEntity($customer, $data);
        if ($this->Customers->save($customer)) {
            $this->Flash->success(__('The customer has been pending.'));
        } else {
            $this->Flash->error(__('The customer could not be pending. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function blocked($id = null)
    {
        $this->request->allowMethod(['post','get']);
        $customer = $this->Customers->get($id);
        $data['status'] = 'blocked';
        $customer = $this->Customers->patchEntity($customer, $data);
        if ($this->Customers->save($customer)) {
            $this->Flash->success(__('The customer has been blocked.'));
        } else {
            $this->Flash->error(__('The customer could not be blocked. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
