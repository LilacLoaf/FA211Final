<?php
/**
 * Author: Jonathan Nguyen
 * Date: 12/4/2025
 * File: add_vehicle_form.php
 * Description:
 */

// vehicle_view.class.php
class VehicleView {

    // Show all vehicles
    public function showAllVehicles($vehicles) {
        // your existing code
    }

    // Show single vehicle details
    public function showVehicleDetail($vehicle) {
        // your existing code
    }

    // Show create vehicle form
    public function showCreateForm($errorMessage = '') {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Add New Car</title>
        </head>
        <body>
            <h2>Add New Vehicle</h2>

            <?php if (!empty($errorMessage)) : ?>
                <div class="error"><?= htmlspecialchars($errorMessage) ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <label for="make">Make *</label>
                <input type="text" name="make" id="make" required>

                <label for="model">Model *</label>
                <input type="text" name="model" id="model" required>

                <label for="year">Year *</label>
                <input type="number" name="year" id="year" required min="1900" max="<?= date('Y') ?>">

                <label for="color">Color</label>
                <input type="text" name="color" id="color">

                <input type="submit" value="Add Vehicle">
            </form>
        </body>
        </html>
        <?php
    }
}
?>
