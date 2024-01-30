<?php

namespace App\Controllers;

use Database\PDO\DatabaseConnection;
use Exception;

require "vendor/autoload.php";

//clase disponible como namespace
class BookshopController
{
    private $server;
    private $username;
    private $password;
    private $database;
    private $connection;

    // función constructura
    public function __construct($password)
    {
        $this->server = "localhost";
        $this->username = "root";
        $this->password = $password;
        $this->database = "bookshop";

        //instanciar el objeto de la conexión
        $this->connection = new DatabaseConnection(
            $this->server,
            $this->username,
            $this->password,
            $this->database
        );
        //conectar la base de datos
        $this->connection->connect();
    }



    //DIFERENTES MÉTODOS
    /**
     * INDEX: Vista que muestra las listas/colecciones de todos los registros de una entidad dada
     */

    public function index()
    {
    }

    /**
     * CREATE: Vista de un formulario que permite capturar la data de un elemento dado
     */

    public function create()
    {
    }

    /**
     * STORE: Inserta en la base de datos lo que recibe del formulario de CREATE
     */
    public function store($data)
    {
        // construir la consulta
        $query = "INSERT INTO books (title, author, genre, price) VALUES (?, ?, ?, ?)";
        try {
            $statement = $this->connection->get_connection()->prepare($query);
            $results = $statement->execute([
                $data['title'], $data['author'],
                $data['genre'], $data['price']
            ]);
            if (!empty($results)) {
                $response = "The book {$data['title']} has been successfully stored in the database";
                var_dump($response);
                return [$results, $response];
            }
        } catch (Exception $e) {
            echo "An error occurred when trying to store the data; try it again later";
        }
    }

    /**
     * SHOW: Vista que muestra/selecciona un elemento dado
     */

    public function show()
    {
    }

    /**
     * EDIT: Vista que muestra un formulario que permita modificar los datos de un elemento seleccionado (debe hacer una query para traerse los datos, DEBE CONSULTAR LOS DATOS); usa un poco el STORE también??
     */
    public function edit()
    {
    }
    /**
     * UPDATE: Actualiza en la base de datos lo que recibe del formulario de EDIT
     */
    public function update()
    {
    }
    /**
     * DELETE: Elimina un elemento dado
     * EJEMPLO: DELETE FROM `books` WHERE `books`.`id` = 12
     */
    public function delete()
    {
    }
}
