<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Financements Controller
 *
 * @property \App\Model\Table\FinancementsTable $Financements
 *
 * @method \App\Model\Entity\Financement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FinancementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $financements = $this->paginate($this->Financements);

        $this->set(compact('financements'));
    }

    /**
     * View method
     *
     * @param string|null $id Financement id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $financement = $this->Financements->get($id, [
            'contain' => ['Projets']
        ]);

        $this->set('financement', $financement);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    /*
    public function add()
    {
        $financement = $this->Financements->newEntity();
        if ($this->request->is('post')) {
            $financement = $this->Financements->patchEntity($financement, $this->request->getData());
            if ($this->Financements->save($financement)) {
                $this->Flash->success(__('The financement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The financement could not be saved. Please, try again.'));
        }
        $this->set(compact('financement'));
    }
    */

    /**
     * Edit method
     *
     * @param string|null $id Financement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($id == null)
            $financement = $this->Financements->newEntity();
        else
            $financement = $this->Financements->get($id, [
                'contain' => []
            ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $financement = $this->Financements->patchEntity($financement, $this->request->getData());
            if ($this->Financements->save($financement)) {
                $this->Flash->success(__('The financement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The financement could not be saved. Please, try again.'));
        }
        $this->set(compact('financement'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Financement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $financement = $this->Financements->get($id);
        if ($this->Financements->delete($financement)) {
            $this->Flash->success(__('The financement has been deleted.'));
        } else {
            $this->Flash->error(__('The financement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
