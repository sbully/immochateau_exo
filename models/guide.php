<?php
class MYTABLE
{
	protected $_query;
	protected $_resultatTd;
	protected $_resultatTh;
	protected $_tabColumn;
	protected $_table;
	protected $_dbh;
	protected $_results;
	protected $queryColumn;
	protected $fields;

	function __construct($table)
	{
		
        $this->_table = $table;
        $this->_results = array();
		try 
		{   
  			$this->_dbh = new PDO('mysql:host=calicobamag.mysql.db;dbname=calicobamag', 'calicobamag', 'B82mhsp10');
		} 
		catch (PDOException $e) 
		{   
  			die( "Erreur ! : " . $e->getMessage() ); 
		}
        $queryTh = "SHOW COLUMNS FROM ".$table;
        
		$queryTd = "SELECT * FROM ".$table;
        
		$resultatTd = $this->_dbh->query($queryTd);
		$resultatTh = $this->_dbh->query($queryTh);
		
		$this->_resultatTd = $resultatTd;
		$this->_resultatTh = $resultatTh;
        $fields = $this->_resultatTd->columnCount();
		$this->fields = $fields;
		// Fermeture de la connexion 
  			//$dbh = NULL;
	}	
		public function getConnection()
		{
			return $this->_dbh;
		}
		public function getResultTd()
		{
			return $this->_resultatTd;                     
		}
		public function getResultTh()
		{
		    return $this->_resultatTh;
		}
		public function INFO_TABLE()
		{   //$compteurligne=0;
		    //$results = array();
		    //$result = ;
		    //while($ligne = $this->_resultatTh->fetch())
		    //{
		    //    $results[$compteurligne] = $ligne[0];
		        
		    //    $compteurligne++;
		    //}
		  //return $results;
		  $col = array();
		  for($i = 0; $i < $this->fields; $i++)
		  {
		      $col[$i] = $this->_resultatTd->getColumnMeta($i);
		  }
		     
		    return $col;
		}
		public function AJOUTER_DONNEES($nom, $adresse, $prix, $commentaire, $note, $visite){
		    
		    $requete = "INSERT INTO '.$this->_table.' VALUES('.$nom.', '.$adresse.', '.$prix.', '.$commentaire.', '.$note.', '.$visite.');";
            $nb_req = $this->dbh->exec($requete);
            if($nb_req == 0)
            	echo '<h3>Ajout dans la base du restaurant : '.$nom.' non effectue</h3>';
            else
            	echo '<h3>Ajout dans la base du restaurant : '.$nom.' effectue</h3>';
		}
        public function UPDATE_DONNEES($id, $nom, $adresse, $prix, $commentaire, $note, $visite)
        {
            $requeteUpdate = "UPDATE ".$this->_table." SET nom = ".$nom.", adresse = ".$adresse.", prix = ".$prix.", commentaire = ".$commentaire.", note = ".$note.", visite =".$visite." WHERE id = ".$id;
            $nb_req = $this->_dbh->exec($requeteUpdate);
            if($nb_req == 0)
            {
                echo'<h3>Edition du restaurant numéro : '.$id.'non effectuee</h3>';
            }
            else
            {
                echo'Edition du restaurant numéro : '.$id.' effectuee';
            }
        }
        public function DELETE($id)
        {
        	$requete = "DELETE FROM '.$this->_table.' WHERE ID = ".$id;
            $nb_req = $this->dbh->exec($requete);
            if($nb_req == 0)
            	echo '<h3>Echec de la suppression du restaurant numéro : '.$id.'</h3>';
            else
            	echo '<h3>Supression due restaurant numéro : '.$id. 'réussie !</h3>';
        }
        public function SelectByID($id)
        {
            $tab_donnees = array();
            $rq="SELECT * FROM ".$this->_table." WHERE ID ='".$id."'";
            
            $donnees = $this->_dbh->query($rq);
            $row = $donnees->fetch(PDO::FETCH_NUM);
            
            for ($i = 0; $i < 7; $i++) 
            {
                $tab_donnees[$i] = $row[$i];
            }
            return $tab_donnees;
        }
		
		 public function SelectCritere($champs,$valeur)
        {
            $tab_donnees = array();
            $rq="SELECT * FROM ".$this->_table." WHERE ".$champs." = '".$valeur."'";
            
            $donnees = $this->_dbh->query($rq);
            while($row = $donnees->fetch(PDO::FETCH_NUM))
			{
			echo'<tr>';
            $nbColonnes= count($row);
			 
            for ($i = 0; $i <$nbColonnes ; $i++) 
            {
				if($i > 2 && $i < 11)
				{
                	echo'<td>'.utf8_encode ($row[$i]).'</td>';
				}
            }
			echo'</tr>';
			}
            
        }
		public function SelectByOne($_mail, $_pwd)
		{
			$rq = "SELECT Nom_User, niveau FROM ".$this->_table." WHERE user_mail ='".$_mail."' AND pwd ='".$_pwd."'";
			
			//echo $rq;
			
			$state = $this->_dbh->query($rq);
			
			if($state->rowCount()==1)
			{
				$ligne =$state->fetch(PDO::FETCH_NUM);
				}
			else{
					$ligne = NULL;
					
				}
		
		return $ligne;
			/*$prep = $this->_dbh->prepare($rq);
			$prep->bindParam(':string',$mail , PDO::PARAM_STR);
			$bool = $prep->execute();
			$ligne = $prep->fetch(PDO::FETCH_ASSOC);*/
			
			
			
			if($ligne['user_mail'] == $string && $ligne['pwd'] == $pwd)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			
		}
		public function RENDRE_HTML()
		{
		   
		    $montab=$this->INFO_TABLE();
		    
			echo'<table id="list" class="table table-striped table-dark table-bordered">';
			echo'<tr>';
                    //for ($i = 0; $i < count($montab); $i++)
                    //{
                        //echo '<th>'.utf8_encode($montab[$i]).'</th>';
                    //}
                   for ($i=0; $i < $this->fields; $i++)
                   {
                       if($i > 2 && $i < 11)
					   echo'<th>'.$montab[$i]['name'].'</th>';
                   }
				   
  				echo'<th>Modifier</th><th>Supprimer</th></tr>';
			while($row = $this->_resultatTd->fetch())
			{
  				//echo'<tr><th style="font-size: 20px;">'.$row['id'].'</th>';
                for($i = 0; $i<count($montab); $i++)
                {
                    //if(count($montab['flags']) == 2)
                    //{
                        //if($montab[$flags][1] == 'primary_key')
                        //{
                            //echo'<td>'.$montab[].'</td>';
                        //}
                        //echo'<td>'.$montab[$i]['flags'][2].'</td>';
                    //}
					if($i > 2 && $i < 11)
                    echo'<td>'.utf8_encode($row[$i]).'</td>';
                }
				
                echo'<td><a href="modif_restaurant.php?edit='.$row['id'].'" class="btn btn-info">Edition</a></td><td><a href="cible.php?delete='.$row['id'].'" class="btn btn-danger">Effacer</a></td>';
               echo'</th></tr>';
            }
			echo'</table>';
  
			
		}
	
	
}
?>