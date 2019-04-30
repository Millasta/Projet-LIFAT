<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query;
use Cake\Database\Expression\QueryExpression;

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


    /**
     * Retourne le nombre de soutenance en tenant compte d'un lapse de temps s'il est renseigne
     * @param $dateEntree : date d'entree de la fenetre de temps
     * @param $dateFin : date de fin de la fenetre de temps
     * @return int : nombre de soutenances
     */
    public function nombreDeSoutenances($dateEntree = null, $dateFin = null){
        $query = $this->Theses->find();
        if ($dateEntree&& $dateFin) {
            $query->where(function (QueryExpression $exp, Query $q) use ($dateEntree, $dateFin) {
                return $exp->between('date_fin', $dateEntree, $dateFin);
            });
        }
        $count = $query->count();
        $this->set(compact('query', 'count'));
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
			//	Tous les membres permanents ont tous les droits sur les theses
			if($user['permanent'] === true)
			{
				return true;
			}
		}
		return false;
	}
}
