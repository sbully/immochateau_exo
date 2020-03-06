<?php
require 'loader.php';


var_dump($_POST);
if(!empty($_POST['Type_bien'])&&!empty($_POST['Titre'])&&!empty($_POST['Nombre_pieces'])&&!empty($_POST['Surface'])&&!empty($_POST['Prix_loc'])&&
    !empty($_POST['Description'])&&!empty($_POST['GES'])&&!empty($_POST['Classe_ECO'])&&isset($_POST['Meubles'])&&!empty($_POST['Localisation'])&&
    !empty($_POST['Id_ville'])&&!empty($_POST['Departement'])&&!empty($_POST['Id_proprietaire'])&&isset($_POST['Charges_inc'])&&
    !empty($_POST['Montant_charges'])){
        
        $logement= new logement();
        $logement->id=$_POST['id'];
        $logement->Type_bien=$_POST['Type_bien'];
        $logement->Titre=$_POST['Titre'];
        $logement->Nombre_pieces=$_POST['Nombre_pieces'];
        $logement->Surface=$_POST['Surface'];
        $logement->Prix_loc=$_POST['Prix_loc'];
        $logement->Description=$_POST['Description'];
        $logement->GES=$_POST['GES'];
        $logement->Classe_ECO=$_POST['Classe_ECO'];
        $logement->Meubles=$_POST['Meubles'];
        $logement->Localisation=$_POST['Localisation'];
        $logement->Id_ville=$_POST['Id_ville'];
        $logement->Departement=$_POST['Departement'];
        $logement->Id_proprietaire=$_POST['Id_proprietaire'];
        $logement->Charges_inc=$_POST['Charges_inc'];
        $logement->Montant_charges=$_POST['Montant_charges'];
        
        $loge = new Logements("logements");
        var_dump($logement);
        $loge->update($logement);
}else{
    echo 'fail';
}

header('location:../index.php?page=location');
?>