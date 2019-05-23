<?php

namespace App\Controller;

use App\Model\Entity\Mission;
use App\Model\Table\MissionsTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;

/**
 * Missions Controller
 *
 * @property MissionsTable $Missions
 *
 * @method Mission[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class MissionsController extends AppController
{
	/**
	 * Index method
	 *
	 * @return Response|void
	 */
	public function index()
	{
		$this->paginate = [
			'contain' => ['Projets', 'Lieus', 'Motifs']
		];
		$missions = $this->paginate($this->Missions);

		$this->set(compact('missions'));
	}

	/**
	 * View method
	 *
	 * @param string|null $id Mission id.
	 * @return Response|void
	 * @throws RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$mission = $this->Missions->get($id, [
			'contain' => ['Projets', 'Lieus', 'Motifs', 'Transports']
		]);

		$this->set('mission', $mission);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Mission id.
	 * @return Response|null Redirects on successful edit, renders view otherwise.
	 * @throws RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		if ($id == null)
			$mission = $this->Missions->newEntity();
		else
			$mission = $this->Missions->get($id, [
				'contain' => ['Transports']
			]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$mission = $this->Missions->patchEntity($mission, $this->request->getData());
			if ($this->Missions->save($mission)) {
				$this->Flash->success(__('The mission has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The mission could not be saved. Please, try again.'));
		}
		$projets = $this->Missions->Projets->find('list', ['limit' => 200]);
		$lieus = $this->Missions->Lieus->find('list', ['limit' => 200]);
		$motifs = $this->Missions->Motifs->find('list', ['limit' => 200]);
		$transports = $this->Missions->Transports->find('list', ['limit' => 200]);
		$this->set(compact('mission', 'projets', 'lieus', 'motifs', 'transports'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Mission id.
	 * @return Response|null Redirects to index.
	 * @throws RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$mission = $this->Missions->get($id);
		if ($this->Missions->delete($mission)) {
			$this->Flash->success(__('The mission has been deleted.'));
		} else {
			$this->Flash->error(__('The mission could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
