<?php
/**
 * Author: Jonathan Nguyen
 * Date: 12/4/2025
 * File: addCarForm.php
 * Description:
 */

class addVehicle{

    public function display(): void
    {

        echo '<h2>Add New Vehicle</h2>';
        echo '<form method="post" action="' . BASE_URL . '/index.php/cars/addCar">';
        echo '<label>Brand: <input type="text" name="brand" required></label><br><br>';
        echo '<label>Model: <input type="text" name="model" required></label><br><br>';
        echo '<label>License Plate: <input type="text" name="licensePlate" required></label><br><br>';
        echo '<label>Status: <select name="status">
                <option value="Available">Available</option>
                <option value="Rented">Rented</option>
              </select></label><br><br>';
        echo '<button type="submit">Add Vehicle</button>';
        echo '</form>';
    }
}
