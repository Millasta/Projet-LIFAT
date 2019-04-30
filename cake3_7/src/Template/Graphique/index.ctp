<?php
/**
 * Created by PhpStorm.
 * User: valentin
 * Date: 25/04/2019
 * Time: 18:19
 */
require_once(ROOT . '\src' . DS . 'JPGraph' . DS . 'jpgraph.php');
require_once(ROOT . '\src' . DS . 'JPGraph' . DS . 'jpgraph_bar.php');

$donnees = this->get("tableau");
//$donnees = array(12,23,9,58,23,26,57,48,12);

$largeur = 250;
$hauteur = 200;

// Initialisation du graphique
$graphe = new Graph($largeur, $hauteur);
// Echelle lineaire ('lin') en ordonnee et pas de valeur en abscisse ('text')
// Valeurs min et max seront determinees automatiquement
$graphe->setScale("textlin");

// Creation de l'histogramme
$histo = new BarPlot($donnees);
// Ajout de l'histogramme au graphique
$graphe->add($histo);

// Ajout du titre du graphique
$graphe->title->set("Histogramme");

// Affichage du graphique
$graphe->stroke();
exit;
?>