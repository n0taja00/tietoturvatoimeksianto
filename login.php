<?php 
session_start();
require("headers.php");
require("functions.php");

if( isset($_SERVER['PHP_AUTH_USER']) ){
    if(checkCustomer(createDbConnection(), $_SERVER['PHP_AUTH_USER'],$_SERVER["PHP_AUTH_PW"] )){
        $_SESSION["user"] = $_SERVER['PHP_AUTH_USER'];
        echo "Login successful!";
        exit;
    }
}

header("WWW-Authenticate: Basic");
echo "Login failed";
header('Content-Type: application/json');
header('HTTP/1.1 401');
exit;
 
//näillä tein käyttäjät tietokantaan
/* createCustomer(createDbConnection(), "Kalle", "Koodari", "kallekoo", "vekkuli123");  */
/* createCustomer(createDbConnection(), "jaako", "taskila", "taskjaa", "toimisitko");  */

if(checkCustomer(createDbConnection(), "taskjaa", "toimisiko")){
    echo "Correct password!";
}else {
    echo "Wrong password!";
}

?>