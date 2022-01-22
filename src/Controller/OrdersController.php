<?php
namespace App\Controller;

use App\Controller\AppController;
use Razorpay\Api\Api;
/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
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
        $orders = $this->paginate($this->Orders->find()
                    ->where(['customer_id' => $this->Customer['id']])
                    ->order(['Orders.id' => 'DESC']));

        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->find()
                        ->where(['Orders.id' => $id])
                        ->where(['customer_id' => $this->Customer['id']])
                        ->contain(['Customers'])
                        ->first();

        $this->set('order', $order);
    }

    public function checkout()
    {
        $this->loadModel('Carts');
        $this->loadModel('OrderDetails');
        $this->loadModel('Settings');
        if ($this->request->is('post')) 
        {
            $data = $this->request->getData();
            $data['customer_id'] = $this->request->session()->read('Auth.Customers.id');

            $order = $this->Orders->newEntity($data);
            if ($result = $this->Orders->save($order)) 
            {
                $order_id = $result->id;
                $carts = $this->Carts->find()
                              ->where(['customer_id' => $this->Customer['id']])
                              ->all();
                foreach ($carts as $key => $cart) 
                {
                    $Orderdata =array();
                    $Orderdata['order_id'] = $order_id;
                    $Orderdata['product_id'] = $cart->product_id;
                    $Orderdata['amount'] = $cart->amount;
                    $Orderdata['quantity'] = $cart->quantity;
                    $orderDetail = $this->OrderDetails->newEntity($Orderdata);
                    if($this->OrderDetails->save($orderDetail))
                    {
                        $this->Carts->delete($cart);
                    }
                }
                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }

        $razorPaySettings = $this->Settings->find('all')
                                 ->where(['s_key IN' => ['razorpay_status','razorpay_key_id', 'razorpay_key_secret']])
                                 ->all();

        $paymentSetings = [];
        if($razorPaySettings)
        {
            foreach ($razorPaySettings as $key => $value) 
            {
                $paymentSetings[$value->s_key] = $value->s_value;
            }
        }

        $carts = $this->Carts->find()
                      ->where(['customer_id' => $this->Customer['id']])
                      ->all();
        $amount = 0 ;
        foreach ($carts as $key => $cart) 
        {
            $amount = $amount + $cart->amount;
        }
        $api = new Api($paymentSetings['razorpay_key_id'], $paymentSetings['razorpay_key_secret']);
        $orderData = [
            'receipt'         => 'rcptid_11',
            'amount'          => $amount*100, // 39900 rupees in paise
            'currency'        => 'INR'
        ];

        $razorpayOrder = $api->order->create($orderData);
        $Customers = $this->Customer;
        $Address = $this->Orders->Address->find()
                                ->where(['customer_id' => $this->Customer['id']])
                                ->all();

        $this->set(compact('razorpayOrder','Customers','paymentSetings','Address'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $order = $this->Orders->newEntity();
    //     if ($this->request->is('post')) {
    //         $order = $this->Orders->patchEntity($order, $this->request->getData());
    //         if ($this->Orders->save($order)) {
    //             $this->Flash->success(__('The order has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The order could not be saved. Please, try again.'));
    //     }
    //     $customers = $this->Orders->Customers->find('list', ['limit' => 200]);
    //     $this->set(compact('order', 'customers'));
    // }

    // /**
    //  * Edit method
    //  *
    //  * @param string|null $id Order id.
    //  * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function edit($id = null)
    // {
    //     $order = $this->Orders->get($id, [
    //         'contain' => [],
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $order = $this->Orders->patchEntity($order, $this->request->getData());
    //         if ($this->Orders->save($order)) {
    //             $this->Flash->success(__('The order has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The order could not be saved. Please, try again.'));
    //     }
    //     $customers = $this->Orders->Customers->find('list', ['limit' => 200]);
    //     $this->set(compact('order', 'customers'));
    // }

    // /**
    //  * Delete method
    //  *
    //  * @param string|null $id Order id.
    //  * @return \Cake\Http\Response|null Redirects to index.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $order = $this->Orders->get($id);
    //     if ($this->Orders->delete($order)) {
    //         $this->Flash->success(__('The order has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The order could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }
}
