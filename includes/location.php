<head>
<meta http-equiv="Content-Type" content="text/html" charset='utf-8' />

</head>
<?php
// require 'Logements.php';
// require 'logement.php';

// $tableLogement ="logements";
$loge = new Logements("logements");
/*
 * $loger = new logement();
 * $loger->Type_bien="Studio";
 * $loger->Titre="Studio ";
 * $loger->Nombre_pieces=3;
 * $loger->Surface=85;
 * $loger->Prix_loc=1750;
 * $loger->Description= "Superbe Studio avec vu sur les enfers. Barbecue organiser tous les jours avec les voisins. Attention voisin bruillant cause torture";
 * $loger->GES='A';
 * $loger->Classe_ECO='A';
 * $loger->Meubles=FALSE;
 * $loger->Localisation="666 Place du purgatoire";
 * $loger->Id_ville=66666;
 * $loger->Departement=66;
 * $loger->Id_proprietaire=1;
 * $loger->Charges_inc= TRUE;
 * $loger->Montant_charges= 666;
 *
 * $loge->insert($loger);
 */
// $loge->rendre_html();
$etat = "";

if (isset($_GET['etat'])) {
    $etat = $_GET['etat'];
}

switch ($etat) {
    case 'delete':
        $id = intval($_GET['delete']);
        $logeSelect = $loge->find($id);
        

        if (! empty($_GET['confirme'])) {
            $loge->delete($id);
            echo '<h2>Suppression effectué</h2>';
            echo'<meta http-equiv="refresh" content="5;url=index.php?page=location"  />';
            
        } else {
            $nameCollumn=$loge->info_Table();
            echo '<h2>Suppression de logement :</h2>';

            
            echo '<table class="tableprod" border="2">';
            for ($i = 0; $i < count($nameCollumn); $i++) {
                echo '<tr> <td>'. $nameCollumn[$i] . '</td><td>'.$logeSelect[$i].'</td> </tr>';
            }
            
            echo'</table>';

            echo '<h3>La suppression de ' . $logeSelect[2] . ' sera définitive, êtes vous sur?</h2>';

            echo '<input id="ButAct" type="submit" onClick="window.location.href=\'http://localhost/immochateau/index.php?page=location&etat=delete&delete=' . $logeSelect[0] . '&confirme=1\';" value="Oui"/>';
            echo '<input id="ButAct" type="submit" onClick="window.location.href=\'http://localhost/immochateau/index.php?page=location\';"  value="Non"/>';
        }
        break;
        //EDITION D UN LOGEMENT
    case 'edit':
        $id = intval($_GET['edit']);
        $logeSelect = $loge->find($id);
        $result=$loge->info_Table();
        
        echo '<h2>Modification logement :</h2>';
        echo'<form method="POST" action="includes/logement_edit.php">';
        echo '<table class="tabledit" border="2">';

        for($i=0;$i<count($logeSelect);$i++){
            if($result[$i]!='date_Post'){
                if($result[$i]=='id'){
                    echo'<tr> <td>'.$result[$i].' </td>  <td><input name="'.$result[$i].'" type="hidden" value="'.$logeSelect[$i].'" /></td> </tr>';
                }
            else if ($result[$i]=='Description') {
                echo'<tr> <td>'.$result[$i].' </td>  <td><textarea name="'.$result[$i].'" rows="5" cols="40">'.$logeSelect[$i].'</textarea></td> </tr>';
            }else if($result[$i]=='Meubles'){
                echo '<tr class="rowAdd"><td>' . $result[$i] . '</td><td><input name="'.$result[$i].'" type="radio" value="1" '.(($logeSelect[$i]==1) ? 'checked' : '').'>Oui</input>
                <input name="'.$result[$i].'" type="radio" value="0" '.(($logeSelect[$i]==0) ? 'checked' : '').'>Non</input></td></tr>';
            }else if($result[$i]=='Charges_inc'){
                echo '<tr class="rowAdd"><td>' . $result[$i] . '</td><td><input name="'.$result[$i].'" type="radio" value="1" '.(($logeSelect[$i]==1) ? 'checked' : '').'>Oui</input>
                <input name="'.$result[$i].'" type="radio" value="0" '.(($logeSelect[$i]==0) ? 'checked' : '').'>Non</input></td></tr>';
            
            
            }else{
                echo'<tr> <td>'.$result[$i].' </td>  <td><input name="'.$result[$i].'" type="text" value="'.$logeSelect[$i].'"/></td> </tr>';
            }
            
            }
        }
        echo'</table>';
        echo'<div class="divbut">';
        echo'<input type="submit" value = "Valider">';
        echo'<a class="btn btn-danger" href="index.php?page=location">Cancel</a>';
        //echo'<input class="butadd" type="button" onClick="window.location.href=\'http://localhost/immochateau/includes/logement_add.php\';" Value="Valider"/>';
        //echo'<input class="butadd" type="button" onClick="window.location.href=\'http://localhost/immochateau/index.php?page=location\';" Value="Annuler"/>';
        echo'</div>';
        echo '</form>';
        break;
        //AJOUTER D UN LOGEMENT
    case 'add':
        echo '<h2>Ajout d\'un logement</h2>';
       echo'<form method="POST" action="includes/logement_add.php">';
        echo '<table class="tableprod" border="2">';
        foreach ($loge->info_Table() as $ligneName) {
            if ($ligneName != 'id' && $ligneName!='date_Post') {
                if($ligneName=='Description'){
                    echo '<tr class="rowAdd"><td>' . $ligneName . '</td><td><textarea name="'.$ligneName.'" class="textarea" rows="10" cols="40"></textarea></td></tr>';
                } else if($ligneName=='Meubles'){
                echo '<tr class="rowAdd"><td>' . $ligneName . '</td><td><input name="'.$ligneName.'" type="radio" value="true">Oui</input>
                <input name="'.$ligneName.'" type="radio" value="false">Non</input></td></tr>';
                }else if($ligneName=='Charges_inc'){
                    echo '<tr class="rowAdd"><td>' . $ligneName . '</td><td><input name="'.$ligneName.'" type="radio" value="true">Oui</input>
                <input name="'.$ligneName.'" type="radio" value="false">Non</input></td></tr>';
                }else{
                    echo '<tr class="rowAdd"><td>' . $ligneName . '</td><td><input name="'.$ligneName.'" type="text"/></td></tr>';
                }
        }
}
echo '</table>';
echo'<div class="divbut">';
echo'<input type="submit" value = "Valider">';
echo'<a class="btn btn-danger" href="index.php?page=location">Cancel</a>';
//echo'<input class="butadd" type="button" onClick="window.location.href=\'http://localhost/immochateau/includes/logement_add.php\';" Value="Valider"/>';
//echo'<input class="butadd" type="button" onClick="window.location.href=\'http://localhost/immochateau/index.php?page=location\';" Value="Annuler"/>';
echo'</div>';
echo'</form>'; 



break;
    default:
        echo '<h2>Liste des produits</h2>';
      

        echo '<a href="index.php?page=location&etat=add">Ajouter un logement</a>';
      //  echo '<form method="POST" action="">';
        echo '<table class="tableprod" border="2">';
        echo '<tr>';
        foreach ($loge->info_TableshortView() as $nameCollumn) {

                echo '<th>' . $nameCollumn . '</th>';
            
        }
        echo '<th>Visualiser</th>';
        echo '<th>Supprimer</th>';

        echo '</tr>';

        foreach ($loge->findShortView() as $logement ) {
            echo "<tr>";

            foreach ($logement as $subArray => $item) { 
                if($subArray!='id'){
                    if(strlen($item)>255){
                        echo '<td>'. substr($item,0,200).'...</td>';
                    }else{
                        echo '<td>'. $item . '</td>';
                    }
                }
            }
            echo '<td><input type="submit" onClick="window.location.href=\'http://localhost/immochateau/index.php?page=location&etat=edit&edit=' .$logement['id'] . '\';" value="Visualiser"/></td>';
            echo '<td><input type="submit" onClick="window.location.href=\'http://localhost/immochateau/index.php?page=location&etat=delete&delete=' . $logement['id'] . '\';" value="Supprimer" /></td>';
            echo "</tr>";
        }

        echo '</table>';
        //echo '</form>';
        break;
}


?>