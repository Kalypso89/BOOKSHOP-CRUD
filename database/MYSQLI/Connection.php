<?php

require "./.config";//I'm adding $password here to use it later as a parameter 

$server = "localhost";
$database = "bookshop";
$username = "root";

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