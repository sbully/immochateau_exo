<?php
require 'PDOConnect.php';
require 'logement.php';
require 'Logements.php';
require 'tableUser.php';

function Debuger($var, $exit=null)
{
    echo'<pre>';
    echo var_export($var);
    if($exit!==null)
        exit();
        
}
?>