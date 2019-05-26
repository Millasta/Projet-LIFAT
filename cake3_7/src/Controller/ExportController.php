<?php

namespace App\Controller;

use App\Form\ExportForm;
use Barplot;
use Graph;
use PieGraph;
use PiePlot;

/**
 * Class ExportController
 * @package App\Controller
 */
class ExportController extends AppController
{
	/**
	 * Index method
	 */
	public function index()
	{
		$export = new ExportForm();
		if ($this->request->is('post')) {
			if ($export->execute($this->request->getData())) {
				$export->setData($this->request->getData());
				$this->results();
				$this->Flash->success('Nous traitons votre demande.' . $export->getData('typeExport'));
			} else {
				$this->Flash->error('Il y a eu un problème lors de la soumission de votre formulaire.');
			}
		}
		$this->loadModel('Membres');
		$encadrants = $this->Membres
			->find()
			->select(['id', 'nom', 'prenom'])
			->join([
				'table' => 'Encadrants',
				'alias' => 'e',
				'conditions' => 'e.encadrant_id = id',
			]);

		$this->loadModel('Equipes');
		$equipes = $this->Equipes
			->find()
			->select(['id', 'nom_equipe']);

		$membres = $this->Membres->find();

		$this->set('export', $export);
		$this->set(compact('encadrants', 'equipes', 'membres'));
	}

    /**
     * Results method
     *
     */
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


		//Si l'utilisateur veut un graphe
		if ($boolGraph == true) {
			$typeGraphe = $export->getData('typeGraphe');

			if ($typeGraphe == 'EM5') {
				$this->grapheEffectifsParType();
			} else if ($typeGraphe == 'EM7') {
				$this->graphNombreDeDoctorantsParEquipe();
			} else if ($typeGraphe == 'EM9') {
				$this->graphEffectifsParEquipe();
			} else if ($typeGraphe == 'EM15') {
				$this->graphEffectifsParNationaliteParSexe();
			}
		}


        //Si l'utilisateur veut un tableau
        if ($boolTableau == true){
            $typeListe = $export->getData('typeListe');
            if($typeListe == "EM1"){
                $encadrant = $export->getData('encadrant');
                $this->tableaulisteThesesParEncadrant($encadrant);
            }
            else if ($typeListe == "EM2"){ //OK MAIS ATTENTION YA DES PB
                $this->tableauListeMembresParEquipe();
            }
            else if($typeListe == "EM3"){
                $encadrant = $export->getData('encadrant');
                $this->tableauListeProjetMembre($encadrant);
            }
            else if($typeListe == "EM4"){
                $this->tableauListeDoctorant();
            }
            else if($typeListe == "EM6"){
                $this->tableauEffectifsParType();
            }
            else if($typeListe == "EM8"){
                $this->tableauNombreDeDoctorantsParEquipe();
            }
            else if($typeListe == "EM10"){
                $this->tableauEffectifsParEquipe();
            }
            else if($typeListe == "ET1"){
                $this->tableauListeEncadrantsAvecTaux();
            }
            else if($typeListe == "ET2"){
                $equipe = $export->getData('equipe');
                $this->tableauListeThesesParEquipe($equipe);
            }
            else if ($typeListe == "ET3"){
                $this->tableauListeSoutenances();
            }
            else if($typeListe == "ET4"){
                $this->tableauListeSoutenanceHDR();
            }
            else if ($typeListe == "ET5"){
                $annee = $export->getData('annee');
                $this->tableauListeSoutenancesParAnnee($annee['year']);
            }
            else if ($typeListe == "ET6"){
                $this->tableauListeTheseParType();
            }
            else if($typeListe == "ET7"){
                $this->tableauThesesEnCours();
            }
            else if ($typeListe == "EPr1"){
                //Liste des projets par type
               $this->tableauInformationProjet();
            }
            else if ($typeListe == "EPr2"){
                //Liste des projets par équipe
            }
            else if ($typeListe == "EPr3"){ // ATTETION PAS LE LISTE DE MEMBRES
                $membre = $export->getData('membre');
                $this->tableauListeProjetMembre($membre);
            }
            else if ($typeListe == "EPr4"){//OK
                $this->tableauBudgetsParProjet();
            }

		}
		$this->set("boolGraphe", $boolGraph);
		$this->set("boolTableau", $boolTableau);
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
		require_once(ROOT . DS . 'vendor' . DS . 'JPGraph' . DS . 'jpgraph_bar.php');
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

