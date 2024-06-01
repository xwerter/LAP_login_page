<?php

function db_connect($data_base = "test_login")
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $data_base);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
function db_close($conn)
{
    $conn->close();
}

function check_nickname($conn, $nickname)
{
    $gefunden = false;

    $sql = "SELECT nickname
            FROM tbl_user";
    $result = $conn->query($sql) or die("FEHLER: ". $conn->error);

    if ($result->num_rows > 0) {
        // output data of each row
       while($row = $result->fetch_assoc()) {
           if ($row["nickname"] == $nickname) { 
               $gefunden = true;
               break;
           }
       }
    }

    if ($gefunden) {
        return true;
    }

    return false;
}

function logedin_as_admin()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION["loggedin"]) AND $_SESSION["loggedin"] === true AND $_SESSION["rolle"] === "Admin"){
        return true;
    }
    return false;
}

function logedin(): bool
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION["loggedin"]) AND $_SESSION["loggedin"] === true){
        return true;
    }
    return false;
}

function get_loged_nickname(): string
{
    if (logedin())
    {
        return $_SESSION["nickname"];
    }
    return "";
}

function get_loged_rolle(): string
{
    if (logedin())
    {
        return $_SESSION["rolle"];
    }
    return "";
}

?>