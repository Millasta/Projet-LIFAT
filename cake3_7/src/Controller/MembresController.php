<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;

/**
 * Membres Controller
 *
 * @property \App\Model\Table\MembresTable $Membres
 *
 * @method \App\Model\Entity\Membre[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MembresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['LieuTravails']
        ];
        $membres = $this->paginate($this->Membres);

        $this->set(compact('membres'));
    }

    /**
     * View method
     *
     * @param string|null $id Membre id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $membre = $this->Membres->get($id, [
            'contain' => ['LieuTravails']
        ]);

        $this->set('membre', $membre);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $membre = $this->Membres->newEntity();
        if ($this->request->is('post')) {
            $membre = $this->Membres->patchEntity($membre, $this->request->getData());
            if ($this->Membres->save($membre)) {
				// Récupération du Membre.id créé
				$query = $this->Membres->find('all')
									->where(['Membres.email =' => $this->request->getData()['email']])
									->limit(1);			
				$membreId = $query->first();
						
				// INSERT dans Dirigeants en Encadrants
				$this->loadModel('Encadrants');
				$this->loadModel('Dirigeants');
				
				$query = $this->Dirigeants->query();
				$query->insert(['dirigeant_id'])->values(['dirigeant_id' => $membreId['id']])->execute();
				
				$query = $this->Encadrants->query();
				$query->insert(['encadrant_id'])->values(['encadrant_id' => $membreId['id']])->execute();
				
				$this->Flash->success(__('The membre has been saved.'));
				
				return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The membre could not be saved. Please, try again.'));
        }
        $lieuTravails = $this->Membres->LieuTravails->find('list', ['limit' => 200]);
        $this->set(compact('membre', 'lieuTravails'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Membre id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $membre = $this->Membres->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $membre = $this->Membres->patchEntity($membre, $this->request->getData());
            if ($this->Membres->save($membre)) {
                $this->Flash->success(__('The membre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The membre could not be saved. Please, try again.'));
        }
        $lieuTravails = $this->Membres->LieuTravails->find('list', ['limit' => 200]);
        $this->set(compact('membre', 'lieuTravails'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Membre id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $membre = $this->Membres->get($id);
        if ($this->Membres->delete($membre)) {
            $this->Flash->success(__('The membre has been deleted.'));
        } else {
            $this->Flash->error(__('The membre could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
