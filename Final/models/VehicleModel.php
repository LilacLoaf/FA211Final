<?php
/*
 * Author: Nicholas Weatherspoon
 * Date: 11/20/2025
 * Description: Model for Vehicle-related database operations
 */

//Creating the vehicle model class.
class VehicleModel {
    //Making sure we are connecting to the database.
    private $conn;

    //Constructing the connection for the database
    public function __construct() {
        $this->conn = new mysqli("localhost", "phpuser", "phpuser", "rental_cars");
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    // Get all vehicles information from the database table.
    public function getAllVehicles(): array {
        $result = $this->conn->query("SELECT * FROM vehicles");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Get a single vehicle that from the table using it's allocated id.
    public function getVehicleById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM vehicles WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Add a new vehicle to the table
    public function addVehicle(array $vehicleData): bool {
        $stmt = $this->conn->prepare("INSERT INTO vehicles (make, model, year, color)");
        if (!$stmt) {
            return false;
        }

        $color = !empty($vehicleData['color']) ? $vehicleData['color'] : null;

        $stmt->bind_param(
            "ssis",  // s = string, i = integer
            $vehicleData['make'],
            $vehicleData['model'],
            $vehicleData['year'],
            $color
        );

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

}
