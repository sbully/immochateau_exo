<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/meta.php");
include ('loader.php');
function datefr($date)
								{
								$datefr=explode('-',$date);
								$annee=$datefr[0];
								$mois=$datefr[1];
								$jour=$datefr[2];
								$madate=$jour.'-'.$mois.'-'.$annee;
								return ($madate);}
 ?>
<title>IMMO. DU CHATEAU - Agence IMMOBILIÈRE - VENTES - LOCATIONS</title>	
	<link rel="stylesheet" href="css/main.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    
     <style>
/** {
    box-sizing: border-box;
}*/
/*h4 { font-family: "latoregular",sans serif; color:#fff; font-size:1.4em; font-weight:bold}*/
input[type=text],textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
}
input[type=password]{
    width: 100%;
    padding: 12px;
    border: 1px solid #E1964B;
    border-radius: 4px;
    resize: vertical;
}
.liste
	{ width:50%;
	   padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
	float:left;
 }


label {
    padding: 12px 12px 12px 0;
    display: inline-block;
}

input[type=submit] {
    background-color: #996633;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
}
input[type=reset] {
    background-color: #996633;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
}


input[type=submit]:hover {
    background-color: #E1964B;
}
input[type=reset]:hover {
    background-color: #E1964B;
}

.conteneur2 { /*margin-top:80px;*/
	 
	 width:100%;
margin-left: auto;
  margin-right: auto;
    border-radius: 5px;
    background-color: #f2f2f2;
   /* padding: 20px; */
}
#list tr:nth-child(odd) {
   background-color: #ccc;
}
.col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
}

.col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
    .col-25, .col-75, input[type=submit], input[type=reset] {
        width: 100%;
        margin-top: 0;
    }
.conteneur{ width:100%
}	
}
</style>
<link rel="stylesheet" type "text/css" href="./css/table.css"/>
</head>
<body>
<!--<div id="body">-->
	<div id="bg">
		<div id="conteneur" >