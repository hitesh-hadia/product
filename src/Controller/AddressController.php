<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Address Controller
 *
 * @property \App\Model\Table\AddressTable $Address
 *
 * @method \App\Model\Entity\Addres[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AddressController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function initialize()
    {
        parent::initialize();
        $this->Customer = $this->request->session()->read('Auth.Customers');
        
    }
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers'],
        ];
        $address = $this->paginate($this->Address->find()
                    ->where(['customer_id' => $this->Customer['id']])
                    ->order(['Address.id' => 'DESC']));

        $this->set(compact('address'));
    }

    /**
     * View method
     *
     * @param string|null $id Addres id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $addres = $this->Address->find()
                    ->where(['customer_id' => $this->Customer['id']])
                    ->contain(['Customers'])
                    ->first();
        $this->set('addres', $addres);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $addres = $this->Address->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['customer_id'] = $this->Customer['id'];
            $addres = $this->Address->patchEntity($addres, $data);
            if ($this->Address->save($addres)) {
                $this->Flash->success(__('The addres has been saved.'));
                // return $this->redirect($this->referer());
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The addres could not be saved. Please, try again.'));
        }
        $customers = $this->Address->Customers->find('list', ['limit' => 200]);
        $this->set(compact('addres', 'customers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Addres id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $addres = $this->Address->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $addres = $this->Address->patchEntity($addres, $this->request->getData());
            if ($this->Address->save($addres)) {
                $this->Flash->success(__('The addres has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The addres could not be saved. Please, try again.'));
        }
        $customers = $this->Address->Customers->find('list', ['limit' => 200]);
        $this->set(compact('addres', 'customers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Addres id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $addres = $this->Address->get($id);
        if ($this->Address->delete($addres)) {
            $this->Flash->success(__('The addres has been deleted.'));
        } else {
            $this->Flash->error(__('The addres could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
