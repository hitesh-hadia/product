<?php
namespace App\Controller\admin;

use Cake\Controller\Controller;
use App\Controller\AppController;

/**
 * SubCategories Controller
 *
 * @property \App\Model\Table\SubCategoriesTable $SubCategories
 *
 * @method \App\Model\Entity\SubCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories'],
        ];
        $subCategories = $this->paginate($this->SubCategories);

        $this->set(compact('subCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Sub Category id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subCategory = $this->SubCategories->get($id, [
            'contain' => ['Categories'],
        ]);

        $this->set('subCategory', $subCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subCategory = $this->SubCategories->newEntity();
        if ($this->request->is('post')) {
            $subCategory = $this->SubCategories->patchEntity($subCategory, $this->request->getData());
            if ($this->SubCategories->save($subCategory)) {
                $this->Flash->success(__('The sub category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sub category could not be saved. Please, try again.'));
        }
        $categories = $this->SubCategories->Categories->find('list', ['limit' => 200]);
        $this->set(compact('subCategory', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sub Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subCategory = $this->SubCategories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subCategory = $this->SubCategories->patchEntity($subCategory, $this->request->getData());
            if ($this->SubCategories->save($subCategory)) {
                $this->Flash->success(__('The sub category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sub category could not be saved. Please, try again.'));
        }
        $categories = $this->SubCategories->Categories->find('list', ['limit' => 200]);
        $this->set(compact('subCategory', 'categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sub Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subCategory = $this->SubCategories->get($id);
        if ($this->SubCategories->delete($subCategory)) {
            $this->Flash->success(__('The sub category has been deleted.'));
        } else {
            $this->Flash->error(__('The sub category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function subCategory($id =null)
    {
        $subcategorie = $this->SubCategories->find('list')
                    ->where(['categorie_id' => $id]);
        $data = '';
        if(!empty($subcategorie)){
            $data = $subcategorie->toArray();
        }
        $this->response->body(json_encode($data));
        return $this->response;
    }
}
