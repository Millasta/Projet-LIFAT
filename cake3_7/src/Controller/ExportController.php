<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ExportForm;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;
use App\Model\Entity\Membre;
use App\Model\Entity\EncadrantsTheses;
use Graph;
use Barplot;


class ExportController extends AppController
{
    public function index()
    {
        $export = new ExportForm();
        if ($this->request->is('post')) {
            if ($export->execute($this->request->getData())) {
                $export->setData($this->request->getData());
                $this->results();
                $this->Flash->success('Nous traitons votre demande.'.$export->getData('typeExport'));
            } else {
                $this->Flash->error('Il y a eu un problème lors de la soumission de votre formulaire.');
            }
        }
        $this->loadModel('Membres');
        $encadrants = $this->Membres
            ->find()
            ->select(['id','nom', 'prenom'])
            ->join([
                'table' => 'Encadrants',
                'alias' => 'e',
                'conditions' => 'e.encadrant_id = id',
            ]);

        $this->loadModel('Equipes');
        $equipes = $this->Equipes
            ->find()
            ->select(['id','nom_equipe']);

        $this->set('export', $export);
        $this->set(compact('encadrants','equipes'));
    }

    public function results(){
        $export = new ExportForm();
        if ($this->request->is('post')) {
            if ($export->execute($this->request->getData())) {
                $export->setData($this->request->getData());
            } else {
                $this->Flash->error('Il y a eu un problème lors de la soumission de votre formulaire.');
            }
        }


        $boolGraph = $export->getData('exportGraphe');
        $boolTableau = $export->getData('exportListe');


        //$this->grapheEffectifsParType();

        //Si l'utilisateur veut un graphe
        if ($boolGraph == true){
            $typeGraphe = $export->getData('typeGraphe');

            if($typeGraphe == 'EM5'){ //OK
                $this->grapheEffectifsParType();
            }
            else if($typeGraphe == 'EM7'){
                //$this->grapheEffectifsDoctorantParEquipe();
            }
            else if($typeGraphe == 'EM9') {
                //$this->grapheEffectifsParEquipe();
            }
            else if($typeGraphe == 'EM15'){
                //$this->grapheDoctorantGenreEtNationalite();
            }
            else if($typeGraphe == 'EM16') {
                //$this->grapheFinancementsDoctorants();
            }
        }


        //Si l'utilisateur veut un tableau
        if ($boolTableau == true){
            $typeListe = $export->getData('typeListe');
            if($typeListe == "EM1"){ //OK
                $encadrant = $export->getData('encadrant');
                $this->tableaulisteThesesParEncadrant($encadrant);
            }
            else if ($typeListe == "EM2"){ //OK MAIS ATTENTION YA DES PB
                $this->tableauListeMembresParEquipe();
            }
            else if($typeListe == "EM3"){//OK
                $encadrant = $export->getData('encadrant');
                $this->tableauListeProjetMembre($encadrant);
            }
            else if($typeListe == "EM4"){ //OK
                $this->tableauListeDoctorant();
            }
            else if($typeListe == "EM6"){ //OK
                //Liste des effectifs par type
                $this->tableauEffectifsParType();
            }
            else if($typeListe == "EM8"){ //A FAIRE
                //Liste effectif doctorant par equipe
            }
            else if($typeListe == "EM10"){ // A FAIRE
                //liste des effectifs par equipe
            }
            else if($typeListe == "EM17"){ // A FAIRE
                //Liste des financements des doctorants
            }
            else if($typeListe == "ET1"){ //NON FAUT PARLER POUR CELUI LA
                $this->tableauListeEncadrantsAvecTaux();
            }
            else if($typeListe == "ET2"){ // A CODER
                //Liste des thèses par équipe
            }
            else if ($typeListe == "ET3"){
                //Liste des soutenances
            }
            else if($typeListe == "ET4"){ //OK
                //Liste des soutenances d’Habilitation à Diriger les Recherches
                $this->tableauListeSoutenanceHDR();
            }
            else if ($typeListe == "ET5"){
                //Liste de soutenance par années
            }
            else if ($typeListe == "ET6"){ //OK
                $this->tableauListeTheseParType();
            }
            else if($typeListe == "ET7"){ //OK
                //Liste des thèses en cours
                $this->tableauThesesEnCours();
            }
            else if ($typeListe == "EPr1"){
                //Liste des projets par type
            }
            else if ($typeListe == "EPr2"){
                //Liste des projets par équipe
            }
            else if ($typeListe == "EPr3"){ // ATTETION PAS LE LISTE DE MEMBRES
                $encadrant = $export->getData('encadrant');
                $this->tableauListeProjetMembre($encadrant);
            }
            else if ($typeListe == "EPr4"){//OK
                $this->tableauBudgetsParProjet();
            }

        }
    }

