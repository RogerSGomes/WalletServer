<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_wallet";

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);
$connect->set_charset("utf8");

// Check connection
if ($connect->connect_error) {
    echo ('{
        "status" : 400,
        "response" : "Não foi possível se conectar com o banco de dados"
    }');
}
