<?php
/*
 * Author: Paxton Ducy
 * Date: 11/20/2025
 * Name: all_vehicles.php
 * Description: Displays all vehicles and handles search UI (AJAX)
 */

require_once "vehicle_view.class.php";

// Connect to database
$conn = new mysqli("localhost", "root", "", "rental_cars");
if ($conn->connect_error) die("Database connection failed");

// Fetch all vehicles
$result = $conn->query("SELECT * FROM vehicles");
$vehicles = $result->fetch_all(MYSQLI_ASSOC);

// Render vehicles with view class
$view = new VehicleView();
$view->showAllVehicles($vehicles);

$conn->close();
?>

<!-- Add search UI and results container -->
<form id="search-form">
    <input type="text" id="search-query" name="query" placeholder="Search vehicles..." required>
    <label>
        <input type="radio" name="mode" value="AND" checked> AND
    </label>
    <label>
        <input type="radio" name="mode" value="OR"> OR
    </label>
    <button type="submit">Search</button>
</form>

<div id="search-results"></div>

<script>
    document.getElementById('search-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const query = document.getElementById('search-query').value;
        const mode = document.querySelector('input[name="mode"]:checked').value;

        fetch(`../index.php?action=search&query=${encodeURIComponent(query)}&mode=${mode}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('search-results').innerHTML = html;
            });
    });
</script>


