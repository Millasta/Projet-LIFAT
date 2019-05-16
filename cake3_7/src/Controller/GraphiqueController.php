<?php
/**
 * Created by PhpStorm.
 * User: valentin
 * Date: 25/04/2019
 * Time: 17:15
 */

namespace App\Controller;

use App\Model\Entity\Membre;
use App\Model\Entity\EncadrantsTheses;
use Graph;
use Barplot;


class GraphiqueController extends AppController
{
    public function index(){
        //faire des if selon le graph ou list à faire
        $this->tableauListeDoctorant();
        //$this->tableauListeMembresParEquipe();
        //$this->tableaulisteThesesParEncadrant();
        //$this->tableauListeEncadrantsAvecTaux();
    }

    public function effectifsParType(){
        $donnees = MembresController::effectifParType();
        foreach($donnees as $key => $value){
            $type[]= $key;
            $effectifs[] = $value;
        }

        $largeur = 1000;
        $hauteur = 600;
        require_once(ROOT . DS . 'vendor' . DS . 'JPGraph' . DS . 'jpgraph.php');
        require_once(ROOT . DS . 'vendor' . DS . 'JPGraph' .  DS . 'jpgraph_bar.php');
        // Initialisation du graphique
        $graphe = new Graph($largeur, $hauteur);

        // Echelle lineaire ('lin') en ordonnee et pas de valeur en abscisse ('text')
        // Valeurs min et max seront determinees automatiquement
        $graphe->setScale("textlin");

        // Creation de l'histogramme



        $histo = new BarPlot($effectifs);

        // Ajout de l'histogramme au graphique

        $graphe->add($histo);
        $graphe->xaxis->title->set("Type");
        $graphe->yaxis->title->set("Effectifs");
        $graphe->xaxis->setTickLabels($type);

        // Ajout du titre du graphique
        $graphe->title->set("Histogramme");

        @unlink("effectifsParType.png");
        $graphe->stroke("effectifsParType.png");

        $this->set("nomGraphe", "effectifsParType.png");
    }

    public function tableauListeMembresParEquipe(){
        $donnees = MembresController::listeMembreParEquipe();
        $tableau = $donnees->toArray();
        $entetes = ["id","role", "nom", "prenom", "email", "pass", "adresse_agent_1", "adresse_agent_2", "residence_admin_1",
            "residence_admin_2", "type_personnel", "intitule", "grade", "im_vehicule", "pf_vehicule", "signature_name",
            "login_cas", "carte_sncf", "matricule", "date_naissance", "actif", "lieu_travail_id", "equipe_id", "nationalite",
            "est_francais", "genre", "hdr", "permanent", "est_porteur", "date_creation", "date_sortie"];

        $fichier = "listeMembres.csv";
        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }

        foreach($entetes as $key => $row){
            echo '<th>'.$row.'</th>';
        }
        fputcsv($fp, $entetes, ";");

        $listeMembres = array();
        $membres = array();
        foreach($tableau as $key => $row){
            $listeMembres[$key] =  array(
                $tableau[$key]->id,
                $tableau[$key]->role,
                $tableau[$key]->nom,
                $tableau[$key]->prenom,
                $tableau[$key]->email,
                $tableau[$key]->pass,
                $tableau[$key]->adresse_agent_1,
                $tableau[$key]->adresse_agent_2,
                $tableau[$key]->residence_admin_1,
                $tableau[$key]->residence_admin_2,
                $tableau[$key]->type_personnel,
                $tableau[$key]->intitule,
                $tableau[$key]->grade,
                $tableau[$key]->im_vehicule,
                $tableau[$key]->pf_vehicule,
                $tableau[$key]->signature_name,
                $tableau[$key]->login_cas,
                $tableau[$key]->carte_sncf,
                $tableau[$key]->matricule,
                $tableau[$key]->date_naissance,
                $tableau[$key]->actif,
                $tableau[$key]->lieu_travail_id,
                $tableau[$key]->equipe_id,
                $tableau[$key]->nationalite,
                $tableau[$key]->est_francais,
                $tableau[$key]->genre,
                $tableau[$key]->hdr,
                $tableau[$key]->permanent,
                $tableau[$key]->est_porteur,
                $tableau[$key]->date_creation,
                $tableau[$key]->date_sortie
            );

            fputcsv($fp, array(
                $tableau[$key]->id,
                $tableau[$key]->role,
                $tableau[$key]->nom,
                $tableau[$key]->prenom,
                $tableau[$key]->email,
                $tableau[$key]->pass,
                $tableau[$key]->adresse_agent_1,
                $tableau[$key]->adresse_agent_2,
                $tableau[$key]->residence_admin_1,
                $tableau[$key]->residence_admin_2,
                $tableau[$key]->type_personnel,
                $tableau[$key]->intitule,
                $tableau[$key]->grade,
                $tableau[$key]->im_vehicule,
                $tableau[$key]->pf_vehicule,
                $tableau[$key]->signature_name,
                $tableau[$key]->login_cas,
                $tableau[$key]->carte_sncf,
                $tableau[$key]->matricule,
                $tableau[$key]->date_naissance,
                $tableau[$key]->actif,
                $tableau[$key]->lieu_travail_id,
                $tableau[$key]->equipe_id,
                $tableau[$key]->nationalite,
                $tableau[$key]->est_francais,
                $tableau[$key]->genre,
                $tableau[$key]->hdr,
                $tableau[$key]->permanent,
                $tableau[$key]->est_porteur,
                $tableau[$key]->date_creation,
                $tableau[$key]->date_sortie,
            ), ";");

        }
        fclose($fp);

