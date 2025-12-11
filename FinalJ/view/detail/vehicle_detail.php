<?php
/*
 * Author: Paxton Ducy
 * Date: 11/20/2025
 * Name: vehicle_detail.php
 * Description: displays the individual vehicle details when you click on a specific vehicle
 */

// Loads the view class that will display the product details
require_once "vehicle_view.class.php";

// Ensures a valid product ID was provided
if (!isset($_GET['id'])) {
    echo "Vehicle ID is required.";
    exit;
}

$id = intval($_GET['id']);

// THIS IS TEMPORARY CHANGE THIS WHEN THE MODEL CONTROLLER ARE DONE
$conn = new mysqli("localhost", "root", "", "rental_cars");
if ($conn->connect_error) die("Database connection failed");

// Prepared statement prevents invalid or unsafe input
$stmt = $conn->prepare("SELECT * FROM vehicles WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$vehicle = $result->fetch_assoc();

// Renders the full detail page using the view class
$view = new VehicleView();
$view->showVehicleDetail($vehicle);

$conn->close();

