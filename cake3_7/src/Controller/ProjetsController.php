<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Projets Controller
 *
 * @property \App\Model\Table\ProjetsTable $Projets
 *
 * @method \App\Model\Entity\Projet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Financements']
        ];
        $projets = $this->paginate($this->Projets);

        $this->set(compact('projets'));
    }

    /**
     * View method
     *
     * @param string|null $id Projet id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projet = $this->Projets->get($id, [
            'contain' => ['Financements', 'Equipes', 'Missions']
        ]);

        $this->set('projet', $projet);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projet = $this->Projets->newEntity();
        if ($this->request->is('post')) {
            $projet = $this->Projets->patchEntity($projet, $this->request->getData());
            if ($this->Projets->save($projet)) {
                $this->Flash->success(__('The projet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projet could not be saved. Please, try again.'));
        }
        $financements = $this->Projets->Financements->find('list', ['limit' => 200]);
        $equipes = $this->Projets->Equipes->find('list', ['limit' => 200]);
        $this->set(compact('projet', 'financements', 'equipes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Projet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projet = $this->Projets->get($id, [
            'contain' => ['Equipes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projet = $this->Projets->patchEntity($projet, $this->request->getData());
            if ($this->Projets->save($projet)) {
                $this->Flash->success(__('The projet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projet could not be saved. Please, try again.'));
        }
        $financements = $this->Projets->Financements->find('list', ['limit' => 200]);
        $equipes = $this->Projets->Equipes->find('list', ['limit' => 200]);
        $this->set(compact('projet', 'financements', 'equipes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Projet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projet = $this->Projets->get($id);
        if ($this->Projets->delete($projet)) {
            $this->Flash->success(__('The projet has been deleted.'));
        } else {
            $this->Flash->error(__('The projet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}