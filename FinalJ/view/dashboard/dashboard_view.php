<?php
class dashboardView {

    public function display(array $user): void
    {
        echo '<h2>Welcome to your account!</h2>';

        echo '<h4>Your account information:</h4>';
        echo '<br>Name:</> ' . ($user['name']);
        echo '<br>Email:</> ' . ($user['email']);
        echo '<br>Phone:</> ' . ($user['phone']);
        echo '<br>Address:</> ' . ($user['address']);
        echo '<br>Username:</> ' . ($user['username']);
        echo '<br>Password:</> ' . ($user['password']);

        echo '<p><a href="' . BASE_URL . '/index.php/cars/listCars">View our list of cars!</a></p>';
        echo '<p><a href="' . BASE_URL . '/index.php">Home</a></p>';
        echo '<p><a href="' . BASE_URL . '/index.php/users/logout">Logout</a></p>';

        //could add edit and add features if we need to
    }
}

