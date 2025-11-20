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
                    <input type='password' name='password' minlength='5' required><br><br>

                    <label>First Name:</label><br>
                    <input type='text' name='firstname' required><br><br>

                    <label>Last Name:</label><br>
                    <input type='text' name='lastname' required><br><br>

                    <input type='submit' class='button' value='Register'>
                </form>
              </div>";
        $view::footer();
    }

    // Process registration form submission
    public function processRegister(): void
    {
        $userModel = UserModel::getInstance();

        // Build the fullname field from first + last
        $user_id = uniqid();
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';
        $firstname = $_POST['firstname'] ?? '';
        $lastname = $_POST['lastname'] ?? '';
        $fullname = trim("$firstname $lastname");

        if (empty($username) || empty($password) || empty($email) || empty($fullname)) {
            $error = new UserError();
            $error->display("Invalid registration data. Please fill all fields.");
            return;
        }

        // Model requires associative array
        $data = [
            'user_id' => $user_id,
            'username' => $username,
            'password' => $password, // model hashes it
            'fullname' => $fullname,
            'email'    => $email,
        ];

        $success = $userModel->add_user($data);

        $view = new View();
        $view::header();

        if ($success) {
            echo "<div class='middle-row'>
                    <p>Registration successful for <strong>$username</strong>!</p>
                    <p><a href='?action=login'>Click here to log in</a></p>
                  </div>";
        } else {
            echo "<div class='middle-row'>
                    <p>Registration failed. Please try again.</p>
                    <p><a href='?action=register'>Back to registration</a></p>
                  </div>";
        }

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
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $error = new UserError();
            $error->display("Please enter both username and password.");
            return;
        }

        $model = UserModel::getInstance();
        $success = $model->verify_user($username, $password);

        $view = new View();
        $view::header();

        if ($success) {
            echo "<div class='middle-row'>
                    <p>Welcome back, <strong>$username</strong>!</p>
                    <p>
                        <a href='?action=viewProfile'>View Profile</a> |
                        <a href='?action=reset'>Reset Password</a> |
                        <a href='?action=logout'>Logout</a>
                    </p>
                  </div>";
        } else {
            echo "<div class='middle-row'>
                    <p>Invalid username or password.</p>
                    <p><a href='?action=login'>Try Again</a></p>
                  </div>";
        }

        $view::footer();
    }

    // Password reset view
    public function reset(): void
    {
        $view = new View();
        $view::header();

        if (!isset($_COOKIE['username'])) {
            echo "<div class='middle-row'>
                    <p>You must be logged in to reset your password.</p>
                    <p><a href='?action=login'>Go to Login</a></p>
                  </div>";
        } else {
            $username = htmlspecialchars($_COOKIE['username']);
            echo "<div class='middle-row'>
                    <h3>Reset Password</h3>
                    <form method='post' action='?action=doReset'>
                        <label>Username:</label><br>
                        <input type='text' name='username' value='$username' readonly><br><br>

                        <label>New Password:</label><br>
                        <input type='password' minlength='5' name='password' required><br><br>

                        <input type='submit' class='button' value='Reset Password'>
                    </form>
                  </div>";
        }

        $view::footer();
    }

    // Process password reset
    public function doReset(): void
    {
        $model = UserModel::getInstance();

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $success = $model->reset_password($username, $password);

        $view = new View();
        $view::header();

        if ($success) {
            echo "<div class='middle-row'>
                    <p>Password reset successful.</p>
                    <p><a href='?action=logout'>Logout</a></p>
                  </div>";
        } else {
            echo "<div class='middle-row'>
                    <p>Password reset failed.</p>
                    <p><a href='?action=reset'>Try Again</a></p>
                  </div>";
        }

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
        $model = UserModel::getInstance();
        $model->logout();

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

    // Display a specific user detail
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


