<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Theses Controller
 *
 * @property \App\Model\Table\ThesesTable $Theses
 *
 * @method \App\Model\Entity\Theses[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ThesesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Membres']
        ];
        $theses = $this->paginate($this->Theses);

        $this->set(compact('theses'));
    }

    /**
     * View method
     *
     * @param string|null $id Theses id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $theses = $this->Theses->get($id, [
            'contain' => ['Membres', 'Dirigeants', 'Encadrants']
        ]);

        $this->set('theses', $theses);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $theses = $this->Theses->newEntity();
        if ($this->request->is('post')) {
            $theses = $this->Theses->patchEntity($theses, $this->request->getData(), ['associated' => ['Encadrants', 'Dirigeants']]);
            if ($this->Theses->save($theses)) {
                $this->Flash->success(__('The theses has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The theses could not be saved. Please, try again.'));
        }
        $membres = $this->Theses->Membres->find('list', ['limit' => 200]);
        $dirigeants = $this->Theses->Dirigeants->find('list', ['limit' => 200]);
        $encadrants = $this->Theses->Encadrants->find('list', ['limit' => 200]);
        $this->set(compact('theses', 'membres', 'dirigeants', 'encadrants'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Theses id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $theses = $this->Theses->get($id, [
            'contain' => ['Dirigeants', 'Encadrants']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $theses = $this->Theses->patchEntity($theses, $this->request->getData());
            if ($this->Theses->save($theses)) {
                $this->Flash->success(__('The theses has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The theses could not be saved. Please, try again.'));
        }
        $membres = $this->Theses->Membres->find('list', ['limit' => 200]);
        $dirigeants = $this->Theses->Dirigeants->find('list', ['limit' => 200]);
        $encadrants = $this->Theses->Encadrants->find('list', ['limit' => 200]);
        $this->set(compact('theses', 'membres', 'dirigeants', 'encadrants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Theses id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $theses = $this->Theses->get($id);
        if ($this->Theses->delete($theses)) {
            $this->Flash->success(__('The theses has been deleted.'));
        } else {
            $this->Flash->error(__('The theses could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
