<?php

    use BesoccerOdds\Controllers\DashboardController;
    use BesoccerOdds\Controllers\TestController;    

    $availableRoutes = [
        'ToolsRoutes',        
    ];

    // Ruta principal cuando acceder a la web
    $routes = [
        '/' => array(
            'controller' => DashboardController::class,
            'function' => 'renderHtml',
            'subRole' => 0,
        ),

        '/logout' => array(
            'controller' => DashboardController::class,
            'function' => 'logout',
            'subRole' => 0,
        ),

        '/noacces' => array(
            'controller' => DashboardController::class,
            'function' => 'noacces',
            'subRole' => 0,
        ),  
        
        '/test' => array(
            'controller' => TestController::class,
            'function' => 'test',
            'subRole' => 0,
        ),  
    ];

    foreach ($availableRoutes as $route) {
       
        $auxRoutes = [];

        include('../config/routes/'.$route.'.php');

        if(!empty($routesExtra)){

            $auxRoutes = $routesExtra;

        }

        $routes = array_merge($routes, $auxRoutes);

    }

?>