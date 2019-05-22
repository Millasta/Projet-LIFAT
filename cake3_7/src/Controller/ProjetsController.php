<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Projets Controller
 *
 * @property \App\Model\Table\ProjetsTable $Projets
 *
 * @method \App\Model\Entity\Projet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->set('searchLabelExtra', "titre du projet");

		$query = $this->Projets
			// Use the plugins 'search' custom finder and pass in the
			// processed query params
			->find('search', ['search' => $this->request->getQueryParams()]);

		$this->paginate = [
			'contain' => ['Financements']
		];

		$this->set('projets', $this->paginate($query));
    }

    /**
     * View method
     *
     * @param string|null $id Projet id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projet = $this->Projets->get($id, [
            'contain' => ['Financements', 'Equipes', 'Missions']
        ]);

        $this->loadModel('Membres');
        $projet->responsables = array();
        foreach ($projet->equipes as &$equipes) {
            $projet->responsables[] = $this->Membres->get($equipes->responsable_id);
        }

        $this->set('projet', $projet);
    }

    /**
     * Edit method ; if $id is null it behaves like an add method instead.
     *
     * @param string|null $id Projet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($id == null)
            $projet = $this->Projets->newEntity();
        else
            $projet = $this->Projets->get($id, [
                'contain' => ['Equipes']
            ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projet = $this->Projets->patchEntity($projet, $this->request->getData());
            if ($this->Projets->save($projet)) {
                $this->Flash->success(__('Le projet a été ajouté avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('L\'ajout du projet a échoué. Merci de ré-essayer.'));
        }
        $financements = $this->Projets->Financements->find('list', ['limit' => 200]);
        $equipes = $this->Projets->Equipes->find('list', ['limit' => 200]);
        $this->set(compact('projet', 'financements', 'equipes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Projet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projet = $this->Projets->get($id);
        if ($this->Projets->delete($projet)) {
            $this->Flash->success(__('Le projet à été supprimé.'));
        } else {
            $this->Flash->error(__('La suppression du projet à échoué.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Retourne la liste des budgets  par annees pour un projet
     * @param $id : identifiant du projet
     * @return array : liste des budgets
     */
    public function listeBudgetsAnnuelsProjet($id = null){
        $this->loadModel('BudgetsAnnuels');
        $result = $this->BudgetsAnnuels->find('all')
            ->where(['projet_id' => $id])
            ->toArray();
        return $result;
    }

    /**
     * Retourne la liste des budgets  par annees pour tous les projets
     * @return array : liste des budgets
     */
    public function listeBudgetsAnnuels(){
        $this->loadModel('BudgetsAnnuels');
        $result = $this->BudgetsAnnuels->find('all')
            ->order('projet_id')
            ->toArray();
        return $result;
    }
    /**
     * Retourne les informations d'un projet selon son id
     * @param $id : identifiant du projet
     * @return array : informations du projet
     */
    public function informationProjet()
    {
        $result=$this->Projets->find('all')
        ->contain(["financements"]);
        return $result->toArray();
    }

	/**
	 * Checks the currently logged in user's rights to access a page (called when changing pages).
	 * @param $user : the user currently logged in
	 * @return bool : if the user is allowed (or not) to access the requested page
	 */
	public function isAuthorized($user)
	{
		if (parent::isAuthorized($user) === true) {
			return true;
		} else {
			//	Tous les membres permanents ont tous les droits sur les projets
			if ($user['permanent'] === true) {
				return true;
			}
		}
		return false;
	}
}
