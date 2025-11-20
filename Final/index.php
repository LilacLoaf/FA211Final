<?php

//temporary require statements
require_once('C:\xampp\htdocs\I211\final\controller\controller.php');

//make the controller
$controller = new CarsController();

//get the method, if there is no method list everything -- probably make a homepage?
$action = $_GET['action'] ?? 'index';

//check if id is in the url - will have to change this once we have an actual login                 *
$id = $_GET['id'] ?? '';

//if the action exists, get it from the controller
if(method_exists($controller, $action)) {
    //if there is an id, use $id in the parameter. if not, don't.
    if($id){
        $controller->$action($id);
    }else{
        $controller->$action();
    }

} else {
    //if it doesn't, throw an error -- errors aren't setup yet
    $error = new UserError();
    $error->display("the requested action: '$action' does not exist");
}