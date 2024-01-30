<?php

namespace Database\PDO; //Class's surname  


class DatabaseConnection
{
    private $server;
    private $database;
    private $username;
    private $password;
    private $connection;

    public function __construct($server, $username, $password, $database)
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect()
    {
        try {
            $this->connection = new \PDO(
                "mysql:host=$this->server;dbname=$this->database",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(
                \PDO::ATTR_ERRMODE,
                \PDO::ERRMODE_EXCEPTION
            );
            $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $setNames = $this->connection->prepare("SET NAMES 'utf8'");
            $setNames->execute();
        } catch (\PDOException $e) {
            echo "Connection to database has failed: " . $e->getMessage();
        }
    }

    public function get_connection()
    {
        return $this->connection;
    }
}

require "./.config"; //If I do it this way. I have to type php .\database\PDO\DatabaseConnection.php in the terminal

$server = "localhost";
$database = "bookshop";
$username = "root";

//Instance the object of the connection 
$databaseConnection = new DatabaseConnection($server, $username, $password, $database);

//Connect to my database
$databaseConnection->connect();

//Execute my query 
$query = 'SELECT * FROM books';
$results = $databaseConnection->get_connection()->query($query);

//Obtain the results 
foreach ($results as $row) {
    echo $row['title'] . "\n";
}
