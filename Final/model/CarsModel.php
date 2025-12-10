<?php
/*
 * Author: Paxton Ducy
 * Date: 11/20/2025
 * Name: CarsModel.php
 * Description: Handles database interactions for vehicles and users
 */

class CarsModel {
    private static $instance = null;
    private mysqli $db;

    // 🔧 Adjust these for your local DB settings
    private string $host = 'localhost';
    private string $user = 'root';
    private string $pass = '';
    private string $dbname = 'rental_cars';

    // Singleton pattern
    private function __construct() {
        //$this->db = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        $this->db = new mysqli('127.0.0.1', 'root', '', 'rental_cars');


        if ($this->db->connect_error) {
            die("Database connection failed: " . $this->db->connect_error);
        }
    }

    // Get shared instance of model
    public static function getModel(): CarsModel {
        if (self::$instance === null) {
            self::$instance = new CarsModel();
        }
        return self::$instance;
    }

    // Get all cars
    public function getCars(): array {
        $query = "SELECT * FROM vehicles";
        $result = $this->db->query($query);

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Search cars by keyword(s) with AND/OR
    public function searchCars(string $query): array {
        $keywords = array_filter(explode(" ", trim($query)));
        if (empty($keywords)) return [];

        $where = array_map(function ($word) {
            $word = $this->db->real_escape_string($word);
            return "(make LIKE '%$word%' OR model LIKE '%$word%' OR color LIKE '%$word%' OR plate LIKE '%$word%' OR status LIKE '%$word%')";
        }, $keywords);

        $sql = "SELECT * FROM vehicles WHERE " . implode(" OR ", $where);
        $result = $this->db->query($sql);

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }





    // Placeholder for getUsers
    public function getUsers(): array {
        $query = "SELECT * FROM users";
        $result = $this->db->query($query);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Get car by ID
    public function getCarByID(int $id): ?array {
        $id = $this->db->real_escape_string($id);
        $query = "SELECT * FROM vehicles WHERE id = $id";
        $result = $this->db->query($query);
        return $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    // Placeholder for getJunction
    public function getJunction(): array {
        $query = "SELECT * FROM vehicle_user"; // Adjust to your junction table name
        $result = $this->db->query($query);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getJunctionByID(int $id): ?array {
        $id = $this->db->real_escape_string($id);
        $query = "SELECT * FROM vehicle_user WHERE id = $id";
        $result = $this->db->query($query);
        return $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    public function getUserByID(int $id): ?array {
        $id = $this->db->real_escape_string($id);
        $query = "SELECT * FROM users WHERE id = $id";
        $result = $this->db->query($query);
        return $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }
}




