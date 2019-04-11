<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EncadrantsTheses Controller
 *
 * @property \App\Model\Table\EncadrantsThesesTable $EncadrantsTheses
 *
 * @method \App\Model\Entity\EncadrantsTheses[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
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
     * @param string|null $id Encadrants Theses id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $encadrantsTheses = $this->EncadrantsTheses->get($id, [
            'contain' => ['Encadrants', 'Theses']
        ]);

        $this->set('encadrantsTheses', $encadrantsTheses);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $encadrantsTheses = $this->EncadrantsTheses->newEntity();
        if ($this->request->is('post')) {
            $encadrantsTheses = $this->EncadrantsTheses->patchEntity($encadrantsTheses, $this->request->getData());
            if ($this->EncadrantsTheses->save($encadrantsTheses)) {
                $this->Flash->success(__('The encadrants theses has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The encadrants theses could not be saved. Please, try again.'));
        }
        $encadrants = $this->EncadrantsTheses->Encadrants->find('list', ['limit' => 200]);
        $theses = $this->EncadrantsTheses->Theses->find('list', ['limit' => 200]);
        $this->set(compact('encadrantsTheses', 'encadrants', 'theses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Encadrants Theses id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $encadrantsTheses = $this->EncadrantsTheses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $encadrantsTheses = $this->EncadrantsTheses->patchEntity($encadrantsTheses, $this->request->getData());
            if ($this->EncadrantsTheses->save($encadrantsTheses)) {
                $this->Flash->success(__('The encadrants theses has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The encadrants theses could not be saved. Please, try again.'));
        }
        $encadrants = $this->EncadrantsTheses->Encadrants->find('list', ['limit' => 200]);
        $theses = $this->EncadrantsTheses->Theses->find('list', ['limit' => 200]);
        $this->set(compact('encadrantsTheses', 'encadrants', 'theses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Encadrants Theses id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $encadrantsTheses = $this->EncadrantsTheses->get($id);
        if ($this->EncadrantsTheses->delete($encadrantsTheses)) {
            $this->Flash->success(__('The encadrants theses has been deleted.'));
        } else {
            $this->Flash->error(__('The encadrants theses could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
