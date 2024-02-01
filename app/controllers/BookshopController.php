<?php

namespace App\Controllers;

use Database\PDO\DatabaseConnection;
use Exception;

//Class available as namespace
class BookshopController
{
    private $server;
    private $username;
    private $password;
    private $database;
    private $connection;

    // Function to create the instances of the class
    public function __construct($password)
    {
        $this->server = "localhost";
        $this->username = "root";
        $this->password = $password;
        $this->database = "bookshop";

        //Instantiate the object of the connection
        $this->connection = new DatabaseConnection(
            $this->server,
            $this->username,
            $this->password,
            $this->database
        );
        //Connect to the database
        $this->connection->connect();
    }



    //DIFERENTES MÉTODOS
    /**
     * INDEX: Vista que muestra las listas/colecciones de todos los registros de una entidad dada
     */

    public function index($table)
    {
        // construir la consulta
        $query = "SELECT * FROM $table";

        try {
            $statement = $this->connection->get_connection()->prepare($query);
            $statement->execute();

            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if ($results) {
                foreach ($results as $row) {
                    echo $row['id'] . "\n";
                    echo $row['title'] . "\n";
                    echo $row['author'] . "\n";
                    echo $row['genre'] . "\n";
                    echo $row['price'] . "\n";
                }
                echo "All data from the table {$table} has been successfully displayed";
                return $results;
            }
        } catch (Exception $e) {
            echo "An error occurred when trying to display all data from the table {$table}; try it again later";
        }
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
            $statement->execute([
                $data['title'], $data['author'],
                $data['genre'], $data['price']
            ]);
            if ($statement->rowCount() > 0) {
                echo "The book {$data['title']} has been successfully stored in the database";
            }
            return $statement->rowCount();
        } catch (Exception $e) {
            echo "An error occurred when trying to store the data; try it again later";
            return null;
        }
    }

    /**
     * SHOW: Vista que muestra/selecciona un elemento dado
     */

    public function show($table, $id)
    {
        // construir la consulta
        $query = "SELECT * FROM $table WHERE id=$id";

        try {
            $statement = $this->connection->get_connection()->prepare($query);
            $statement->execute();

            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if ($results) {
                echo $results[0]['id'] . "\n";
                echo $results[0]['title'];
                echo $results[0]['author'] . "\n";
                echo $results[0]['genre'] . "\n";
                echo $results[0]['price'] . "\n";
                echo "All data from the book whose id {$id} has been successfully displayed";
                return $results;
            }
        } catch (Exception $e) {
            echo "An error occurred when trying to display all data from the book whose id {$id}; try it again later";
        }
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

    public function delete($id)
    {
        //FALTA comprobar que existe la fila que se quiere eliminar

        // construir la query
        $query = "DELETE FROM books WHERE id = $id";
        try {
            $statement = $this->connection->get_connection()->prepare($query);
            $statement->execute();
            if ($statement->rowCount() > 0) {
                echo "The book with the id {$id} has been successfully deleted from the database";
            } else {
                echo "No rows were deleted";
            }
            return $statement->rowCount();
        } catch (Exception $e) {
            echo "An error occurred when trying to delete the data; try it again later";
            return null;
        }
    }
}
