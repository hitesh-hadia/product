<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Carts Controller
 *
 * @property \App\Model\Table\CartsTable $Carts
 *
 * @method \App\Model\Entity\Cart[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CartsController extends AppController
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
            'contain' => ['Customers', 'Products'],
        ];
        $carts = $this->paginate($this->Carts->find()
                    ->where(['customer_id' => $this->Customer['id']])
                    ->order(['Carts.id' => 'DESC']));

        $this->set(compact('carts'));
    }

    /**
     * View method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cart = $this->Carts->find()
                    ->where(['Carts.id' => $id])
                    ->where(['customer_id' => $this->Customer['id']])
                    ->contain(['Customers', 'Products'])
                    ->order(['Carts.id' => 'DESC']);

        $this->set('cart', $cart);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addtocart($id = null)
    {
        $product = $this->Carts->find()
                            ->where(['product_id' => $id])
                            ->first();
        if(empty($product)){
            $this->loadModel('Products');
            $product = $this->Products->get($id);
            $data['customer_id'] = $this->Customer['id'];
            $data['product_id'] = $id;
            $data['quantity'] = 1;
            $data['price'] = $product->price;
            $data['amount'] = $product->price;
            $cart = $this->Carts->newEntity($data);
            if ($this->Carts->save($cart)) {
            // dd($this->Carts->save($cart));
                $this->Flash->success(__('The cart has been saved.'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The cart could not be saved. Please, try again.'));
        }else{
            // dd($product,$product->price);
            $data['quantity'] = $product->quantity + 1;
            $data['amount'] = $product->amount + $product->price;
            $cart = $this->Carts->patchEntity($product, $data);
            if ($this->Carts->save($cart)) {

                return $this->redirect($this->referer());
            }
        }
        return $this->redirect($this->referer());
    }

    public function quantity($id = null,$dataoperation = null)
    {
        // dd($id,$dataoperation);
        $product = $this->Carts->find()
                            ->where(['id' => $id])
                            ->first();
        if($dataoperation == 'increment'){
            $data['quantity'] = $product->quantity + 1;
            $data['amount'] = $product->amount + $product->price;
            $cart = $this->Carts->patchEntity($product, $data);
            if ($this->Carts->save($cart)) {
                $product = $this->Carts->find()
                            ->where(['id' => $id])
                            ->first();
                $this->response->body(json_encode($product));
                return $this->response;
            }
            $this->Flash->error(__('The cart could not be saved. Please, try again.'));
        }
        elseif($dataoperation == 'decrement')
        {
            // dd($product,$product->price);
            if($product->quantity > 1){
                $data['quantity'] = $product->quantity - 1;
                $data['amount'] = $product->amount - $product->price;
                $cart = $this->Carts->patchEntity($product, $data);
                if ($this->Carts->save($cart)) {
                    $product = $this->Carts->find()
                                ->where(['id' => $id])
                                ->first();
                    $this->response->body(json_encode($product));
                    return $this->response;
                }
            }else{
                $product = $this->Carts->find()
                                ->where(['id' => $id])
                                ->first();
                $this->response->body(json_encode($product));
                return $this->response;
            }
        }
        return $this->redirect($this->referer());
    }
    // public function add()
    // {
    //     $cart = $this->Carts->newEntity();
    //     if ($this->request->is('post')) {
    //         $cart = $this->Carts->patchEntity($cart, $this->request->getData());
    //         if ($this->Carts->save($cart)) {
    //             $this->Flash->success(__('The cart has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The cart could not be saved. Please, try again.'));
    //     }
    //     $customers = $this->Carts->Customers->find('list', ['limit' => 200]);
    //     $products = $this->Carts->Products->find('list', ['limit' => 200]);
    //     $this->set(compact('cart', 'customers', 'products'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cart = $this->Carts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cart = $this->Carts->patchEntity($cart, $this->request->getData());
            if ($this->Carts->save($cart)) {
                $this->Flash->success(__('The cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cart could not be saved. Please, try again.'));
        }
        $customers = $this->Carts->Customers->find('list', ['limit' => 200]);
        $products = $this->Carts->Products->find('list', ['limit' => 200]);
        $this->set(compact('cart', 'customers', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cart = $this->Carts->get($id);
        if ($this->Carts->delete($cart)) {
            $this->Flash->success(__('The cart has been deleted.'));
        } else {
            $this->Flash->error(__('The cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
