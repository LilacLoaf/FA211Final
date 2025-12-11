<?php
/*
 * Author: Nicholas Weatherspoon
 * Date: 12/04/2025
 * Description: Handles AJAX requests for vehicle data (JSON responses).
 */

require_once __DIR__ . '/../models/VehicleModel.php';

class VehicleAjaxController {

    private VehicleModel $model;

    public function __construct() {
        $this->model = new VehicleModel();
    }

    // GET /vehicleajax/get/{id}
    public function get($id) {
        header('Content-Type: application/json');

        $vehicle = $this->model->getVehicleById($id);

        if ($vehicle) {
            echo json_encode([
                "success" => true,
                "vehicle" => $vehicle
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Vehicle not found."
            ]);
        }
        exit;
    }
}

