<?php
/**
 * Author: Jonathan Nguyen
 * Date: 12/4/2025
 * File: dispatcher.php
 * Description:
 */
class Dispatcher
{
    public function __construct()
    {
        try {
            self::dispatch();
        } catch (Exception $e) {
            // Basic error message output
            echo "<p style='color:red'><strong>Dispatcher Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    //dispatch request to the appropriate controller/method
    public static function dispatch(): void
    {
        $uri_array = explode('?', trim($_SERVER['REQUEST_URI'], '/'));
        $url_array = explode('/', $uri_array[0]);

        while (in_array(basename(getcwd()), $url_array)) {
            array_shift($url_array);
        }

        if (count($url_array) > 0 && ($url_array[0] == "index.php" or $url_array[0] == "index")) {
            array_shift($url_array);
        }

        $controllerName = !empty($url_array[0]) ? ucfirst($url_array[0]) . 'Controller' : 'WelcomeController';

        if (!class_exists($controllerName)) {
            $message = "Controller '$controllerName' does not exist.";
            include 'error.php';
            exit();
        }

        $controller = new $controllerName();

        $method = !empty($url_array[1]) ? $url_array[1] : 'index';

        if (strpos($method, '.')) {
            $method = substr($method, 0, strpos($method, '.'));
        }

        $args = array();
        if (count($url_array) > 2) {
            $args = array_slice($url_array, 2);
        }

        call_user_func_array(array($controller, $method), $args);
    }
}
