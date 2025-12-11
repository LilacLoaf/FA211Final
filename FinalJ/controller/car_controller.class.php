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

    //get the car details using its id and send the page into a acr detail page
    public function listCarByID($id){
        $vehicle = $this->carsModel->getCarByID($id);

        $view = new VehicleView();
        $view->showVehicleDetail($vehicle);

    }

    public function searchCars()
    {
        $query = $_GET['query'] ?? '';
        $results = $this->carsModel->searchCars($query);

        $view = new carSearchResults();
        $view->display($results);
    }

    public function addCar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $brand = $_POST['brand'] ?? '';
            $model = $_POST['model'] ?? '';
            $licensePlate = $_POST['licensePlate'] ?? '';
            $status = $_POST['status'] ?? 'Available';

            if ($brand && $model && $licensePlate) {
                $this->carsModel->insertCar($brand, $model, $licensePlate, $status);

                header('Location: ' . BASE_URL . '/index.php/cars/listCars');
                exit();
            } else {
                $error = "Please fill in all required fields.";
            }
        }

        $view = new addVehicle();
        $view->display($error ?? null);
    }

    public function addVehicleForm(): void
    {
        $view = new addVehicle();
        $view->display();
    }
}