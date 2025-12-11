<?php
/*
 * Author: Paxton Ducy
 * Date: 11/20/2025
 * Name: vehicle_detail.php
 * Description: displays the individual vehicle details when you click on a specific vehicle
 */

require_once "vehicle_view.class.php";

try {
    // Ensure vehicle ID is passed
    if (!isset($_GET['id'])) {
        throw new Exception("Vehicle ID is required.");
    }

    $id = intval($_GET['id']);

    // ✅ Using your original connection line
    $conn = new mysqli("localhost", "root", "", "rental_cars");
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }

    // Prepare query to safely fetch vehicle
    $stmt = $conn->prepare("SELECT * FROM vehicles WHERE id = ?");
    if (!$stmt) {
        throw new Exception("Failed to prepare SQL statement.");
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        throw new Exception("Failed to fetch vehicle.");
    }

    $vehicle = $result->fetch_assoc();
    if (!$vehicle) {
        throw new Exception("Vehicle not found.");
    }

    // Render view
    $view = new VehicleView();
    $view->showVehicleDetail($vehicle);

    $conn->close();

} catch (Exception $e) {
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>