        $this->set("entetes", $entetes);
        $this->set("tableau", $listeMembres);
        $this->set("nomFichier", $fichier);
    }

    public function tableauListeDoctorant(){
        $tableau = MembresController::listeDoctorant();
        //$tableau = $donnees;
        $entetes = ["id","role", "nom", "prenom", "email", "pass", "adresse_agent_1", "adresse_agent_2", "residence_admin_1",
            "residence_admin_2", "type_personnel", "intitule", "grade", "im_vehicule", "pf_vehicule", "signature_name",
            "login_cas", "carte_sncf", "matricule", "date_naissance", "actif", "lieu_travail_id", "equipe_id", "nationalite",
            "est_francais", "genre", "hdr", "permanent", "est_porteur", "date_creation", "date_sortie"];
        $fichier = "listeDoctorants.csv";

        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");

        $listeDoctorants = array();
        foreach($tableau as $key => $row){
            $listeDoctorants[$key] =  array(
                $tableau[$key]->id,
                $tableau[$key]->role,
                $tableau[$key]->nom,
                $tableau[$key]->prenom,
                $tableau[$key]->email,
                $tableau[$key]->pass,
                $tableau[$key]->adresse_agent_1,
                $tableau[$key]->adresse_agent_2,
                $tableau[$key]->residence_admin_1,
                $tableau[$key]->residence_admin_2,
                $tableau[$key]->type_personnel,
                $tableau[$key]->intitule,
                $tableau[$key]->grade,
                $tableau[$key]->im_vehicule,
                $tableau[$key]->pf_vehicule,
                $tableau[$key]->signature_name,
                $tableau[$key]->login_cas,
                $tableau[$key]->carte_sncf,
                $tableau[$key]->matricule,
                $tableau[$key]->date_naissance,
                $tableau[$key]->actif,
                $tableau[$key]->lieu_travail_id,
                $tableau[$key]->equipe_id,
                $tableau[$key]->nationalite,
                $tableau[$key]->est_francais,
                $tableau[$key]->genre,
                $tableau[$key]->hdr,
                $tableau[$key]->permanent,
                $tableau[$key]->est_porteur,
                $tableau[$key]->date_creation,
                $tableau[$key]->date_sortie
            );
            fputcsv($fp, array(
                $tableau[$key]->id,
                $tableau[$key]->role,
                $tableau[$key]->nom,
                $tableau[$key]->prenom,
                $tableau[$key]->email,
                $tableau[$key]->pass,
                $tableau[$key]->adresse_agent_1,
                $tableau[$key]->adresse_agent_2,
                $tableau[$key]->residence_admin_1,
                $tableau[$key]->residence_admin_2,
                $tableau[$key]->type_personnel,
                $tableau[$key]->intitule,
                $tableau[$key]->grade,
                $tableau[$key]->im_vehicule,
                $tableau[$key]->pf_vehicule,
                $tableau[$key]->signature_name,
                $tableau[$key]->login_cas,
                $tableau[$key]->carte_sncf,
                $tableau[$key]->matricule,
                $tableau[$key]->date_naissance,
                $tableau[$key]->actif,
                $tableau[$key]->lieu_travail_id,
                $tableau[$key]->equipe_id,
                $tableau[$key]->nationalite,
                $tableau[$key]->est_francais,
                $tableau[$key]->genre,
                $tableau[$key]->hdr,
                $tableau[$key]->permanent,
                $tableau[$key]->est_porteur,
                $tableau[$key]->date_creation,
                $tableau[$key]->date_sortie,
            ), ";");

        }
        fclose($fp);

        $this->set("entetes", $entetes);
        $this->set("tableau", $listeDoctorants);
        $this->set("nomFichier", $fichier);
    }

    public function tableaulisteThesesParEncadrant(){
        //IL FAUT L'ID DE L'ENCADRANT
        $tableau = EncadrantsThesesController::listeThesesParEncadrant(3);
        $entetes = ["id","sujet","type","date_debut","date_fin","autre_info","auteur_id"];
        $fichier = "listeThesesParEncadrant.csv";

        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");


        $listeThesesParEncadrants = array();
        foreach($tableau as $key => $row){
            $listeThesesParEncadrants[$key] =  array(
                $tableau[$key]->id,
                $tableau[$key]->sujet,
                $tableau[$key]->type,
                $tableau[$key]->date_debut,
                $tableau[$key]->date_fin,
                $tableau[$key]->auteur_info,
                $tableau[$key]->auteur_id
            );
            fputcsv($fp, array(
                $tableau[$key]->id,
                $tableau[$key]->sujet,
                $tableau[$key]->type,
                $tableau[$key]->date_debut,
                $tableau[$key]->date_fin,
                $tableau[$key]->auteur_info,
                $tableau[$key]->auteur_id,
            ), ";");

        }
        fclose($fp);

        $this->set("entetes", $entetes);
        $this->set("tableau", $listeThesesParEncadrants);
        $this->set("nomFichier", $fichier);
    }

    public function tableauListeEncadrantsAvecTaux(){
        $tableau = EncadrantsThesesController::listeEncadrantsAvecTaux(1);

        $entetes = ["id","role", "nom", "prenom", "email", "passwd", "adresse_agent_1", "adresse_agent_2", "residence_admin_1",
            "residence_admin_2", "type_personnel", "intitule", "grade", "im_vehicule", "pf_vehicule", "signature_name",
            "login_cas", "carte_sncf", "matricule", "date_naissance", "actif", "lieu_travail_id", "equipe_id", "nationalite",
            "est_francais", "genre", "hdr", "permanent", "est_porteur", "date_creation", "date_sortie","taux"];
        $fichier = "listeEncadrantsAvecTaux.csv";
        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");


        $listeEncadrants = array();
        foreach($tableau as $key => $row){
            $listeEncadrants[$key] =  array(
                $tableau[$key]['Membres']['id'],
                $tableau[$key]['Membres']['role'],
                $tableau[$key]['Membres']['nom'],
                $tableau[$key]['Membres']['prenom'],
                $tableau[$key]['Membres']['email'],
                $tableau[$key]['Membres']['passwd'],
                $tableau[$key]['Membres']['adresse_agent_1'],
                $tableau[$key]['Membres']['adresse_agent_2'],
                $tableau[$key]['Membres']['residence_admin_1'],
                $tableau[$key]['Membres']['residence_admin_2'],
                $tableau[$key]['Membres']['type_personnel'],
                $tableau[$key]['Membres']['intitule'],
                $tableau[$key]['Membres']['grade'],
                $tableau[$key]['Membres']['im_vehicule'],
                $tableau[$key]['Membres']['pf_vehicule'],
                $tableau[$key]['Membres']['signature_name'],
                $tableau[$key]['Membres']['login_cas'],
                $tableau[$key]['Membres']['carte_sncf'],
                $tableau[$key]['Membres']['matricule'],
                $tableau[$key]['Membres']['date_naissance'],
                $tableau[$key]['Membres']['actif'],
                $tableau[$key]['Membres']['lieu_travail_id'],
                $tableau[$key]['Membres']['equipe_id'],
                $tableau[$key]['Membres']['nationalite'],
                $tableau[$key]['Membres']['est_francais'],
                $tableau[$key]['Membres']['genre'],
                $tableau[$key]['Membres']['hdr'],
                $tableau[$key]['Membres']['permanent'],
                $tableau[$key]['Membres']['est_porteur'],
                $tableau[$key]['Membres']['date_creation'],
                $tableau[$key]['Membres']['date_sortie'],
                $tableau[$key]['taux']
            );
            fputcsv($fp, array(
                $tableau[$key]['Membres']['id'],
                $tableau[$key]['Membres']['role'],
                $tableau[$key]['Membres']['nom'],
                $tableau[$key]['Membres']['prenom'],
                $tableau[$key]['Membres']['email'],
                $tableau[$key]['Membres']['passwd'],
                $tableau[$key]['Membres']['adresse_agent_1'],
                $tableau[$key]['Membres']['adresse_agent_2'],
                $tableau[$key]['Membres']['residence_admin_1'],
                $tableau[$key]['Membres']['residence_admin_2'],
                $tableau[$key]['Membres']['type_personnel'],
                $tableau[$key]['Membres']['intitule'],
                $tableau[$key]['Membres']['grade'],
                $tableau[$key]['Membres']['im_vehicule'],
                $tableau[$key]['Membres']['pf_vehicule'],
                $tableau[$key]['Membres']['signature_name'],
                $tableau[$key]['Membres']['login_cas'],
                $tableau[$key]['Membres']['carte_sncf'],
                $tableau[$key]['Membres']['matricule'],
                $tableau[$key]['Membres']['date_naissance'],
                $tableau[$key]['Membres']['actif'],
                $tableau[$key]['Membres']['lieu_travail_id'],
                $tableau[$key]['Membres']['equipe_id'],
                $tableau[$key]['Membres']['nationalite'],
                $tableau[$key]['Membres']['est_francais'],
                $tableau[$key]['Membres']['genre'],
                $tableau[$key]['Membres']['hdr'],
                $tableau[$key]['Membres']['permanent'],
                $tableau[$key]['Membres']['est_porteur'],
                $tableau[$key]['Membres']['date_creation'],
                $tableau[$key]['Membres']['date_sortie'],
                $tableau[$key]['taux']
            ), ";");

        }
        fclose($fp);

        $this->set("entetes", $entetes);
        $this->set("tableau", $listeEncadrants);
        $this->set("nomFichier", $fichier);
    }



}