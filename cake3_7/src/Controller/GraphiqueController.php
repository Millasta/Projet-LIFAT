<?php
/**
 * Created by PhpStorm.
 * User: valentin
 * Date: 25/04/2019
 * Time: 17:15
 */

namespace App\Controller;


class GraphiqueController extends AppController
{

    public function index(){
        $donnees = EncadrantsThesesController::listeThesesParEncadrant();
        $this->set("tableau", $donnees);
    }

}