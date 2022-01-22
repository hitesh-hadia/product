<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OrderDetails Controller
 *
 * @property \App\Model\Table\OrderDetailsTable $OrderDetails
 *
 * @method \App\Model\Entity\OrderDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function initialize()
    {
        parent::initialize();
        $this->customerId = $this->request->session()->read('Auth.Customers.id');
    }
    public function index()
    {
        return $this->redirect(['controller' => 'Orders', 'action' => 'index']);
        // $this->paginate = [
        //     'contain' => ['Orders', 'Products'],
        // ];
        // $orderDetails = $this->paginate($this->OrderDetails);

        // $this->set(compact('orderDetails'));
    }

    public function orderdetails($id = null)
    {
        $this->paginate = [
            'contain' => ['Orders' => array('Address'), 'Products' => array('ProductImages')],
        ];
        $orderDetails = $this->paginate($this->OrderDetails->find()
                             ->where(['OrderDetails.order_id' => $id])
                             ->where(['Orders.customer_id' => $this->customerId]));
        // dd($orderDetails);
        $this->set(compact('orderDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Detail id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderDetail = $this->OrderDetails->get($id, [
            'contain' => ['Orders', 'Products'],
        ]);

        $this->set('orderDetail', $orderDetail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderDetail = $this->OrderDetails->newEntity();
        if ($this->request->is('post')) {
            $orderDetail = $this->OrderDetails->patchEntity($orderDetail, $this->request->getData());
            if ($this->OrderDetails->save($orderDetail)) {
                $this->Flash->success(__('The order detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order detail could not be saved. Please, try again.'));
        }
        $orders = $this->OrderDetails->Orders->find('list', ['limit' => 200]);
        $products = $this->OrderDetails->Products->find('list', ['limit' => 200]);
        $this->set(compact('orderDetail', 'orders', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Detail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderDetail = $this->OrderDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderDetail = $this->OrderDetails->patchEntity($orderDetail, $this->request->getData());
            if ($this->OrderDetails->save($orderDetail)) {
                $this->Flash->success(__('The order detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order detail could not be saved. Please, try again.'));
        }
        $orders = $this->OrderDetails->Orders->find('list', ['limit' => 200]);
        $products = $this->OrderDetails->Products->find('list', ['limit' => 200]);
        $this->set(compact('orderDetail', 'orders', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Detail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderDetail = $this->OrderDetails->get($id);
        if ($this->OrderDetails->delete($orderDetail)) {
            $this->Flash->success(__('The order detail has been deleted.'));
        } else {
            $this->Flash->error(__('The order detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
