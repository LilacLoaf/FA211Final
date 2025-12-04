<?php
/*
 * Author: Nichoals Weatherspoon
 * Date: 11/20/2025
 * Description: Controller for Vehicle-related actions
 */

//Creating the Database class
class Database {
    //Connecting to the database using the correct credentials.
    private $host = "localhost";
    private $user = "phpuser";
    private $pass = "phpuser";
    private $dbname = "rental_cars";

    //Function used to connect to the database
    public function connect() {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        //Error Handling in case the database cannot be connected to.
        if ($conn->connect_error) {
            die("DB connection failed: " . $conn->connect_error);
        }
        //Return the connection
        return $conn;
    }
}
