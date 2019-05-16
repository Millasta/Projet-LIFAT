<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EquipesProjets Controller
 *
 * @property \App\Model\Table\EquipesProjetsTable $EquipesProjets
 *
 * @method \App\Model\Entity\EquipesProjet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EquipesProjetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Equipes', 'Projets']
        ];
        $equipesProjets = $this->paginate($this->EquipesProjets);

        $this->set(compact('equipesProjets'));
    }

    /**
     * View method
     *
     * @param string|null $id Equipes Projet id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $equipesProjet = $this->EquipesProjets->get($id, [
            'contain' => ['Equipes', 'Projets']
        ]);

        $this->set('equipesProjet', $equipesProjet);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $equipesProjet = $this->EquipesProjets->newEntity();
        if ($this->request->is('post')) {
            $equipesProjet = $this->EquipesProjets->patchEntity($equipesProjet, $this->request->getData());
            if ($this->EquipesProjets->save($equipesProjet)) {
                $this->Flash->success(__('The equipes projet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The equipes projet could not be saved. Please, try again.'));
        }
        $equipes = $this->EquipesProjets->Equipes->find('list', ['limit' => 200]);
        $projets = $this->EquipesProjets->Projets->find('list', ['limit' => 200]);
        $this->set(compact('equipesProjet', 'equipes', 'projets'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Equipes Projet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipesProjet = $this->EquipesProjets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $equipesProjet = $this->EquipesProjets->patchEntity($equipesProjet, $this->request->getData());
            if ($this->EquipesProjets->save($equipesProjet)) {
                $this->Flash->success(__('The equipes projet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The equipes projet could not be saved. Please, try again.'));
        }
        $equipes = $this->EquipesProjets->Equipes->find('list', ['limit' => 200]);
        $projets = $this->EquipesProjets->Projets->find('list', ['limit' => 200]);
        $this->set(compact('equipesProjet', 'equipes', 'projets'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipes Projet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $equipesProjet = $this->EquipesProjets->get($id);
        if ($this->EquipesProjets->delete($equipesProjet)) {
            $this->Flash->success(__('The equipes projet has been deleted.'));
        } else {
            $this->Flash->error(__('The equipes projet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    
}
