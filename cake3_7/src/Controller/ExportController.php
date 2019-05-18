<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ExportForm;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;


class ExportController extends AppController
{
    public function index()
    {
        $export = new ExportForm();
        if ($this->request->is('post')) {
            if ($export->execute($this->request->getData())) {
                $export->setData($this->request->getData());
                $this->Flash->success('Nous traitons votre demande.'.$export->getData('typeExport'));
            } else {
                $this->Flash->error('Il y a eu un problème lors de la soumission de votre formulaire.');
            }
        }

        $this->loadModel('Membres');
        $encadrants = $this->Membres
            ->find()
            ->select(['nom', 'prenom'])
            ->join([
                'table' => 'Encadrants',
                'alias' => 'e',
                'conditions' => 'e.encadrant_id = id',
            ]);

        $this->loadModel('Equipes');
        $equipes = $this->Equipes
            ->find()
            ->select(['nom_equipe']);

        $this->set('export', $export);
        $this->set(compact('encadrants','equipes'));
    }
}