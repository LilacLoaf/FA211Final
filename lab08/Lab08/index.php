<?php

/*
 * Author: your name
 * Date: today's date
 * Name: index.php
 * Description: short description about this file
 */

//include code in vendor/autoload.php file
require_once ("vendor/autoload.php");

//create an object of UserController
$user_controller = new UserController();

//add your code below this line to complete this file

$action = $_GET['action'] ?? 'index';
require_once 'user_controller.class.php';
$controller = new UserController();

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    $controller->error();
}
