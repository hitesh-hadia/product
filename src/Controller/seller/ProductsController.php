<?php
namespace App\Controller\seller;

use Cake\Controller\Controller;
use App\Controller\AppController;
use File;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    public $sellerId = 0;

    public function initialize()
    {
         parent::initialize();
         $this->sellerId = $this->request->session()->read('Auth.Sellers.id');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sellers'],
        ];
        $products = $this->paginate($this->Products->find()
                    ->where(['seller_id' => $this->sellerId])
                    ->where(['Products.status !=' => 'deleted'])
                    ->order(['Products.id' => 'DESC']));
        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productif = $this->Products->find()
                    ->where(['Products.id' => $id])
                    ->where(['Products.status !=' => 'deleted'])
                    ->where(['seller_id' => $this->sellerId])
                    ->first();
        if(!empty($productif)){
            $product = $this->Products->find()
                        ->where(['Products.id' => $id])
                        ->where(['seller_id' => $this->sellerId])
                        ->contain(['Sellers', 'ProductImages'])
                        ->first();
            $this->set(compact('product'));
        }else{
            $this->Flash->success(__('The product has not your.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            
            $data = $this->request->getData();
           
            $data['seller_id'] = $this->request->session()->read('Auth.Sellers.id');
            $data['status'] = 'pending';
            // dd($this->request->getData());
            $images = $data['image'];
            
            unset($data['image']);
            
            $product = $this->Products->newEntity($data);
            //$product = $this->Products->patchEntity($product, $data);
            if ($result = $this->Products->save($product)) {
                
                $insertedId = $result->id;

                $imagedata = array();
                foreach ($images as $image) 
                {
                    $name = rand(0000000000,9999999999);
                    $fileExt = explode(".", $image['name']);
                    $ext =  end($fileExt);
                    $filename = $name.'.'.$ext;
                    $file_tmp_name = $image['tmp_name'];
                    $dir = WWW_ROOT.'img/product_images';
                    if(is_uploaded_file( $file_tmp_name ) )
                    {
                        if (move_uploaded_file($file_tmp_name, $dir.DS.$filename))
                        {
                            array_push($imagedata,["product_id" => $insertedId, "image" => $filename]);
                        }
                    }
                }
                if($imagedata){
                    $this->loadModel('ProductImages');
                    $productImage = $this->ProductImages->newEntities($imagedata);
                    $this->ProductImages->saveMany($productImage);
                    
                    $this->Flash->success(__('The product has been saved.'));
                    
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $sellers = $this->Products->Sellers->find('list', ['limit' => 200]);
        $this->set(compact('product', 'sellers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productif = $this->Products->find()
                    ->where(['Products.id' => $id])
                    ->where(['seller_id' => $this->sellerId])
                    ->first();
        if(!empty($productif)){
            $product = $this->Products->get($id, [
                'contain' => ['ProductImages'],
            ]);
            // dd($product);
        }else{
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            $data['seller_id'] = $this->request->session()->read('Auth.Sellers.id');

                // dd($data);
            $images = $data['image'];
            
            unset($data['image']);

            $product = $this->Products->patchEntity($product, $data);
            if ($result = $this->Products->save($product)) {
                if(!empty($images)){
                    $insertedId = $result->id;

                    $imagedata = array();
                    foreach ($images as $image) 
                    {
                        $name = rand(0000000000,9999999999);
                        $fileExt = explode(".", $image['name']);
                        $ext =  end($fileExt);
                        $filename = $name.'.'.$ext;
                        $file_tmp_name = $image['tmp_name'];
                        $dir = WWW_ROOT.'img/product_images';
                        if(is_uploaded_file( $file_tmp_name ) )
                        {
                            if (move_uploaded_file($file_tmp_name, $dir.DS.$filename))
                            {
                                array_push($imagedata,["product_id" => $insertedId, "image" => $filename]);
                            }
                        }
                    }
                    if($imagedata){
                        $this->loadModel('ProductImages');
                        $productImage = $this->ProductImages->newEntities($imagedata);
                        $this->ProductImages->saveMany($productImage);
                        
                        $this->Flash->success(__('The product has been saved.'));
                        
                        return $this->redirect(['action' => 'index']);
                    }
                }
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $sellers = $this->Products->Sellers->find('list', ['limit' => 200]);
        $this->set(compact('product', 'sellers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        $data['status'] = 'deleted';
        $product = $this->Products->patchEntity($product, $data);
        if ($this->Products->save($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function imagedelete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
         $this->loadModel('ProductImages');
        $productimage = $this->ProductImages->get($id);
        $image = $productimage->image;
        if ($this->ProductImages->delete($productimage)) {
            $file = WWW_ROOT . 'img/product_images/' . $image;
            if(file_exists($file)) {
                unlink($file);
            }
            $this->Flash->success(__('The product Image has been deleted.'));
        } else {
            $this->Flash->error(__('The product Image could not be deleted. Please, try again.'));
        }
        // dd($this->referer());
        return $this->redirect($this->referer());
    }

    public function duplicate($id = null)
    {
        $productif = $this->Products->find()
                    ->where(['Products.id' => $id])
                    ->where(['seller_id' => $this->sellerId])
                    ->first();
        if(!empty($productif)){
            $product = $this->Products->get($id, [
                'contain' => ['ProductImages'],
            ]);
            // dd($product);
        }else{
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            $data['seller_id'] = $this->request->session()->read('Auth.Sellers.id');
            $data['status'] = 'pending';
            $images = $data['image'];
            
            unset($data['image']);

            $product = $this->Products->newEntity($data);

            if ($result = $this->Products->save($product)) {
                if(!empty($images)){
                    $insertedId = $result->id;

                    $imagedata = array();
                    foreach ($images as $image) 
                    {
                        $name = rand(0000000000,9999999999);
                        $fileExt = explode(".", $image['name']);
                        $ext =  end($fileExt);
                        $filename = $name.'.'.$ext;
                        $file_tmp_name = $image['tmp_name'];
                        $dir = WWW_ROOT.'img/product_images';
                        if(is_uploaded_file( $file_tmp_name ) )
                        {
                            if (move_uploaded_file($file_tmp_name, $dir.DS.$filename))
                            {
                                array_push($imagedata,["product_id" => $insertedId, "image" => $filename]);
                            }
                        }
                    }
                    if($imagedata){
                        $this->loadModel('ProductImages');
                        $productImage = $this->ProductImages->newEntities($imagedata);
                        $this->ProductImages->saveMany($productImage);
                        
                        $this->Flash->success(__('The product has been saved.'));
                        
                        return $this->redirect(['action' => 'index']);
                    }
                }
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $sellers = $this->Products->Sellers->find('list', ['limit' => 200]);
        $this->set(compact('product', 'sellers'));
    }

}
