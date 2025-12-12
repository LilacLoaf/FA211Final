<?php
class loginView
{
    public function display(): void
    {
        try {
            var_dump($_SESSION);
            echo '<h2>Sign into your account!</h2>';

            echo '<form method="post" action="' . BASE_URL . '/index.php/users/login">';
            echo '<label>Username: <input type="text" name="username" required></label><br><br>';
            echo '<label>Password: <input type="password" name="password" required></label><br><br>';
            echo '<button type="submit">Login</button>';
            echo '</form>';

            echo '<br><a href="' . BASE_URL . '/index.php">Home</a>';
            // echo '<br><a href="' . BASE_URL . '/index.php/users/register">Need to create a new account?</a>';
        } catch (Exception $e) {
            echo "<p><strong>Error logging in</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}
