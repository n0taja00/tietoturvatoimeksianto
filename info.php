<?php 

session_start();
require("headers.php");
require("functions.php");

if(isset($_SESSION["user"])){
    //tällä tein tietokantaan infot kirjautuneelle käyttäjälle
    //createInfo(createDbConnection(), "taskjaa", "358123456", "180", "80");
    exit;
}

echo "You need to log in first.";
?>