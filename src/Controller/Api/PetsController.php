<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;

class PetsController extends AppController
{

    var $components = array('Flash');
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $pets = $this->paginate($this->Pets);

        $this->set(compact('pets'));
        $this->set('_serialize', ['pets']);
    }

    /**
     * View method
     *
     * @param string|null $id Pet id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pet = $this->Pets->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('pet', $pet);
        $this->set('_serialize', ['pet']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pet = $this->Pets->newEntity();
        if ($this->request->is('post')) {
            $pet = $this->Pets->patchEntity($pet, $this->request->data);
            if ($this->Pets->save($pet)) {
                $this->Flash->success(__('The pet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pet could not be saved. Please, try again.'));
            }
        }
        $users = $this->Pets->Users->find('list', ['limit' => 200]);
        $this->set(compact('pet', 'users'));
        $this->set('_serialize', ['pet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pet id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pet = $this->Pets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pet = $this->Pets->patchEntity($pet, $this->request->data);
            if ($this->Pets->save($pet)) {
                $this->Flash->success(__('The pet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pet could not be saved. Please, try again.'));
            }
        }
        $users = $this->Pets->Users->find('list', ['limit' => 200]);
        $this->set(compact('pet', 'users'));
        $this->set('_serialize', ['pet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pet id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pet = $this->Pets->get($id);
        if ($this->Pets->delete($pet)) {
            $this->Flash->success(__('The pet has been deleted.'));
        } else {
            $this->Flash->error(__('The pet could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


}