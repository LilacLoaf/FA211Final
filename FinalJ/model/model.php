<?php
/**
 * Author: Jonathan Nguyen
 * Date: 12/4/2025
 * File: model.php
 * Description: Cars Model (Singleton) - Works with Database Singleton
 */

class CarsModel {

    private Database $db;
    private mysqli $conn;
    private static ?CarsModel $_instance = null;

    // table names
    private string $tblVehicles;
    private string $tblUsers;
    private string $tblJunction;

    // private constructor for singleton
    private function __construct() {

        // IMPORTANT: use Database::getDatabase() instead of new Database()
        $this->db = Database::getDatabase();
        $this->conn = $this->db->getConnection();

        // get table names from Database class
        $this->tblVehicles = $this->db->getVehiclesTable();
        $this->tblUsers    = $this->db->getUsersTable();
        $this->tblJunction = $this->db->getJunctionTable();

        // sanitize POST and GET
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->conn->real_escape_string($value);
        }
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->conn->real_escape_string($value);
        }
    }

    // singleton accessor
    public static function getModel(): CarsModel
    {
        if (self::$_instance === null) {
            self::$_instance = new CarsModel();
        }
        return self::$_instance;
    }

    /* ============================
       VEHICLE METHODS
       ============================ */

    public function getCars(): array|false
    {
        $sql = "SELECT * FROM $this->tblVehicles";
        $result = $this->conn->query($sql);

        if (!$result) return false;

        $vehicles = [];
        while ($row = $result->fetch_assoc()) {
            $vehicles[] = $row;
        }
        return $vehicles;
    }

    public function getCarByID($id): array|false
    {
        $sql = "SELECT * FROM $this->tblVehicles WHERE id='$id' LIMIT 1";
        $result = $this->conn->query($sql);

        return ($result && $result->num_rows > 0)
            ? $result->fetch_assoc()
            : false;
    }

    /* ============================
       USER METHODS
       ============================ */

    public function getUsers(): array|false
    {
        $sql = "SELECT * FROM $this->tblUsers";
        $result = $this->conn->query($sql);

        if (!$result) return false;

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function getUserByID($id): array|false
    {
        $sql = "SELECT * FROM $this->tblUsers WHERE id='$id' LIMIT 1";
        $result = $this->conn->query($sql);

        return ($result && $result->num_rows > 0)
            ? $result->fetch_assoc()
            : false;
    }

    public function getJunctionByID($id): array|false
    {
        $sql = "SELECT * FROM $this->tblJunction WHERE id='$id' LIMIT 1";
        $result = $this->conn->query($sql);

        return ($result && $result->num_rows > 0)
            ? $result->fetch_assoc()
            : false;
    }

    public function searchCars(string $query, string $mode = 'AND'): array {
        $keywords = array_filter(explode(" ", trim($query)));
        if (empty($keywords)) return [];

        $connector = strtoupper($mode) === 'OR' ? 'OR' : 'AND';

        $where = array_map(function ($word) {
            $word = $this->conn->real_escape_string($word);
            return "(brand LIKE '%$word%' 
                 OR model LIKE '%$word%' 
                 OR licensePlate LIKE '%$word%')";
        }, $keywords);

        $sql = "SELECT * FROM $this->tblVehicles WHERE " . implode(" $connector ", $where);
        $result = $this->conn->query($sql);

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }


}
