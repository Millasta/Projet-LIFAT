<?php
    $fichier= $this->get("nomFichier");
    $fichierPNG= $this->get("nomGraphe");
    $tableau = $this->get("tableau");
    $entetes = $this->get("entetes");
?>

<a style="color:white;text-decoration:none;" href=<?php echo $fichierPNG; ?> download>
    <button>Export Image</button>
</a>


<img src=<?php echo $fichierPNG; ?> >

<form method="get" action=<?php echo $fichier; ?>>
       <button type="submit">Export CSV</button>
 </form>

<table>
    <tr>
    <?php
        foreach($entetes as $key => $row){
             echo '<th>'.$row.'</th>';
        }
    ?>
    </tr>
    <?php
        foreach($tableau as $key => $row){
                echo '<tr>';
                foreach($tableau[$key] as $cle => $col){
                    echo '<td>'.$tableau[$key][$cle].'</td>';
                }
                echo '</tr>';
        }
    ?>
</table>