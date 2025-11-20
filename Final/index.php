<?php

//temporary require statements
require_once('C:\xampp\htdocs\I211\final\controller\controller.php');

//make the controller
$controller = new CarsController();

//get the method, if there is no method list everything -- probably make a homepage later?
$action = $_GET['action'] ?? 'index';

//if the action exists, get it from the controller
if(method_exists($controller, $action)) {
    $controller->$action();
} else {
    //if it doesn't, throw an error -- errors aren't setup yet
    $error = new UserError();
    $error->display("the requested action: '$action' does not exist");
}