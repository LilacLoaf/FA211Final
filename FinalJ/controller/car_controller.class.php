<?php

class CarsController {
    private CarsModel $carsModel;

    public function __construct() {
        $this->carsModel = CarsModel::getModel();
    }

    public function index(): void {
        $this->listCars();
    }

    public function listCars() {
        try {
            $vehicles = $this->carsModel->getCars();
            $view = new VehicleView();
            $view->showAllVehicles($vehicles);
        } catch (Exception $e) {
            echo "<p><strong>Error loading cars:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    public function listCarByID($id) {
        try {
            $vehicle = $this->carsModel->getCarByID($id);
            $view = new VehicleView();
            $view->showVehicleDetail($vehicle);
        } catch (Exception $e) {
            echo "<p><strong>Error loading vehicle detail:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    public function searchCars() {
        try {
            $query = $_GET['query'] ?? '';
            $results = $this->carsModel->searchCars($query);
            $view = new carSearchResults();
            $view->display($results);
        } catch (Exception $e) {
            echo "<p><strong>Error during search:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    public function addCar(): void {
        try {
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
        } catch (Exception $e) {
            echo "<p><strong>Error adding vehicle:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    public function addVehicleForm(): void {
        try {
            $view = new addVehicle();
            $view->display();
        } catch (Exception $e) {
            echo "<p><strong>Error displaying add form:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}
