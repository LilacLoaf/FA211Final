<?php

class CarsController{
    private CarsModel $carsModel;

    //access the model page
    public function __construct(){
        $this->carsModel = CarsModel::getModel();
    }

    //create a base screen to put the tables onto - copied from practice 12         *
    public function index(): void{
        $list = $this->carsModel->getCars();

        $view = new Index();
        $view->display();
    }

    //display the cars table
    public function listCars(){
        $getCars = $this->carsModel->getCars();

        $view = new carIndex();
        $view->display($getCars);
    }
    //get the users table
    public function listUsers(){
        $getUsers = $this->carsModel->getUsers();

        $view = new userIndex();
        $view->display($getUsers);
    }
    //get the junction table (the extra table)
    public function listJunction(){
        $getJunction = $this->carsModel->getJunction();

        $view = new junctionIndex();
        $view->display($getJunction);
    }

    //get the car details using its id and send the page into a acr detail page
    public function listCarByID($id){
        $car = $this->carsModel->getCarByID($id);

        $view = new carDetail();
        $view->display($car);

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
}