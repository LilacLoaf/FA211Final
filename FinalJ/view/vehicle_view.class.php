<?php
/*
 * Author: Paxton Ducy
 * Date: 11/20/2025
 * Name: vehicle_view.class.php
 * Description:
 */

class VehicleView
{
    public function showSearchBar(): void
    {
        echo '<form method="get" action="' . BASE_URL . '/index.php/cars/searchCars" style="margin-bottom:20px;">';
        echo '<input type="text" name="query" placeholder="Search vehicles..." required>';
        echo '<button type="submit">Search</button>';
        echo '</form>';
    }


    public function addVehicle(): void
    {
        echo '<p><a href="' . BASE_URL . '/index.php/cars/addVehicleForm">Add Vehicle</a></p>';
    }


    // Displays all vehicles passed from the controller/model
    public function showAllVehicles($vehicles)
    {    echo '<div>';
        $this->showSearchBar();
        $this->addVehicle();
        echo '</div>';
        // Table layout helps users quickly browse all products
        echo "<h2>All Vehicles</h2><table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Brand</th><th>Model</th><th>License Plate</th><th>Status</th><th>Action</th></tr>";

        // Loop shows each product on its own row to keep UI simple
        foreach ($vehicles as $v) {
            echo "<tr>
                <td>{$v['id']}</td>
                
                <td>{$v['brand']}</td>
                <td>{$v['model']}</td>
                <td>{$v['licensePlate']}</td>
                <td>{$v['status']}</td>
                <td><a href='" . BASE_URL . "/index.php/cars/listCarByID/{$v['id']}'>View</a></td>
                <!-- Link allows user to view details of this vehicle -->
            </tr>";
        }

        echo "</table>";
    }

    // Displays detailed information for one specific product
    public function showVehicleDetail($vehicle)
    {

        // Prevents errors when invalid or missing product ID is given
        if (!$vehicle) {
            echo "<p>Vehicle not found.</p>";
            return;
        }

        // Simple list layout to make details easy to read
        echo "<h2>Vehicle Detail</h2><ul>";
        echo "<li><strong>ID:</strong> {$vehicle['id']}</li>";
        echo "<li><strong>Brand:</strong> {$vehicle['brand']}</li>";
        echo "<li><strong>Model:</strong> {$vehicle['model']}</li>";
        echo "<li><strong>License Plate:</strong> {$vehicle['licensePlate']}</li>";
        echo "<li><strong>Status:</strong> {$vehicle['status']}</li>";
        echo "</ul>";

        // Navigation link helps users return to the full list
        echo "<a href='" . BASE_URL . "/index.php/cars/listCars'>Back to list</a>";
    }


}


