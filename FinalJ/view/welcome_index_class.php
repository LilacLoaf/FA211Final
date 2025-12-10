<?php
/**
 * Author: Jonathan Nguyen
 * Date: 12/4/2025
 * File: welcome_index_class.php
 */

class WelcomeView
{
    public function display(): void
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Welcome to the Car Rental System</title>
        </head>
        <body>
        <h1>Welcome to the Car Rental System</h1>

        <a href="<?php echo BASE_URL; ?>/index.php/cars/listCars">View All Vehicles</a><br>


        </body>
        </html>
        <?php
    }
}
?>
