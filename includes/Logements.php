<?php


class Logements extends PDOConnect
{

    /*public function find(int $id)
    {
        $sql = "SELECT * FROM ".$this->tableName." WHERE id = :idselect";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idselect', $id, PDO::PARAM_INT);

        $stmt->setFectMode(PDO::FETCH_CLASS, 'logements');
        if ($stmt->execute()) {
            $result = $stmt->fecth();
        }
        $stmt->closecursor();
        return $result;
    }*/
    
    public function find(int $id)
    {
        $sql = "SELECT * FROM ".$this->tableName." WHERE id = :idselect";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idselect', $id, PDO::PARAM_INT);
        
        $stmt->setFetchMode(PDO::FETCH_NUM);
        if ($stmt->execute()) {
            $result = $stmt->fetch();
        }
        $stmt->closecursor();
        return $result;
    }

    public function findAll()
    {
        $sql = "SELECT * FROM ". $this->tableName."ORDER BY date_Post DESC";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll();
        }
        $stmt->closecursor();
        return $result;
    }
    
    public function findShortView(){
        $sql = "SELECT id,Type_bien,Titre,Nombre_pieces,Surface,Prix_loc,Description,GES,Classe_eco FROM ". $this->tableName;
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll();
        }
        $stmt->closecursor();
        return $result;
    }
    
    public function info_TableshortView(){
        $sql = "SELECT Type_bien,Titre,Nombre_pieces,Surface,Prix_loc,Description,GES,Classe_eco FROM ". $this->tableName;
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute()) {
            $nbrcol= $stmt->columnCount();
            for($i=0;$i<$nbrcol;$i++){
                $nameTable[$i]=$stmt->getColumnMeta($i)['name'];
            }

        }
        $stmt->closecursor();
        return $nameTable;
    
    }
    

    public function insert(logement $loger){
        $sql = "INSERT INTO ".$this->tableName.
        " (Type_bien,Titre,Nombre_pieces,Surface,Prix_loc,Description,
GES,Classe_ECO,Meubles,Localisation,Id_ville,
Departement,Id_proprietaire,Charges_inc,Montant_charges) 
Value (:typebien,:titre,:nbrpiece,:surface,:prixloc,
:descrip,:GES,:ClasseEco,:Meubles,:local,:idville,:departement,:idproprio,:chargeinc,:montantcharge)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':typebien', $loger->Type_bien);
        $stmt->bindValue(':titre', $loger->Titre);
        $stmt->bindValue(':nbrpiece', $loger->Nombre_pieces);
        $stmt->bindValue(':surface', $loger->Surface);
        $stmt->bindValue(':prixloc', $loger->Prix_loc);
        $stmt->bindValue(':descrip', $loger->Description);
        $stmt->bindValue(':GES', $loger->GES);
        $stmt->bindValue(':ClasseEco', $loger->Classe_ECO);
        $stmt->bindValue(':Meubles', $loger->Meubles,PDO::PARAM_BOOL);
        $stmt->bindValue(':local', $loger->Localisation);
        $stmt->bindValue(':idville', $loger->Id_ville);
        $stmt->bindValue(':departement', $loger->Departement);
        $stmt->bindValue(':idproprio', $loger->Id_proprietaire);
        $stmt->bindValue(':chargeinc', $loger->Charges_inc,PDO::PARAM_BOOL);
        $stmt->bindValue(':montantcharge', $loger->Montant_charges);
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    public function update(logement $loger){
        $sql = "UPDATE ".$this->tableName." SET 
Type_bien=:typebien, 
Titre= :titre, 
Nombre_pieces=:nbrpiece,
Surface=:surface, 
Prix_loc=:prixloc, 
Description=:descrip, 
GES=:GES, 
Classe_ECO=:classeEco,
Meubles=:meubles,
Localisation=:local,
Id_ville=:idville,
Departement=:departement,
Id_proprietaire=:idproprio,
Charges_inc=:chargeinc,
Montant_charges=:montantcharge
WHERE id= :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $loger->id);
        $stmt->bindValue(':typebien', $loger->Type_bien);
        $stmt->bindValue(':titre', $loger->Titre);
        $stmt->bindValue(':nbrpiece', $loger->Nombre_pieces);
        $stmt->bindValue(':surface', $loger->Surface);
        $stmt->bindValue(':prixloc', $loger->Prix_loc);
        $stmt->bindValue(':descrip', $loger->Description);
        $stmt->bindValue(':GES', $loger->GES);
        $stmt->bindValue(':classeEco', $loger->Classe_ECO);
        $stmt->bindValue(':meubles', $loger->Meubles,PDO::PARAM_INT);
        $stmt->bindValue(':local', $loger->Localisation);
        $stmt->bindValue(':idville', $loger->Id_ville);
        $stmt->bindValue(':departement', $loger->Departement);
        $stmt->bindValue(':idproprio', $loger->Id_proprietaire);
        $stmt->bindValue(':chargeinc', $loger->Charges_inc,PDO::PARAM_INT);
        $stmt->bindValue(':montantcharge', $loger->Montant_charges);
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    public function delete(int $id){
        $sql = "DELETE FROM ". $this->tableName." WHERE id= :iddelete";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':iddelete', $id);
        $stmt->execute();
        $stmt->closecursor();
    }
    
    public function info_Table()
    {
        $sql = "SELECT * FROM " . $this->tableName;

        $stmt = $this->pdo->prepare($sql);
        
        if ($stmt->execute()) {
            $nbrcolumn = $stmt->columnCount();
            for ($i = 0; $i < $nbrcolumn; $i ++) {
                $metaResultatName[$i] = $stmt->getColumnMeta($i)['name'];
            }
        }
        $stmt->closeCursor();
        return $metaResultatName;
    }
/*
    public function rendre_html()
    {
        
        echo '<h2>Liste des produits</h2>';
        echo '<table class="tableprod" border="2">';
        echo '<tr>';
        
        foreach ($this->info_Table() as $nameCollumn){
            echo '<th>'.$nameCollumn.'</th>';
        }

        echo'</tr>';

        foreach ($this->findAll() as $logement => $subArray) {
            echo "<tr>";
            foreach ($subArray as $item) {
                    echo '<td>' . $item . '</td>';
                }
            echo "</tr>";
        }
    }*/
}