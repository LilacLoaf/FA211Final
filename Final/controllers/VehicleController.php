<?php
/*
 * Author: Jonathan Nguyen
 * Date: 11/19/2025
 * Description: Controller for Vehicle-related actions
 */

//Require the vehicle model to be used in this file
require_once __DIR__ . '/../models/VehicleModel.php';

//Require the vehicle view class to be used in this file
require_once __DIR__ . '/../view/vehicle_view.class.php';

//Creating the new Vehicle Controller
class VehicleController
{

    //Initializing the following variables.
    private VehicleModel $model;
    private VehicleView $view;

    //Constructing the recently created variables.
    public function __construct()
    {
        $this->model = new VehicleModel();
        $this->view = new VehicleView();
    }

    // Show all vehicles
    public function index()
    {
        $vehicles = $this->model->getAllVehicles();
        $this->view->showAllVehicles($vehicles);
    }

    // Show single vehicle by ID
    public function show($id)
    {
        $vehicle = $this->model->getVehicleById($id);
        $this->view->showVehicleDetail($vehicle);
    }

    //add vehicle function
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collect data from POST request
            $make = $_POST['make'] ?? '';
            $model = $_POST['model'] ?? '';
            $year = $_POST['year'] ?? '';
            $color = $_POST['color'] ?? '';

            // Optional: basic validation
            if (empty($make) || empty($model) || empty($year)) {
                $this->view->showCreateForm("Please fill in all required fields.");
                return;
            }

            // Create new vehicle using model
            $vehicleData = [
                'make' => $make,
                'model' => $model,
                'year' => $year,
                'color' => $color
            ];

            $this->model->addVehicle($vehicleData);

            // Redirect to vehicle list after creation
            header("Location: /vehicles");
            exit;
        } else {
            // Show the create form
            $this->view->showCreateForm();
        }


    }
}
