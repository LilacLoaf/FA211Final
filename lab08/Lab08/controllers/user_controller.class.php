<?php
/*
 * Author: Nicholas Weatherspoon
 * Date: 11/12/25
 * Name: user_controller.class.php
 * Description: The UserController class handles all user-related actions
 *              such as displaying the home page, registration, login,
 *              logout, listing users, showing details, updating, and deleting.
 */

class UserController
{
    // Show home page
    public function index(): void
    {
        $view = new View();
        $view::header();
        echo "<div class='top-row'>Welcome</div>
              <div class='middle-row'>
                <p>Welcome to the PeaPOD User Management System!</p>
                <p>Please <a href='?action=register'>register</a> or <a href='?action=login'>login</a> to continue.</p>
              </div>";
        $view::footer();
    }

    // Show registration form
    public function register(): void
    {
        $view = new View();
        $view::header();
        echo "<div class='top-row'>Register</div>
              <div class='middle-row'>
                <form method='post' action='?action=processRegister'>
                    <label>Username:</label><br>
                    <input type='text' name='username' required><br><br>
                    <label>Email:</label><br>
                    <input type='email' name='email' required><br><br>
                    <label>Password:</label><br>
                    <input type='password' name='password' required><br><br>
                    <input type='submit' class='button' value='Register'>
                </form>
              </div>";
        $view::footer();
    }

    // Process registration form submission
    public function processRegister(): void
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (empty($username) || empty($email) || empty($password)) {
            $error = new UserError();
            $error->display("Invalid registration data. Please fill all fields.");
            return;
        }

        // Still Have To: Add database insert logic here using the Database class
        $view = new View();
        $view::header();
        echo "<div class='middle-row'>
                <p>Registration successful for <strong>$username</strong>!</p>
                <p><a href='?action=login'>Click here to log in</a></p>
              </div>";
        $view::footer();
    }

    // Display login form
    public function login(): void
    {
        $view = new View();
        $view::header();
        echo "<div class='top-row'>Login</div>
              <div class='middle-row'>
                <form method='post' action='?action=processLogin'>
                    <label>Username:</label><br>
                    <input type='text' name='username' required><br><br>
                    <label>Password:</label><br>
                    <input type='password' name='password' required><br><br>
                    <input type='submit' class='button' value='Login'>
                </form>
              </div>";
        $view::footer();
    }

    // Process login form submission
    public function processLogin(): void
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $error = new UserError();
            $error->display("Please enter both username and password.");
            return;
        }

        // TODO: Validate user credentials from database
        $view = new View();
        $view::header();
        echo "<div class='middle-row'>
                <p>Welcome back, <strong>$username</strong>!</p>
                <p><a href='?action=viewProfile'>View Profile</a> | <a href='?action=logout'>Logout</a></p>
              </div>";
        $view::footer();
    }

    // Display user profile
    public function viewProfile(): void
    {
        $view = new View();
        $view::header();
        echo "<div class='top-row'>User Profile</div>
              <div class='middle-row'>
                <p>Here is your profile information (placeholder).</p>
              </div>";
        $view::footer();
    }

    // Handle user logout
    public function logout(): void
    {
        session_start();
        session_destroy();

        $view = new View();
        $view::header();
        echo "<div class='middle-row'>
                <p>You have been logged out successfully.</p>
                <p><a href='?action=login'>Log in again</a></p>
              </div>";
        $view::footer();
    }

    // Display list of all users
    public function listUsers(): void
    {
        $view = new View();
        $view::header();
        echo "<div class='top-row'>All Users</div>
              <div class='middle-row'>
                <p>This page will display a list of all registered users (placeholder).</p>
              </div>";
        $view::footer();
    }

    // Display a specific user detail (example extra action)
    public function showUserDetail(): void
    {
        $view = new View();
        $view::header();
        echo "<div class='top-row'>User Details</div>
              <div class='middle-row'>
                <p>Display details for a selected user (placeholder).</p>
              </div>";
        $view::footer();
    }
}
?>

