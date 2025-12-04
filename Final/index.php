<?php
//temporary require statements
//require_once('C:\xampp\htdocs\I211\final\controller\controller.php');
require_once 'controller/car_controller.class.php';

$controller = new CarsController();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'list':
        $controller->listCars();
        break;

    case 'search':
        $query = $_GET['query'] ?? '';
        $mode = $_GET['mode'] ?? 'AND';
        $controller->searchCars($query, $mode);
        break;

    case 'view_detail':
        $id = $_GET['id'] ?? null;
        if ($id !== null) {
            $controller->listCarByID($id);
        } else {
            echo "Missing ID for detail view.";
        }
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
        }
        break;

    default:
        $controller->index();
        break;
}
