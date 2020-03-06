
<?php

function autoLoad($classname){
    $path=(__DIR__.'/includes/'.$classname.'.php');
    if(is_file($path)){
        require $path;
    }else{
        exit("Erreur Fatal (autoLoad)");
    }
}

spl_autoload_register("autoLoad");


require("includes/header.php");
include("includes/logo.php");
include("includes/menu.php");
include("includes/pitch.php");
include("includes/connect.php");


$page=(empty($_GET['page'])?'accueil':$_GET['page']);
$path='./includes/'.$page.'.php';

if(is_file($path)){
    require $path;
}else{
    echo'Error Page Not Found';
}


//echo'</section>';


//include("includes/actu.php");

require("includes/footer.php");