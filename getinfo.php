<?php
session_start();
require('functions.php');
require('headers.php');

$html = "";

if(isset($_SESSION["user"])){
        $conn = createDbConnection();

        $sql = "SELECT * FROM info
        WHERE username LIKE '%" . $_SESSION["user"] . "%'";

        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $rows = $prepare->fetchAll();

        $html = '<h1>Your info</h1>';
        $html .= '<ul>';

        foreach($rows as $row) {

            $html .= '<li>Your username: ' . $row['username'] . '</li>';
            $html .= '<li>Your phonenumber: ' . $row['phonenum'] . '</li>';
            $html .= '<li>Your listed height: ' . $row['height'] . '</li>';
            $html .= '<li>Your listed weight: ' . $row['weight'] . '</li>';
        }
        $html .= '</ul>';
        echo $html;
    exit;
}
echo "You need to log in first.";
?>