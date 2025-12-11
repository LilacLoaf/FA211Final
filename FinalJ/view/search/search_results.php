<?php
/**
 * Author: Paxton
 * Date: 12/4/2025
 * File: car_search_results.class.php
 * Description: Displays search results for vehicles
 */

class carSearchResults
{
    // Accepts an array of vehicles and outputs the table
    public function display(array $vehicles): void
    {
        if (empty($vehicles)) {
            echo "<p>No results found.</p>";
            return;
        }

        echo "<h3>Search Results:</h3>";
        echo "<table border='1' cellpadding='8'>";
        echo "<tr>
                <th>Brand</th>
                <th>Model</th>
                <th>License Plate</th>
                <th>Status</th>
                <th>View</th>
              </tr>";

        foreach ($vehicles as $vehicle) {
            echo "<tr>
                    <td><a href='" . BASE_URL . "/index.php/cars/listCarByID/{$vehicle['id']}'>
                        {$vehicle['brand']}
                    </a></td>
                    <td>{$vehicle['model']}</td>
                    <td>{$vehicle['licensePlate']}</td>
                    <td>{$vehicle['status']}</td>
                    <td>
                        <a href='" . BASE_URL . "/index.php/cars/listCarByID/{$vehicle['id']}'>View</a>
                    </td>
                  </tr>";
        }

        echo "</table>";
    }
}
?>

