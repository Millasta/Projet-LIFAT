<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EncadrantsTheses Controller
 *
 * @property \App\Model\Table\EncadrantsThesesTable $EncadrantsTheses
 *
 * @method \App\Model\Entity\EncadrantsThesis[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EncadrantsThesesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Encadrants', 'Theses']
        ];
        $encadrantsTheses = $this->paginate($this->EncadrantsTheses);

        $this->set(compact('encadrantsTheses'));
    }

    /**
     * View method
     *
     * @param string|null $id Encadrants Thesis id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $encadrantsThesis = $this->EncadrantsTheses->get($id, [
            'contain' => ['Encadrants', 'Theses']
        ]);

        $this->set('encadrantsThesis', $encadrantsThesis);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $encadrantsThesis = $this->EncadrantsTheses->newEntity();
        if ($this->request->is('post')) {
            $encadrantsThesis = $this->EncadrantsTheses->patchEntity($encadrantsThesis, $this->request->getData());
            if ($this->EncadrantsTheses->save($encadrantsThesis)) {
                $this->Flash->success(__('The encadrants thesis has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The encadrants thesis could not be saved. Please, try again.'));
        }
        $encadrants = $this->EncadrantsTheses->Encadrants->find('list', ['limit' => 200]);
        $theses = $this->EncadrantsTheses->Theses->find('list', ['limit' => 200]);
        $this->set(compact('encadrantsThesis', 'encadrants', 'theses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Encadrants Thesis id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $encadrantsThesis = $this->EncadrantsTheses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $encadrantsThesis = $this->EncadrantsTheses->patchEntity($encadrantsThesis, $this->request->getData());
            if ($this->EncadrantsTheses->save($encadrantsThesis)) {
                $this->Flash->success(__('The encadrants thesis has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The encadrants thesis could not be saved. Please, try again.'));
        }
        $encadrants = $this->EncadrantsTheses->Encadrants->find('list', ['limit' => 200]);
        $theses = $this->EncadrantsTheses->Theses->find('list', ['limit' => 200]);
        $this->set(compact('encadrantsThesis', 'encadrants', 'theses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Encadrants Thesis id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $encadrantsThesis = $this->EncadrantsTheses->get($id);
        if ($this->EncadrantsTheses->delete($encadrantsThesis)) {
            $this->Flash->success(__('The encadrants thesis has been deleted.'));
        } else {
            $this->Flash->error(__('The encadrants thesis could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
