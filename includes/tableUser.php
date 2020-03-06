<?php
class tableUser extends PDOConnect{
    
    public function findUser($mail) {
        $req = "SELECT name_user,password_user, niveau FROM ".$this->tableName." WHERE email_user=:mail";
        //Debuger($req);
        $stmt= $this->pdo->prepare($req);
        $stmt->bindValue(":mail", $mail);
        if($stmt->execute()){
            $result=$stmt->fetch(PDO::FETCH_NUM);
        }
        return $result;  
    }
    
    
}

?>