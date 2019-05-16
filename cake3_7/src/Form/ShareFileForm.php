<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class ShareFileForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('nomFichier', ['type' => 'string']);
    }

    protected function _execute(array $data)
    {
        return true;
    }
}