    public function grapheEffectifsParType(){
        $controlInstance = new MembresController();
        $donnees = $controlInstance->effectifParType();
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

        @unlink("img/effectifsParType.png");
        $graphe->stroke("img/effectifsParType.png");

        $this->set("nomGraphe", "effectifsParType.png");
    }

    public function tableauListeMembresParEquipe(){
        $controlInstance = new MembresController();
        $donnees = $controlInstance->listeMembreParEquipe();
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
        $controlInstance = new MembresController();
        $tableau = $controlInstance->listeDoctorant();
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

    public function tableaulisteThesesParEncadrant($id){
        //IL FAUT L'ID DE L'ENCADRANT
        $controlInstance = new EncadrantsThesesController();
        $tableau = $controlInstance->listeThesesParEncadrant($id);
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

    public function tableauListeEncadrantsAvecTaux($idEncadrant){
        $controlInstance = new EncadrantsThesesController();
        $tableau = $controlInstance->listeEncadrantsAvecTaux($idEncadrant);

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

    public function tableauListeProjetMembre($idMembre){
        $controlInstance = new MembresController();
        $tableau = $controlInstance->listeProjetMembre($idMembre);

        $entetes = ["id","titre","description","type","budget","date_debut","date_fin","financement_id"];
        $fichier = "listeProjetMembre.csv";
        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");

        $listeProjetMembre = array();
        foreach($tableau as $key => $row){
            $listeProjetMembre[$key] =  array(
                $tableau[$key]->id,
                $tableau[$key]->titre,
                $tableau[$key]->description,
                $tableau[$key]->type,
                $tableau[$key]->budget,
                $tableau[$key]->date_debut,
                $tableau[$key]->date_fin,
                $tableau[$key]->financement_id
            );
            fputcsv($fp, array(
                $tableau[$key]->id,
                $tableau[$key]->titre,
                $tableau[$key]->description,
                $tableau[$key]->type,
                $tableau[$key]->budget,
                $tableau[$key]->date_debut,
                $tableau[$key]->date_fin,
                $tableau[$key]->financement_id
            ), ";");

        }
        fclose($fp);

        $this->set("entetes", $entetes);
        $this->set("tableau", $listeProjetMembre);
        $this->set("nomFichier", $fichier);
    }

    public function tableauListeTheseParType(){
        $controlInstance = new ThesesController();
        $tableau = $controlInstance->listeTheseParType();
        $entetes = ["id","sujet","type","date_debut","date_fin","autre_info","auteur_id"];
        $fichier = "listeTheseParType.csv";
        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");

        $listeThesesParType = array();
        foreach($tableau as $key => $row){
            $listeThesesParType[$key] =  array(
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
        $this->set("tableau", $listeThesesParType);
        $this->set("nomFichier", $fichier);
    }

    public function tableauListeSoutenanceHDR(){
        $controlInstance = new ThesesController();
        $tableau = $controlInstance->listeSoutenancesHDR();
        $entetes = ["id","sujet","type","date_debut","date_fin","autre_info","auteur_id"];
        $fichier = "listeSoutenanceHDR.csv";
        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");

        $listeSoutenanceHDR = array();
        foreach($tableau as $key => $row){
            $listeSoutenanceHDR[$key] =  array(
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
        $this->set("tableau", $listeSoutenanceHDR);
        $this->set("nomFichier", $fichier);
    }

    public function tableauListeSoutenancesParAnnee(){
        $controlInstance = new ThesesController();
        $tableau = $controlInstance->listeSoutenancesParAnnee(2019);

        $entetes = ["id","sujet","type","date_debut","date_fin","autre_info","auteur_id"];
        $fichier = "listeSoutenanceParAnnee.csv";
        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");

        $listeSoutenanceParAnnee = array();
        foreach($tableau as $key => $row){
            $listeSoutenanceParAnnee[$key] =  array(
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
        $this->set("tableau", $listeSoutenanceParAnnee);
        $this->set("nomFichier", $fichier);


    }

    public function graphEffectifsParNationaliteParSexe(){
        $controlInstance = new MembresController();
        $tableau = $controlInstance->effectifParNationaliteSexe();
        $entetes = ["Sexe_Nationalite","effectifs"];
        $fichier = "effectifsParNationalite.csv";

        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");

        $listeEffectifsParNationaliteEtSexe = array();

        foreach($tableau as $key => $row){
            $listeEffectifsParNationaliteEtSexe[$key] =  array(
                $key,
                $row
            );

            fputcsv($fp, array(
                $key,
                $row
            ), ";");

        }
        fclose($fp);

        $this->set("entetes", $entetes);
        $this->set("tableau", $listeEffectifsParNationaliteEtSexe);
        $this->set("nomFichier", $fichier);
    }


    public function tableauEffectifsParType(){
        $controlInstance = new MembresController();
        $tableau = $controlInstance->effectifParType();
        /*foreach($donnees as $key => $value){
            $type[]= $key;
            $effectifs[] = $value;
        }*/
        //$tableau = $donnees->toArray();
        //debug($tableau);
        $entetes = ["type_personnel", "effectifs"];

        $fichier = "listeEffectifsParTypes.csv";
        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }

        fputcsv($fp, $entetes, ";");

        $listeEffectifsParTypes = array();

        foreach($tableau as $key => $row){
            $listeEffectifsParTypes[$key] =  array(
                $key,
                $row
            );

            fputcsv($fp, array(
                $key,
                $row
            ), ";");

        }
        fclose($fp);

        $this->set("entetes", $entetes);
        $this->set("tableau", $listeEffectifsParTypes);
        $this->set("nomFichier", $fichier);
    }

    public function tableauThesesEnCours(){
        $controlInstance = new ThesesController();
        $tableau = $controlInstance->listeThesesEnCours();
        $entetes = ["id","sujet","type","date_debut","date_fin","autre_info","auteur_id"];
        $fichier = "listeTheseEnCours.csv";
        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");

        $listeThesesParType = array();
        foreach($tableau as $key => $row){
            $listeThesesParType[$key] =  array(
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
        $this->set("tableau", $listeThesesParType);
        $this->set("nomFichier", $fichier);
    }

    public function tableauBudgetsParProjet(){
        $controlInstance = new ProjetsController();
        $tableau = $controlInstance->listeBudgetsAnnuels();
        $entetes = ["projet_id","annee","budget"];
        $fichier = "listeBudgetsParProjet.csv";
        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");

        $listeBudgetsParAnnee = array();
        foreach($tableau as $key => $row){
            $listeBudgetsParAnnee[$key] =  array(
                $tableau[$key]->projet_id,
                $tableau[$key]->annee,
                $tableau[$key]->budget
            );
            fputcsv($fp, array(
                $tableau[$key]->projet_id,
                $tableau[$key]->annee,
                $tableau[$key]->budget
            ), ";");

        }
        fclose($fp);

        $this->set("entetes", $entetes);
        $this->set("tableau", $listeBudgetsParAnnee);
        $this->set("nomFichier", $fichier);
    }

    public function tableauBudgetsProjet(){
        $controlInstance = new ProjetsController();
        $tableau = $controlInstance->listeBudgetsAnnuelsProjet(2);
        debug($tableau);
        $entetes = ["projet_id","annee","budget"];
        $fichier = "listeBudgetsProjet.csv";
        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");

        $listeBudgetsParAnnee = array();
        foreach($tableau as $key => $row){
            $listeBudgetsParAnnee[$key] =  array(
                $tableau[$key]->projet_id,
                $tableau[$key]->annee,
                $tableau[$key]->budget
            );
            fputcsv($fp, array(
                $tableau[$key]->projet_id,
                $tableau[$key]->annee,
                $tableau[$key]->budget
            ), ";");

        }
        fclose($fp);

        $this->set("entetes", $entetes);
        $this->set("tableau", $listeBudgetsParAnnee);
        $this->set("nomFichier", $fichier);
    }

    public function tableauEffectifsParNationaliteParSexe(){
        $controlInstance = new MembresController();
        $tableau = $controlInstance->effectifParNationaliteSexe();


        ////////////////////////////////////////////////////
        foreach($tableau as $key => $value){
            $type[]= $key;
            $effectifs[] = $value;
        }

        $largeur = 1000;
        $hauteur = 600;
        require_once(ROOT . DS . 'vendor' . DS . 'JPGraph' . DS . 'jpgraph.php');
        require_once(ROOT . DS . 'vendor' . DS . 'JPGraph' .  DS . 'jpgraph_pie.php');
        // Initialisation du graphique
        $graphe = new PieGraph($largeur, $hauteur);

        // Echelle lineaire ('lin') en ordonnee et pas de valeur en abscisse ('text')
        // Valeurs min et max seront determinees automatiquement
        $graphe->setScale("textlin");

        // Creation de l'histogramme

        $camGraph = new PiePlot($effectifs);

        // Ajout de l'histogramme au graphique
        $camGraph->SetCenter(0.4);
        //$camGraph->SetValueType($type);
        $camGraph->SetLegends($type);
        $graphe->add($camGraph);
        //$graphe->xaxis->title->set("Type");
        //$graphe->yaxis->title->set("Effectifs");
        //$graphe->xaxis->setTickLabels($type);

        // Ajout du titre du graphique
        $graphe->title->set("Diagramme effectifs par NationnaliteSexe");

        @unlink("effectifsParNationaliteSexe.png");
        //$graphe->Add($camGraph);
        $graphe->stroke("effectifsParNationaliteSexe.png");

        $this->set("nomGraphe", "effectifsParNationaliteSexe.png");

    }
}