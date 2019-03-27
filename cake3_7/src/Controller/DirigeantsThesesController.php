<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DirigeantsTheses Controller
 *
 * @property \App\Model\Table\DirigeantsThesesTable $DirigeantsTheses
 *
 * @method \App\Model\Entity\DirigeantsThesis[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DirigeantsThesesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Dirigeants', 'Theses']
        ];
        $dirigeantsTheses = $this->paginate($this->DirigeantsTheses);

        $this->set(compact('dirigeantsTheses'));
    }

    /**
     * View method
     *
     * @param string|null $id Dirigeants Thesis id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dirigeantsThesis = $this->DirigeantsTheses->get($id, [
            'contain' => ['Dirigeants', 'Theses']
        ]);

        $this->set('dirigeantsThesis', $dirigeantsThesis);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dirigeantsThesis = $this->DirigeantsTheses->newEntity();
        if ($this->request->is('post')) {
            $dirigeantsThesis = $this->DirigeantsTheses->patchEntity($dirigeantsThesis, $this->request->getData());
            if ($this->DirigeantsTheses->save($dirigeantsThesis)) {
                $this->Flash->success(__('The dirigeants thesis has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dirigeants thesis could not be saved. Please, try again.'));
        }
        $dirigeants = $this->DirigeantsTheses->Dirigeants->find('list', ['limit' => 200]);
        $theses = $this->DirigeantsTheses->Theses->find('list', ['limit' => 200]);
        $this->set(compact('dirigeantsThesis', 'dirigeants', 'theses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dirigeants Thesis id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dirigeantsThesis = $this->DirigeantsTheses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dirigeantsThesis = $this->DirigeantsTheses->patchEntity($dirigeantsThesis, $this->request->getData());
            if ($this->DirigeantsTheses->save($dirigeantsThesis)) {
                $this->Flash->success(__('The dirigeants thesis has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dirigeants thesis could not be saved. Please, try again.'));
        }
        $dirigeants = $this->DirigeantsTheses->Dirigeants->find('list', ['limit' => 200]);
        $theses = $this->DirigeantsTheses->Theses->find('list', ['limit' => 200]);
        $this->set(compact('dirigeantsThesis', 'dirigeants', 'theses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dirigeants Thesis id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dirigeantsThesis = $this->DirigeantsTheses->get($id);
        if ($this->DirigeantsTheses->delete($dirigeantsThesis)) {
            $this->Flash->success(__('The dirigeants thesis has been deleted.'));
        } else {
            $this->Flash->error(__('The dirigeants thesis could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
