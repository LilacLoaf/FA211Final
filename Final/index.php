<?php

class CarsController{
    private CarsModel $carsModel;

    //access the model page
    public function __construct(){
        $this->carsModel = CarsModel::getModel();
    }

    //create a base screen to put the tables onto - copied from practice 12
    public function index(): void{
        $list = $this->carsModel->getCars();

        $view = new Index();
        $view->display();
    }

    //display the cars table
    public function getCars(){
        $listCars = $this->carsModel->getCars();

        $view = new carIndex();
        $view->display($listCars);
    }
    //get the users table
    public function getUsers(){
        $listUsers = $this->carsModel->getUsers();

        $view = new userIndex();
        $view->display($listUsers);
    }
    //get the junction table (the extra table)
    public function getJunction(){
        $listJunction = $this->carsModel->getJunction();

        $view = new junctionIndex();
        $view->display($listJunction);
    }


}