<?php
/*
 * Author: Paxton Ducy
 * Date: 11/20/2025
 * Name: vehicle_view.class.php
 * Description: displays all of the cars that are available to rent/in the database
 */


// Loads the class that handles displaying products
require_once "vehicle_view.class.php";

// Temporary database connection until controller/model are integrated
$conn = new mysqli("localhost", "root", "", "rental_cars");
if ($conn->connect_error) die("Database connection failed");

// Fetches all vehicles to display in the list
$result = $conn->query("SELECT * FROM vehicles");
$vehicles = $result->fetch_all(MYSQLI_ASSOC);

// Uses the view class to render the product list on the page
$view = new VehicleView();
$view->showAllVehicles($vehicles);

$conn->close();

