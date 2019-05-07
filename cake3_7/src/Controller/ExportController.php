<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ExportForm;

class ExportController extends AppController
{
    public function index()
    {
        $export = new ExportForm();
        if ($this->request->is('post')) {
            if ($export->execute($this->request->getData())) {
                $this->Flash->success('Nous traitons votre demande.');
            } else {
                $this->Flash->error('Il y a eu un problème lors de la soumission de votre formulaire.');
            }
        }
        $this->set('export', $export);
    }
}