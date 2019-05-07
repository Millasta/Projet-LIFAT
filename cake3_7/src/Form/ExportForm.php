<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class ExportForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('typeExport', ['type' => 'string'])
            ->addField('typeGraphe', ['type' => 'string'])
            ->addField('typeListe', ['type' => 'string']);
    }

    protected function _execute(array $data)
    {
        // Envoie un email.
        return true;
    }
}