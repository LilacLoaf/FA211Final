<?php
/*
 * Author: Paxton Ducy
 * Date: 2025-11-13
 * Name: index.php
 * Description: The front controller for the PeaPOD User Management System.
 *              Routes requests based on the 'action' query string variable.
 */

// Composer autoloader (for any packages)
require_once __DIR__ . '/vendor/autoload.php';

// Manually include system classes
require_once __DIR__ . '/controllers/user_controller.class.php';
require_once __DIR__ . '/application/database.class.php';
require_once __DIR__ . '/models/user_model.class.php';
require_once __DIR__ . '/views/view.class.php';
require_once __DIR__ . '/views/error/user_error.class.php';

// Grab the 'action' parameter, default to 'index'
$action = $_GET['action'] ?? 'register';

// Create the controller
$controller = new UserController();

// Dispatch to appropriate method
if (method_exists($controller, $action)) {
    $controller->$action();  // e.g., $controller->login();
} else {
    $error = new UserError();
    $error->display("The requested action '$action' is not valid.");
}
?>

