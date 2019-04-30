<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\EquipesResponsablesTable;
use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\Database\Expression\QueryExpression;

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
            'contain' => ['LieuTravails', 'Equipes']
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
            'contain' => ['LieuTravails', 'Equipes']
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
        $equipes = $this->Membres->Equipes->find('list', ['limit' => 200]);
        $this->set(compact('membre', 'lieuTravails', 'equipes'));
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
        $equipes = $this->Membres->Equipes->find('list', ['limit' => 200]);
        $this->set(compact('membre', 'lieuTravails', 'equipes'));
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

    public function login()
    {
        if ($this->request->is('post')) {
            $membre = $this->Auth->identify();
            if ($membre) {
                $this->Auth->setUser($membre);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Votre identifiant ou votre mot de passe est incorrect.');
        }
    }
    
    public function logout()
    {
        $this->Flash->success('Vous avez été déconnecté.');
        return $this->redirect($this->Auth->logout());
    }

	/**
	 * Checks the currently logged in user's rights to access a page (called when changing pages).
	 * @param $user : the user currently logged in
	 * @return bool : if the user is allowed (or not) to access the requested page
	 */
    public function isAuthorized($user)
	{
		if(parent::isAuthorized($user) === true)
		{
			return true;
		}
		else
		{
			$action = $this->request->getParam('action');
			$this->loadModel('Equipes');
			$equipesRespo = $this->Equipes->findByResponsableId($user['id']);

			if (in_array($action, ['edit', 'delete']))
			{
				//	edit de delete doivent être faits sur un utilisateur existant...
				$membre_slug = $this->request->getParam('pass.0');
				if (!$membre_slug)
				{
					return false;
				}
				else
				{
					$membre = $this->Membres->findById($membre_slug)->first();
					$equipe_id = $membre->equipe_id;

					//	Un membre peut s'auto edit / delete
					if ($membre->id === $user['id'])
					{
						return true;
					}
					else if ($equipe_id != null)
					{
						//	Un chef d'équipe peut faire de même pour les membres de son équipe
						foreach ($equipesRespo as $equipeRespo){
							if($equipeRespo->id === $equipe_id)
							{
								return true;
							}
						}
					}
				}
			}
			else if($action === 'add')
			{
				//	Un chef d'équipe peut ajouter un membre à une de ses équipes
				return $equipesRespo->count() > 0;
				//	ATTENTION : lorsque le formulaire sera submit, il faudra tester si l'équipe dans laquelle l'user est mise correspond à une des équipes gérées par le user !!!!!
			}
		}
		return false;
	}

    public function listeDoctorant($dateEntree = null, $dateFin = null){
        //$dateEntree='2010-03-03';
        //$dateFin='2020-02-02';
        $result = $this->Membres->find('all')
            ->where(['type_personnel'=> 'DO']);

        if ($dateEntree && $dateFin) {
            $result=$result->where(function (QueryExpression $exp, Query $q) use ($dateEntree, $dateFin) {
                return $exp->between('date_creation', $dateEntree, $dateFin);
            })
            ->toArray();
        }

        return $result;
    }
}
