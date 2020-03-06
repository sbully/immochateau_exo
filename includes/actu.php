	
    	<!-- side -->
    <div id="divlog">
				<h4 style="color:#3D1F1F;text-shadow: 1px 2px 3px rgba(0,0,0, 0.5);">Dernière locations rentrées</h4>
                
                <div class="news">
					<h5><a href="#">Millefeuille d'artichauts</a></h5>
					<p>Nunc commodo euismod massa quis vestibulum, proin mi nibh, dignissim.</p>
				</div>
			
<h3 style="text-align:center">ACCES MEMBRES</h3>                                               <p>      
				  </p>
<?php 
//include('models/guide.php');
//session_start();
//Debuger($_SESSION);
if(isset ($_SESSION['identifiant']))
{
    if(!empty($_POST)&& $_POST['quitter']){
        session_destroy();
        echo'<meta http-equiv="refresh" content="0;url=index.php"  />';
        //header('location:../index.php');
    }else {
	echo'Vous etes bien connecté en tant qu\'utlisateur : '.$_SESSION['identifiant'];
		
		echo'<br /><br /><form id="deco" action="index.php?page=login" method="POST">
<input type="submit" value="Deconnection" name="quitter" id="quitter" style="float:left !important; clear:both;" /><br />
</form>';
    }
		//var_dump($_SESSION);
	
}
else if(isset($_POST['validation']))
{
    
   // Debuger($_POST);
	if(!empty($_POST['identifiant']) && !empty($_POST['pwd']))
	{
		$email = $_POST['identifiant'];
		$mdp= $_POST['pwd'];
		//$mdp = crypt($_POST['pwd'], "latruite");
		//$user = new MYTABLE('IMMO_UTILISATEURS');
		//$TabUser = $user->SelectByOne($email,$mdp);
		$userTable= new tableUser('users');
		$user=$userTable->findUser($email);
		$boolVerif = password_verify($mdp, $user[1]);
		
		if( $user!=NULL&& $boolVerif)
		{
		    $_SESSION['identifiant'] = $user[0] ;
		    $_SESSION['niveau']=$user[2];
			
		echo 'Bravo vous êtes bien connecté en tant qu\'utilisateur :'.$_SESSION['identifiant'];
		echo'<META http-equiv="refresh" content="2; URL="'.$_SERVER['PHP_SELF'].'">';
		}
		 else
		 {
			echo'Identifiant ou Mot de passe incorrect ! ';
			echo'<form id="verif" name="verif" action="index.php?page=login" method="POST" enctype="multipart/form-data">
					
 <p style="text-align:left;"><label style="font-family:Verdana, Geneva, sans-serif"> email  </label>
 <input id="identifiant" name="identifiant" value="" type="text"></p>
                        <p style="text-align:left; "><label style="font-family:Verdana, Geneva, sans-serif" >Mot de passe : </label>
                        <input type="password" id="pwd" name="pwd" value="" /></p>
                        <p style="text-align:left; width:100%"><input id="validation" name="validation" value="Valider" style=" text-align:center" type="submit"></p>
                   </form>'; 
		}
			 
	
	
	}
	else {		 
	
echo'Veuillez saisir tous les champs !';
	}
	
}
else{
				   echo'<form id="verif" name="verif" action="'.$_SERVER['PHP_SELF'].'?page=login" method="POST" enctype="multipart/form-data" >';
					
echo'<table class="tablelog" >';
echo'<tr><td class="tableTitle"><label style="font-family:Verdana, Geneva, sans-serif"> email : </label></td></tr>';
echo'<tr><td><input id="identifiant" name="identifiant" value="" type="text"> </td></tr>';
echo'<tr><td class="tableTitle"><label style="font-family:Verdana, Geneva, sans-serif"> password : </label></td></tr>';
echo'<tr><td><input type="password" id="pwd" name="pwd" value="" /></td></tr>';
echo'<tr><td> <p> </p></td></tr>';
echo'<tr><td class="tablevalid"><input id="validation" name="validation" value="Valider" type="submit"></td></tr>';
echo'</table>';
echo'</form>';


				}
?>
<br>

				
				
				
				
			
				
				
				<!--<div class="news">
					<h5><a href="#">Ecrevisses au curry</a></h5>
					<p>Nunc commodo euismod massa quis vestibulum, proin mi nibh, dignissim.</p>
				</div>
				
				<div class="news">
					<h5><a href="#">Sabayon gratiné</a></h5>
					<p>Nunc commodo euismod massa quis vestibulum, proin mi nibh, dignissim.</p>
				</div>-->
				
				<div id="quote">
					
                    <h4   style="color:#3D1F1F;text-shadow: 1px 2px 3px rgba(0,0,0, 0.5);" >Vous souhaitez réaliser un projet</h4>
					<p>Ecrivez-nous à l'adresse ci-dessous ou utilisez la page contact</p>
				</div>
</div>

            	<!-- side -->