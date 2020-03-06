
<div id="mainmenu">

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">

			<div class="navbar-header">
				<button class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#objectif_un">
					<span class="sr-only">Barre de navigation</span><span
						class="glyphicon glyphicon-menu-hamburger"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="objectif_un">
				<ul class="nav navbar-nav">
				<?php 
				addli("","Accueil");
				addli("page=agence","Agence");
				addli("page=services","Services");
				addli("page=achat","Achat");
				addli("page=location","Location");
				addli("page=contact","Contact");

				
                if (isset($_SESSION['identifiant']) && ! empty($_SESSION['identifiant']) && isset($_SESSION['niveau']) && $_SESSION['niveau'] == 2) {
                    
                    addli("page=GestLoc","Gérer Location");
                } else if (isset($_SESSION['identifiant']) && ! empty($_SESSION['identifiant']) && isset($_SESSION['niveau']) && $_SESSION['niveau'] == 1) {
                    addli("page=GestLoc","Gérer Location");
                    addli("page=GestAchat","Gérer Achat/Vente");
                }
                addli("page=login","Login");
                ?>

				</ul>
            -->
<?php


            function addLi($lien, $name)
            {
                $class = "";
                $link="index.php";
                if(!empty($lien)){
                    $link.="?".$lien;
                }

                if (empty($_SERVER['QUERY_STRING'])) {
                    if(empty($lien)){
                        $class="active";
                    }
                   
                } else if($_SERVER['QUERY_STRING']==$lien){
                    $class="active";
                }
                
                echo'<li class="'.$class.'"><a href="' . $link . '">' . $name . '</a></li>';
            }
            ?>
             </div>
		</div>
	</nav>

</div>