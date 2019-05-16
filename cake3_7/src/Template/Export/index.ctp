<?php
/**
 * @var \App\Form\ExportForm $export
 */
?>
<?php
$types = ['GRAPHIQUE' => 'Graphique','LISTE' => 'Liste'];
$optionsGraphes = ['SUREMENT DES BO GRAPHES' => 'SUREMENT DES BO GRAPHES','AUTRES' => 'ET D\'AUTRES'];
$optionsListes = ['SUREMENT DES BO LISTES' => 'SUREMENT DES BO LISTES','AUTRES' => 'ET D\'AUTRES'];
?>
<h3><?= h("Menu d'export de graphiques et de listes") ?> </h3>
<div>
    <?php
        echo $this->Form->create($export);
        echo $this->Form->radio('typeExport', $types, ['value' => 'GRAPHIQUE']);
        echo $this->Form->select('typeGraphe', $optionsGraphes);
        echo $this->Form->select('typeListe', $optionsListes);
        echo $this->Form->button('Valider');
        echo $this->Form->end();
    ?>
</div>
