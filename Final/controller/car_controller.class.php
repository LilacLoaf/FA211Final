<?php
/*
 * Author: Paxton Ducy
 * Date: 11/20/2025
 * Name: car_controller.class.php
 * Description: creates the classes for the vehicles
 */

class CarsController {
    private CarsModel $carsModel;

    public function __construct() {
        $this->carsModel = CarsModel::getModel();
    }

    public function index(): void {
        $list = $this->carsModel->getCars();
        $view = new Index();
        $view->display();
    }

    public function listCars() {
        $getCars = $this->carsModel->getCars();
        $view = new carIndex();
        $view->display($getCars);
    }

    public function listUsers() {
        $getUsers = $this->carsModel->getUsers();
        $view = new userIndex();
        $view->display($getUsers);
    }

    public function listJunction() {
        $getJunction = $this->carsModel->getJunction();
        $view = new junctionIndex();
        $view->display($getJunction);
    }

    public function listCarByID($id) {
        $car = $this->carsModel->getCarByID($id);
        $view = new carDetail();
        $view->display($car);
    }

    public function listJunctionByID($id) {
        $junction = $this->carsModel->getJunctionByID($id);
        $view = new junctionDetail();
        $view->display($junction);
    }

    public function listUserByID($id) {
        $user = $this->carsModel->getUserByID($id);
        $view = new userDetail();
        $view->display($user);
    }

    //searchCars for AJAX search
    public function searchCars($query, $mode = 'AND') {
        $results = $this->carsModel->searchCars($query, $mode);
        $view = new carSearchResults(); // this view should output a table or list
        $view->display($results);
    }
}
