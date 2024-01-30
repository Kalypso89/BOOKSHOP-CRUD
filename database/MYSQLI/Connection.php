<?php

// require "../../.config"; // If I do it this way, I have to type php Connection.php in the terminal

require "./.config"; //If I do it this way, I have to type php .\database\MYSQLI\Connection.php in the terminal


$server = "localhost";
$database = "bookshop";
$username = "root";

# ---------CONNECT-----------

//a. Structure based on procedures/methods/(algorithms, functions)

$mysqliPr = mysqli_connect($server, $username, $password, $database);

if (!$mysqliPr) {
    die("Connection to database " . mysqli_connect_error() . "has failed");
}
echo "Connection established" . "\n";

//b. Structure based on OOP

$mysqliOpp = new mysqli($server, $username, $password, $database);

if ($mysqliOpp->connect_errno) {
    die("Connection to database {$mysqliOpp->connect_error} has failed");
}
$setNames = $mysqliOpp->prepare("SET NAMES 'utf8'");
$setNames->execute();
var_dump($setNames);
echo "Connection established" . "\n";
