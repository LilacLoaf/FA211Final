<?php

/* Author: Louie Zhu
 * Date: 03/09/2024
 * Name: database.class.php
 * Description: the Database class sets the database details.
 */

class Database {

    // define database parameters
    private $param = array(
        'host' => '127.0.0.1',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'usersystem',
        'tblUser' => 'users'
    );

    // define the database connection object
    private ?object $objDBConnection;
    static private ?object $_instance = null;

    // constructor
    public function __construct() {
        $this->objDBConnection = new mysqli(
            $this->param['host'],
            $this->param['login'],
            $this->param['password'],
            $this->param['database']
        );

        if (mysqli_connect_errno() != 0) {
            exit("Connecting to database failed: " . mysqli_connect_error());
        }
    }

    // static method to ensure there is just one Database instance
    static public function getInstance(): ?Database {
        if (self::$_instance == null) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    // returns the database connection object
    public function getConnection(): mysqli {
        return $this->objDBConnection;
    }

    // returns the name of the table storing users
    public function getUserTable(): string {
        return $this->param['tblUser'];
    }
}
