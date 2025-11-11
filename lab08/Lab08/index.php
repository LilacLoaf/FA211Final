<?php
/*
 * Author: Nicholas Weatherspoon
 * Date: 11/12/25
 * Name: index.php
 * Description: Entry point for the PeaPOD User Management System.
 *              This file dispatches requests based on the 'action' query parameter.
 */


//include code in vendor/autoload.php file
require_once ("vendor/autoload.php");

//create an object of UserController
$user_controller = new UserController();

//add your code below this line to complete this file

// Retrieve and sanitize the 'action' parameter from the query string
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

// Dispatch based on the action value using a switch case loop
switch ($action) {
    case 'register':
        // Handle user registration
        $user_controller->register();
        break;

    case 'login':
        // Handle user login
        $user_controller->login();
        break;

    case 'logout':
        // Handle user logout
        $user_controller->logout();
        break;

    case 'viewProfile':
        // Display user profile
        $user_controller->viewProfile();
        break;

    default:
        // Default action: show homepage
        $user_controller->index();
        break;
}

