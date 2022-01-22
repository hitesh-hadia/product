<?php
namespace App\Controller\admin;

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
        'limit' => 20,
        /*'order' => [
            'Articles.title' => 'asc'
        ]*/
    ];

    public function initialize()
    {
        parent::initialize();
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $seller = $this->Sellers->find()
                    ->where(['sellers.status !=' => 'deleted'])
                    ->contain([
                        'Products'
                    ]);

        $sellers = $this->paginate($seller);
        //dd($sellers);

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
        $seller = $this->Sellers->find()
                    ->where(['sellers.id' => $id])
                    ->contain(['Products'])
                    ->first();
                    // dd($seller);
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
    // public function edit($id = null)
    // {
    //     $seller = $this->Sellers->get($id, [
    //         'contain' => [],
    //     ]);
        
    //     if ($this->request->is(['patch', 'post', 'put'])) {
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
     * Delete method
     *
     * @param string|null $id Seller id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $seller = $this->Sellers->get($id);
        $data['status'] = 'deleted';
        $seller = $this->Sellers->patchEntity($seller, $data);
        if ($this->Sellers->save($seller)) {
            $this->Flash->success(__('The seller has been deleted.'));
        } else {
            $this->Flash->error(__('The seller could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function active($id = null)
    {
        $this->request->allowMethod(['post', 'get']);
        $seller = $this->Sellers->get($id);
        $data['status'] = 'active';
        $seller = $this->Sellers->patchEntity($seller, $data);
        if ($this->Sellers->save($seller)) {
            $this->Flash->success(__('The seller has been active.'));
        } else {
            $this->Flash->error(__('The seller could not be active. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function pending($id = null)
    {
        $this->request->allowMethod(['post', 'get']);
        $seller = $this->Sellers->get($id);
        $data['status'] = 'pending';
        $seller = $this->Sellers->patchEntity($seller, $data);
        if ($this->Sellers->save($seller)) {
            $this->Flash->success(__('The seller has been pending.'));
        } else {
            $this->Flash->error(__('The seller could not be pending. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function blocked($id = null)
    {
        $this->request->allowMethod(['post', 'get']);
        $seller = $this->Sellers->get($id);
        $data['status'] = 'blocked';
        $seller = $this->Sellers->patchEntity($seller, $data);
        if ($this->Sellers->save($seller)) {
            $this->Flash->success(__('The seller has been blocked.'));
        } else {
            $this->Flash->error(__('The seller could not be blocked. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
