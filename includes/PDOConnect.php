<?php

abstract class PDOConnect{

protected static $_instance = null;
protected $pdo;
protected $tableName;
protected $host;
protected $dbname;

public static function getInstance(){
    try{
    if(self::$_instance === NULL)
        self::$_instance= new PDO(
            'mysql:host=localhost;dbname=immoduchateau;charset=utf8',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
            );
        return self::$_instance;
    }catch(PDOException $Eo){
        echo 'la connexion à échouer';
        echo 'Information :['.$Eo->getCode(),']'. $Eo->getMessage();
    }
    return self::$_instance;
}
//$loge = new Logements("localhost","immoduchateau","logements","root","");
    function __construct($tableName){
    $this->pdo = PDOConnect::getInstance();
    $this->tableName=$tableName;
}


}