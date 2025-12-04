<?php

class CarsController{
    private CarsModel $carsModel;

    //access the model page
    public function __construct(){
        $this->carsModel = CarsModel::getModel();
    }

    //create a base screen to put the tables onto - copied from practice 12         *
    public function index(): void{
        $this->listCars();

    }

    //display the cars table
    public function listCars(){
        $vehicles = $this->carsModel->getCars();

        $view = new VehicleView();
        $view->showAllVehicles($vehicles);
    }
    //get the users table
    public function listUsers()
    {
        $getUsers = $this->carsModel->getUsers();

        $view = new userIndex();
        $view->display($getUsers);
    }
    //get the junction table (the extra table)
//    public function listJunction(){
//        $getJunction = $this->carsModel->getJunction();
//
//        $view = new junctionIndex();
//        $view->display($getJunction);
//    }

    //get the car details using its id and send the page into a acr detail page
    public function listCarByID($id){
        $vehicle = $this->carsModel->getCarByID($id);

        $view = new VehicleView();
        $view->showVehicleDetail($vehicle);

    }

    //get the junction table's details.
    public function listJunctionByID($id){
        $junction = $this->carsModel->getJunctionByID($id);

        $view = new junctionDetail();
        $view->display($junction);
    }

    //get the user table's details
    public function listUserByID($id){
        $user = $this->carsModel->getUserByID($id);

        $view = new userDetail();
        $view->display($user);
    }

    public function searchCars()
    {
        $query = $_GET['query'] ?? '';

        $results = $this->carsModel->searchCars($query);

        $view = new carSearchResults();

        $view->display($results);
    }

}