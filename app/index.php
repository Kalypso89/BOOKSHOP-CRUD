<?php
//para construir una entrada de documentos raíz donde podamos ejecutar nuestro proyecto, para gestionar las solicitudes que vamos haciendo

use App\Controllers\BookshopController;

require "vendor/autoload.php"; //It allows us to use Composer
require "./.config"; //If I do it this way, I have to type php .\app\controllers\BookshopController.php in the terminal

$bookshop = new BookshopController($password); //We instantiate the class of the controller

$bookshop->store([
    "title" => "Cien años de soledad",
    "author" => "Gabriel García Márquez",
    "genre" => "realismo mágico",
    "price" => 15
]);
