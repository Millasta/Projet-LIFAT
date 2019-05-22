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
		$this->set('searchLabelExtra', "nom du lieu");

		$query = $this->LieuTravails
			// Use the plugins 'search' custom finder and pass in the
			// processed query params
			->find('search', ['search' => $this->request->getQueryParams()]);

		$this->set('lieuTravails', $this->paginate($query));
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
     * Edit method ; if $id is null it behaves like an add method instead.
     *
     * @param string|null $id Lieu Travail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if ($id == null)
            $lieuTravail = $this->LieuTravails->newEntity();
        else
            $lieuTravail = $this->LieuTravails->get($id, [
                'contain' => []
            ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lieuTravail = $this->LieuTravails->patchEntity($lieuTravail, $this->request->getData());
            if ($this->LieuTravails->save($lieuTravail)) {
                $this->Flash->success(__('Le lieu de travail a été ajouté avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('L\'ajout du lieu de travail a échoué. Merci de ré-essayer.'));
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
            $this->Flash->success(__('Le lieu de travail à été supprimé.'));
        } else {
            $this->Flash->error(__('La suppression du lieu de travail à échoué.'));
        }

        return $this->redirect(['action' => 'index']);
    }

	/*
	 * Autorisations (isAuthorized()) : rien de plus, donc seul l'admin peut modifier / supprimer les lieux de travail.
	 */
}
