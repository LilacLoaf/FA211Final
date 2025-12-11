<?php

/*require_once ("config/dispatcher.php");
require_once ("config/config.php");

require_once ("vendor/autoload.php");

new Dispatcher();
*/


try {

    require_once("config/dispatcher.php");
    require_once("config/config.php");
    require_once("vendor/autoload.php");

    // Start the dispatcher (routes the request)
    new Dispatcher();

} catch (Exception $e) {   // Error caught and displayed
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
}
