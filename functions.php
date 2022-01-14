<?php

function createDbConnection(){

    try{
        $dbcon = new PDO('mysql:host=localhost;dbname=n0taja00', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }

    return $dbcon;
}

function createCustomer(PDO $dbcon, $fname, $lname, $username, $passwd){

    $fname = filter_var($fname, FILTER_SANITIZE_STRING);
    $lname = filter_var($lname, FILTER_SANITIZE_STRING);
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $passwd = filter_var($passwd, FILTER_SANITIZE_STRING);

    try{
        $hash_pw = password_hash($passwd, PASSWORD_DEFAULT);
        $sql = "INSERT IGNORE INTO customer VALUES (?,?,?,?)";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array($fname, $lname, $username, $hash_pw));
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}

function checkCustomer(PDO $dbcon, $username, $passwd){

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $passwd = filter_var($passwd, FILTER_SANITIZE_STRING);

    try{
        $sql = "SELECT password FROM customer WHERE username=?";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array($username));

        $rows = $prepare->fetchAll();

        foreach($rows as $row){
            $pw = $row["password"];
            if(password_verify($passwd, $pw)){
                return true;
            }
        }

        return false;

    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}

function createInfo(PDO $dbcon, $username, $phonenum, $height, $weight){

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $phonenum = filter_var($phonenum, FILTER_SANITIZE_STRING);
    $height = filter_var($height, FILTER_SANITIZE_STRING);
    $weight = filter_var($weight, FILTER_SANITIZE_STRING);

    try {
        $sql = "INSERT IGNORE INTO info VALUES (?,?,?,?)";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array($username, $phonenum, $height, $weight));
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }

}
?>