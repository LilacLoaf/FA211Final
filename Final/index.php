<?php
/*
 * Author: Paxton Ducy
 * Date: 11/20/2025
 * Name: index.php
 * Description:
 */

//temporary require statements
//require_once('C:\xampp\htdocs\I211\final\controller\controller.php');
require_once __DIR__ . '/controller/car_controller.class.php';


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

}

try {
    switch ($action) {
        case 'index':
            $controller->index();
            break;

        case 'list':
            $controller->listCars();
            break;

        case 'view_detail':
            $id = $_GET['id'] ?? null;
            if ($id !== null) {
                $controller->listCarByID($id);
            } else {
                throw new Exception("Missing vehicle ID for detail view.");
            }
            break;

        case 'search':
            $query = $_GET['query'] ?? '';
            $controller->searchCars($query);
            break;

        case 'listUsers':
            $controller->listUsers();
            break;

        case 'listJunction':
            $controller->listJunction();
            break;

        case 'view_user':
            $id = $_GET['id'] ?? null;
            if ($id !== null) {
                $controller->listUserByID($id);
            } else {
                throw new Exception("Missing user ID for detail view.");
            }
            break;

        default:
            throw new Exception("The requested action '$action' does not exist.");
    }

} catch (Exception $e) {
    // Simple error message for now
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
}