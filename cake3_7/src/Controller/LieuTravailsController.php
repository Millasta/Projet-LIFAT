<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LieuTravails Controller
 *
 * @property \App\Model\Table\LieuTravailsTable $LieuTravails
 *
 * @method \App\Model\Entity\LieuTravail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LieuTravailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $lieuTravails = $this->paginate($this->LieuTravails);

        $this->set(compact('lieuTravails'));
    }

    /**
     * View method
     *
     * @param string|null $id Lieu Travail id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lieuTravail = $this->LieuTravails->get($id, [
            'contain' => ['Membres']
        ]);

        $this->set('lieuTravail', $lieuTravail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lieuTravail = $this->LieuTravails->newEntity();
        if ($this->request->is('post')) {
            $lieuTravail = $this->LieuTravails->patchEntity($lieuTravail, $this->request->getData());
            if ($this->LieuTravails->save($lieuTravail)) {
                $this->Flash->success(__('The lieu travail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lieu travail could not be saved. Please, try again.'));
        }
        $this->set(compact('lieuTravail'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lieu Travail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lieuTravail = $this->LieuTravails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lieuTravail = $this->LieuTravails->patchEntity($lieuTravail, $this->request->getData());
            if ($this->LieuTravails->save($lieuTravail)) {
                $this->Flash->success(__('The lieu travail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lieu travail could not be saved. Please, try again.'));
        }
        $this->set(compact('lieuTravail'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lieu Travail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lieuTravail = $this->LieuTravails->get($id);
        if ($this->LieuTravails->delete($lieuTravail)) {
            $this->Flash->success(__('The lieu travail has been deleted.'));
        } else {
            $this->Flash->error(__('The lieu travail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
