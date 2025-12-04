<?php
/*
 * Author: Jonathan Nguyen
 * Date: 12/4/2025
 * File: database.class.php
 * Description: Database configuration for Car Rental System
 */

class Database
{
    // Database settings
    private array $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'rental_cars',
        'tblVehicles' => 'vehicles',
        'tblUsers' => 'accounts',
        'tblJunction' => 'rentedcars'
    );

    private mysqli $dbConnection;
    private static ?Database $_instance = null;

    // private constructor (singleton)
    private function __construct()
    {
        try {
            $this->dbConnection = @new mysqli(
                $this->param['host'],
                $this->param['login'],
                $this->param['password'],
                $this->param['database']
            );

            if ($this->dbConnection->connect_errno !== 0) {
                throw new DatabaseConnectionException(
                    "Database connection failed: " . $this->dbConnection->connect_error
                );
            }
        } catch (DatabaseConnectionException $e) {
            echo "<h2>Database Error</h2>";
            echo $e->getMessage();
            exit();
        }
    }

    public static function getDatabase(): Database
    {
        if (self::$_instance === null) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    public function getConnection(): mysqli
    {
        return $this->dbConnection;
    }


    public function getVehiclesTable(): string
    {
        return $this->param['tblVehicles'];
    }

    public function getUsersTable(): string
    {
        return $this->param['tblUsers'];
    }

    public function getJunctionTable(): string
    {
        return $this->param['tblJunction'];
    }
}
?>