	public function graphNombreDeDoctorantsParEquipe()
	{
		$controlInstance = new MembresController();
		$donnees = $controlInstance->nombreDoctorantParEquipe();
		foreach ($donnees as $key => $value) {
			$equipe[] = $value[0];
			$effectifs[] = $value[1];
		}

    public function tableauListeMembresParEquipe(){
        $controlInstance = new MembresController();
        $donnees = $controlInstance->listeMembreParEquipe();
        $tableau = $donnees->toArray();
        $entetes = ["id","role", "nom", "prenom", "email", "pass", "adresse_agent_1", "adresse_agent_2", "residence_admin_1",
            "residence_admin_2", "type_personnel", "intitule", "grade", "im_vehicule", "pf_vehicule", "signature_name",
            "login_cas", "carte_sncf", "matricule", "date_naissance", "actif", "lieu_travail_id", "equipe_id", "nationalite",
            "est_francais", "genre", "hdr", "permanent", "est_porteur", "date_creation", "date_sortie"];

		// Echelle lineaire ('lin') en ordonnee et pas de valeur en abscisse ('text')
		// Valeurs min et max seront determinees automatiquement
		$graphe->setScale("textlin");

		// Creation de l'histogramme


		$histo = new BarPlot($effectifs);

		// Ajout de l'histogramme au graphique

		$graphe->add($histo);
		$graphe->xaxis->title->set("Equipe");
		$graphe->yaxis->title->set("Effectifs");
		$graphe->xaxis->setTickLabels($equipe);

    public function tableauListeDoctorant(){
        $controlInstance = new MembresController();
        $tableau = $controlInstance->listeDoctorant();
        //$tableau = $donnees;
        $entetes = ["id","role", "nom", "prenom", "email", "pass", "adresse_agent_1", "adresse_agent_2", "residence_admin_1",
            "residence_admin_2", "type_personnel", "intitule", "grade", "im_vehicule", "pf_vehicule", "signature_name",
            "login_cas", "carte_sncf", "matricule", "date_naissance", "actif", "lieu_travail_id", "equipe_id", "nationalite",
            "est_francais", "genre", "hdr", "permanent", "est_porteur", "date_creation", "date_sortie"];
        $fichier = "listeDoctorants.csv";

		@unlink("img/NombreDeDoctorantsParEquipe.png");
		$graphe->stroke("img/NombreDeDoctorantsParEquipe.png");

		$this->set("nomGraphe", "NombreDeDoctorantsParEquipe.png");
	}

	public function graphEffectifsParEquipe()
	{
		$controlInstance = new MembresController();
		$tableau = $controlInstance->nombreEffectifParEquipe();

		foreach ($tableau as $key => $value) {
			$equipe[] = $value[0];
			$effectifs[] = $value[1];
		}

    public function tableaulisteThesesParEncadrant($id){
        //IL FAUT L'ID DE L'ENCADRANT
        $controlInstance = new EncadrantsThesesController();
        $tableau = $controlInstance->listeThesesParEncadrant($id);
        $entetes = ["id","sujet","type","date_debut","date_fin","autre_info","auteur_id"];
        $fichier = "listeThesesParEncadrant.csv";

		// Echelle lineaire ('lin') en ordonnee et pas de valeur en abscisse ('text')
		// Valeurs min et max seront determinees automatiquement
		$graphe->setScale("textlin");

		// Creation de l'histogramme

		$camGraph = new PiePlot($effectifs);

		// Ajout de l'histogramme au graphique
		$camGraph->SetCenter(0.4);
		//$camGraph->SetValueType($type);
		$camGraph->SetLegends($equipe);
		$graphe->add($camGraph);
		//$graphe->xaxis->title->set("Type");
		//$graphe->yaxis->title->set("Effectifs");
		//$graphe->xaxis->setTickLabels($type);

		// Ajout du titre du graphique
		$graphe->title->set("Diagramme effectifs par Equipe");

    public function tableauListeEncadrantsAvecTaux(){
        $controlInstance = new EncadrantsThesesController();
        $tableau = $controlInstance->listeEncadrantsAvecTaux();

		$this->set("nomGraphe", "effectifsParEquipe.png");

	}

	public function graphEffectifsParNationaliteParSexe()
	{
		$controlInstance = new MembresController();
		$tableau = $controlInstance->effectifParNationaliteSexe();


		////////////////////////////////////////////////////
		foreach ($tableau as $key => $value) {
			$type[] = $key;
			$effectifs[] = $value;
		}

    public function tableauListeProjetMembre($idMembre){
        $controlInstance = new MembresController();
        $tableau = $controlInstance->listeProjetMembre($idMembre);

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

		@unlink("img/effectifsParNationaliteSexe.png");
		//$graphe->Add($camGraph);
		$graphe->stroke("img/effectifsParNationaliteSexe.png");

		$this->set("nomGraphe", "effectifsParNationaliteSexe.png");

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

		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");


		$listeThesesParEncadrants = array();
		foreach ($tableau as $key => $row) {
			$listeThesesParEncadrants[$key] = array(
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

    public function tableauListeSoutenancesParAnnee($annee){
        $controlInstance = new ThesesController();
        $tableau = $controlInstance->listeSoutenancesParAnnee($annee);

		$this->set("entetes", $entetes);
		$this->set("tableau", $listeThesesParEncadrants);
		$this->set("nomFichier", $fichier);
	}

	public function tableauListeMembresParEquipe()
	{
		$controlInstance = new MembresController();
		$donnees = $controlInstance->listeMembreParEquipe();
		$tableau = $donnees->toArray();
		$entetes = ["id", "role", "nom", "prenom", "email", "pass", "adresse_agent_1", "adresse_agent_2", "residence_admin_1",
			"residence_admin_2", "type_personnel", "intitule", "grade", "im_vehicule", "pf_vehicule", "signature_name",
			"login_cas", "carte_sncf", "matricule", "date_naissance", "actif", "lieu_travail_id", "equipe_id", "nationalite",
			"est_francais", "genre", "hdr", "permanent", "est_porteur", "date_creation", "date_sortie"];

		$fichier = "listeMembres.csv";
		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}

		fputcsv($fp, $entetes, ";");

		$listeMembres = array();
		$membres = array();
		foreach ($tableau as $key => $row) {
			$listeMembres[$key] = array(
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

    public function tableauListeSoutenances(){
        $controlInstance = new ThesesController();
        $tableau = $controlInstance->listeSoutenances();

		$this->set("entetes", $entetes);
		$this->set("tableau", $listeMembres);
		$this->set("nomFichier", $fichier);
	}

	public function tableauListeProjetMembre($idMembre)
	{
		$controlInstance = new MembresController();
		$tableau = $controlInstance->listeProjetMembre($idMembre);

		$entetes = ["id", "titre", "description", "type", "budget", "date_debut", "date_fin", "financement_id"];
		$fichier = "listeProjetMembre.csv";
		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");

		$listeProjetMembre = array();
		foreach ($tableau as $key => $row) {
			$listeProjetMembre[$key] = array(
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

    public function tableauEffectifsParNationaliteParSexe(){
        $controlInstance = new MembresController();
        $tableau = $controlInstance->effectifParNationaliteSexe();
        $entetes = ["Sexe_Nationalite","effectifs"];
        $fichier = "effectifsParNationalite.csv";

		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");

		$listeDoctorants = array();
		foreach ($tableau as $key => $row) {
			$listeDoctorants[$key] = array(
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

	public function tableauEffectifsParType()
	{
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
		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}

		fputcsv($fp, $entetes, ";");

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

		foreach ($tableau as $key => $row) {
			$listeEffectifsParTypes[$key] = array(
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

	public function tableauNombreDeDoctorantsParEquipe()
	{
		$controlInstance = new MembresController();
		$tableau = $controlInstance->nombreDoctorantParEquipe();
		$entetes = ["Nom Equipe", "Nombre Doctorants"];
		$fichier = "NombreDoctorantsParEquipe.csv";

		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");

		$NombreDoctorantParEquipe = array();
		foreach ($tableau as $key => $row) {
			$NombreDoctorantParEquipe[$key] = array(
				$row[0],
				$row[1]
			);

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

		}
		fclose($fp);

		$this->set("entetes", $entetes);
		$this->set("tableau", $NombreDoctorantParEquipe);
		$this->set("nomFichier", $fichier);
	}

	public function tableauEffectifsParEquipe()
	{
		$controlInstance = new MembresController();
		$tableau = $controlInstance->nombreEffectifParEquipe();
		$entetes = ["Nom Equipe", "Nombre"];
		$fichier = "EffectifsParEquipe.csv";

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

		$EffectifsParEquipe = array();
		foreach ($tableau as $key => $row) {
			$EffectifsParEquipe[$key] = array(
				$row[0],
				$row[1]
			);

			fputcsv($fp, array(
				$row[0],
				$row[1]
			), ";");

		}
		fclose($fp);

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

	public function tableauListeEncadrantsAvecTaux()
	{
		$controlInstance = new EncadrantsThesesController();
		$tableau = $controlInstance->listeEncadrantsAvecTaux();

		$entetes = ["id", "role", "nom", "prenom", "email", "passwd", "adresse_agent_1", "adresse_agent_2", "residence_admin_1",
			"residence_admin_2", "type_personnel", "intitule", "grade", "im_vehicule", "pf_vehicule", "signature_name",
			"login_cas", "carte_sncf", "matricule", "date_naissance", "actif", "lieu_travail_id", "equipe_id", "nationalite",
			"est_francais", "genre", "hdr", "permanent", "est_porteur", "date_creation", "date_sortie", "taux"];
		$fichier = "listeEncadrantsAvecTaux.csv";
		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");


    public function graphEffectifsParNationaliteParSexe(){
        $controlInstance = new MembresController();
        $tableau = $controlInstance->effectifParNationaliteSexe();

		}
		fclose($fp);

		$this->set("entetes", $entetes);
		$this->set("tableau", $listeEncadrants);
		$this->set("nomFichier", $fichier);
	}

	public function tableauListeThesesParEquipe($idEquipe)
	{
		$controlInstance = new ThesesController();
		$tableau = $controlInstance->listeThesesParEquipe($idEquipe);
		$entetes = ["id", "sujet", "type", "date_debut", "date_fin", "autre_info", "auteur_id"];
		$fichier = "listeTheseParEquipe.csv";
		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");

		$listeThesesParEquipe = array();
		foreach ($tableau as $key => $row) {
			$listeThesesParEquipe[$key] = array(
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
		$this->set("tableau", $listeThesesParEquipe);
		$this->set("nomFichier", $fichier);
	}

	public function tableauListeSoutenances()
	{
		$controlInstance = new ThesesController();
		$tableau = $controlInstance->listeSoutenances();

		$entetes = ["id", "sujet", "type", "date_debut", "date_fin", "autre_info", "auteur_id"];
		$fichier = "listeSoutenance.csv";
		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");

		$listeSoutenance = array();
		foreach ($tableau as $key => $row) {
			$listeSoutenance[$key] = array(
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
		$this->set("tableau", $listeSoutenance);
		$this->set("nomFichier", $fichier);

    public function graphEffectifsParEquipe(){
        $controlInstance = new MembresController();
        $tableau = $controlInstance->nombreEffectifParEquipe();

	}

	public function tableauListeSoutenanceHDR()
	{
		$controlInstance = new ThesesController();
		$tableau = $controlInstance->listeSoutenancesHDR();
		$entetes = ["id", "sujet", "type", "date_debut", "date_fin", "autre_info", "auteur_id"];
		$fichier = "listeSoutenanceHDR.csv";
		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");

		$listeSoutenanceHDR = array();
		foreach ($tableau as $key => $row) {
			$listeSoutenanceHDR[$key] = array(
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

	public function tableauListeSoutenancesParAnnee($annee)
	{
		$controlInstance = new ThesesController();
		$tableau = $controlInstance->listeSoutenancesParAnnee($annee);

		$entetes = ["id", "sujet", "type", "date_debut", "date_fin", "autre_info", "auteur_id"];
		$fichier = "listeSoutenanceParAnnee.csv";
		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");

		$listeSoutenanceParAnnee = array();
		foreach ($tableau as $key => $row) {
			$listeSoutenanceParAnnee[$key] = array(
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

    public function tableauListeThesesParEquipe($idEquipe){
        $controlInstance = new ThesesController();
        $tableau = $controlInstance->listeThesesParEquipe($idEquipe);
        $entetes = ["id","sujet","type","date_debut","date_fin","autre_info","auteur_id"];
        $fichier = "listeTheseParEquipe.csv";
        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");

	}

	public function tableauListeTheseParType()
	{
		$controlInstance = new ThesesController();
		$tableau = $controlInstance->listeTheseParType();
		$entetes = ["id", "sujet", "type", "date_debut", "date_fin", "autre_info", "auteur_id"];
		$fichier = "listeTheseParType.csv";
		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");

		$listeThesesParType = array();
		foreach ($tableau as $key => $row) {
			$listeThesesParType[$key] = array(
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

    public function tableauInformationProjet(){
        $controlInstance = new ProjetsController();
        $tableau = $controlInstance->informationProjet();
        $entetes = ["id","titre","description","type","budget","date_debut","date_fin","financement_id","international", "nationalite_financement","financement_prive","financement"];
        $fichier = "InformationProjet.csv";
        if (file_exists($fichier)){
            //si il existe
            unlink($fichier);
            $fp = fopen($fichier,'w');
        }else{
            $fp = fopen($fichier, 'w');
        }
        fputcsv($fp, $entetes, ";");
        $informationProjet = array();
        foreach($tableau as $key => $row){
            $informationProjet[$key] =  array(

		$this->set("entetes", $entetes);
		$this->set("tableau", $listeThesesParType);
		$this->set("nomFichier", $fichier);
	}

	public function tableauThesesEnCours()
	{
		$controlInstance = new ThesesController();
		$tableau = $controlInstance->listeThesesEnCours();
		$entetes = ["id", "sujet", "type", "date_debut", "date_fin", "autre_info", "auteur_id"];
		$fichier = "listeTheseEnCours.csv";
		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");

		$listeThesesParType = array();
		foreach ($tableau as $key => $row) {
			$listeThesesParType[$key] = array(
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

    public function tableauNombreDeDoctorantsParEquipe(){
        $controlInstance = new MembresController();
        $tableau = $controlInstance->nombreDoctorantParEquipe();
        $entetes = ["Nom Equipe","Nombre Doctorants"];
        $fichier = "NombreDoctorantsParEquipe.csv";

	public function tableauInformationProjet()
	{
		$controlInstance = new ProjetsController();
		$tableau = $controlInstance->informationProjet();
		$entetes = ["id", "titre", "description", "type", "budget", "date_debut", "date_fin", "financement_id", "international", "nationalite_financement", "financement_prive", "financement"];
		$fichier = "InformationProjet.csv";
		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");
		$informationProjet = array();
		foreach ($tableau as $key => $row) {
			$informationProjet[$key] = array(

				$tableau[$key]->id,
				$tableau[$key]->titre,
				$tableau[$key]->description,
				$tableau[$key]->type,
				$tableau[$key]->budget,
				$tableau[$key]->date_debut,
				$tableau[$key]->date_fin,
				$tableau[$key]->financement_id,
				$tableau[$key]['Financements']['international'],
				$tableau[$key]['Financements']['nationalite_financement'],
				$tableau[$key]['Financements']['financement_prive'],
				$tableau[$key]['Financements']['financement']

			);
			fputcsv($fp, array(
				$tableau[$key]->id,
				$tableau[$key]->titre,
				$tableau[$key]->description,
				$tableau[$key]->type,
				$tableau[$key]->budget,
				$tableau[$key]->date_debut,
				$tableau[$key]->date_fin,
				$tableau[$key]->financement_id,
				$tableau[$key]['Financements']['international'],
				$tableau[$key]['Financements']['nationalite_financement'],
				$tableau[$key]['Financements']['financement_prive'],
				$tableau[$key]['Financements']['financement']
			), ";");

		}
		fclose($fp);

		$this->set("entetes", $entetes);
		$this->set("tableau", $informationProjet);
		$this->set("nomFichier", $fichier);
	}

    public function tableauEffectifsParEquipe(){
        $controlInstance = new MembresController();
        $tableau = $controlInstance->nombreEffectifParEquipe();
        $entetes = ["Nom Equipe","Nombre"];
        $fichier = "EffectifsParEquipe.csv";

		$listeBudgetsParAnnee = array();
		foreach ($tableau as $key => $row) {
			$listeBudgetsParAnnee[$key] = array(
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

	public function tableauEffectifsParNationaliteParSexe()
	{
		$controlInstance = new MembresController();
		$tableau = $controlInstance->effectifParNationaliteSexe();
		$entetes = ["Sexe_Nationalite", "effectifs"];
		$fichier = "effectifsParNationalite.csv";

		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");

    public function graphNombreDeDoctorantsParEquipe(){
        $controlInstance = new MembresController();
        $donnees = $controlInstance->nombreDoctorantParEquipe();
        foreach($donnees as $key => $value){
            $equipe[]= $value[0];
            $effectifs[] = $value[1];
        }

		foreach ($tableau as $key => $row) {
			$listeEffectifsParNationaliteEtSexe[$key] = array(
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

	public function tableauBudgetsProjet()
	{
		$controlInstance = new ProjetsController();
		$tableau = $controlInstance->listeBudgetsAnnuelsProjet(2);
		debug($tableau);
		$entetes = ["projet_id", "annee", "budget"];
		$fichier = "listeBudgetsProjet.csv";
		if (file_exists($fichier)) {
			//si il existe
			unlink($fichier);
			$fp = fopen($fichier, 'w');
		} else {
			$fp = fopen($fichier, 'w');
		}
		fputcsv($fp, $entetes, ";");

		$listeBudgetsParAnnee = array();
		foreach ($tableau as $key => $row) {
			$listeBudgetsParAnnee[$key] = array(
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

        // Ajout du titre du graphique
        $graphe->title->set("Histogramme");

        @unlink("img/NombreDeDoctorantsParEquipe.png");
        $graphe->stroke("img/NombreDeDoctorantsParEquipe.png");

        $this->set("nomGraphe", "NombreDeDoctorantsParEquipe.png");
    }
    
	/**
	 * Checks the currently logged in user's rights to access a page (called when changing pages).
	 * @param $user : the user currently logged in
	 * @return bool : if the user is allowed (or not) to access the requested page
	 */
	public function isAuthorized($user)
	{
		//	Tout le monde a droit de faire des exports
		return true;
	}
}