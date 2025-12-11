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
}
