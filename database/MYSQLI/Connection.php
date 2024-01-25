<?php

require "./.config";//I'm adding $password here to use it later as a parameter 

// if(!isset($_ENV["MY_PASSWORD"])){
//     die('There's no password');
// } I tried to connect to the database by adding my password as an environment variable, but it didn't work

$server = "localhost";
$database = "bookshop";
$username = "root";
// $password = $_ENV["MY_PASSWORD"]; I tried to connect to the database by adding my password as an environment variable, but it didn't work

# ---------CONNECT-----------

//a. Structure based on procedures

$mysqliPr = mysqli_connect($server, $username, $password, $database);

if(!$mysqliPr)
    die("Connection to database " . mysqli_connect_error() . "has failed");
echo "ok";

//b. Structure based on OOP

$mysqliOpp = new mysqli($server, $username, $password, $database);

if($mysqliOpp->connect_errno)
    die("Connection to database {$mysqliOpp->connect_error} has failed");
echo "ok";