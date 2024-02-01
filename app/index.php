<?php
//para construir una entrada de documentos raíz donde podamos ejecutar nuestro proyecto, para gestionar las solicitudes que vamos haciendo

use App\Controllers\BookshopController;

require "../vendor/autoload.php"; //It allows us to use Composer
require "../.config"; //If I do it this way, I have to type php app/index.php in the terminal

$bookshop = new BookshopController($password); //We instantiate the class of the controller

// $bookshop->store([
//     "title" => "Cien años de soledad",
//     "author" => "Gabriel García Márquez",
//     "genre" => "magical realism",
//     "price" => 15
// ]);

// $bookshop->delete(18);
// $bookshop->index("books");
$bookshop->show("books", 5);
