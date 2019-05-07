<?php
include __DIR__ .'/../vendor/autoload.php';

try {
    $app = new \App\App();
    // @todo route
    $controller = new \App\controllers\MainController($app);

    if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
        $method = 'action' . ucfirst(strtolower($_REQUEST['action']));

        if (method_exists($controller, $method)) {
            $controller->{$method}();
        } else {
            http_response_code(404);
        }
    } else {
        $controller->actionIndex();
    }
} catch (\Throwable $e) {
    // @todo log
    
    echo 'Sorry, an error occurred!';
}