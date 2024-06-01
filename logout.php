<?php
require("includes/functions.php");
session_start();
if(!isset($_SESSION["loggedin"]) OR $_SESSION["loggedin"] === false){
    header("location: index.php");
    exit;
}

session_unset();
session_destroy();

echo "Sie wurden Abgemeldet!";

header("refresh:1;url=index.php");



?>

