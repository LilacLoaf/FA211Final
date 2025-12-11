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

    private string $tblVehicles;

    private function __construct() {
        try {
            $this->db = Database::getDatabase();
            $this->conn = $this->db->getConnection();

            $this->tblVehicles = $this->db->getVehiclesTable();

            foreach ($_POST as $key => $value) {
                $_POST[$key] = $this->conn->real_escape_string($value);
            }
            foreach ($_GET as $key => $value) {
                $_GET[$key] = $this->conn->real_escape_string($value);
            }
        } catch (Exception $e) {
            echo "<p><strong>Error initializing CarsModel:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    public static function getModel(): CarsModel {
        if (self::$_instance === null) {
            self::$_instance = new CarsModel();
        }
        return self::$_instance;
    }

    public function getCars(): array|false {
        try {
            $sql = "SELECT * FROM $this->tblVehicles";
            $result = $this->conn->query($sql);

            if (!$result) return false;

            $vehicles = [];
            while ($row = $result->fetch_assoc()) {
                $vehicles[] = $row;
            }
            return $vehicles;
        } catch (Exception $e) {
            echo "<p><strong>Error fetching cars:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            return false;
        }
    }

    public function getCarByID($id): array|false {
        try {
            $sql = "SELECT * FROM $this->tblVehicles WHERE id='$id' LIMIT 1";
            $result = $this->conn->query($sql);

            return ($result && $result->num_rows > 0)
                ? $result->fetch_assoc()
                : false;
        } catch (Exception $e) {
            echo "<p><strong>Error fetching car by ID:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            return false;
        }
    }

    public function searchCars(string $query, string $mode = 'AND'): array {
        try {
            $keywords = array_filter(explode(" ", trim($query)));
            if (empty($keywords)) return [];

            $connector = strtoupper($mode) === 'OR' ? 'OR' : 'AND';

            $where = array_map(function ($word) {
                $word = $this->conn->real_escape_string($word);
                return "(brand LIKE '%$word%' OR model LIKE '%$word%' OR licensePlate LIKE '%$word%')";
            }, $keywords);

            $sql = "SELECT * FROM $this->tblVehicles WHERE " . implode(" $connector ", $where);
            $result = $this->conn->query($sql);

            return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        } catch (Exception $e) {
            echo "<p><strong>Error searching cars:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            return [];
        }
    }

    public function insertCar(string $brand, string $model, string $licensePlate, string $status = 'Available'): bool {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO $this->tblVehicles (brand, model, licensePlate, status) VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param("ssss", $brand, $model, $licensePlate, $status);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "<p><strong>Error inserting car:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            return false;
        }
    }
}

