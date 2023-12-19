<?php

use BesoccerOdds\Controllers\DashboardController;
use BeSoccerSDK\Classes\Show;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('routes.php');
include_once('constants.php');

header('content-type:text/html;charset=utf-8');

foreach($routes as $route => $routerConfig){
    
    $splitUri = explode('?',$_SERVER['REQUEST_URI']);
    
    //Include variable numerica en la url :num
    $explodedUri = explode("/",$_SERVER['REQUEST_URI']);    

    //Se utiliza para aceptar cualquier numero en la url
    if(strpos($route, ":num") != false) {
        $lastKey  = array_search(':num',explode("/",$route));
        if ( isset($explodedUri[$lastKey])) {
            $route = str_replace(":num",$explodedUri[$lastKey],$route);
        }
        
    }
    
    if($route == $_SERVER['REQUEST_URI'] || (isset($_SERVER['PATH_INFO']) AND $route == $_SERVER['PATH_INFO']) || $route == $splitUri[0] ){

        //Include Client Library for SDK            
        require_once '../vendor/autoload.php';
        //Comprobacion de logueo en caso de existir la cokie de logueo no activamos el outh o si es una ruta de parse        
        if (strpos($_SERVER['REQUEST_URI'], 'source/') === FALSE && strpos($_SERVER['REQUEST_URI'], 'cron/') === FALSE) {
            if (!isset($_COOKIE['oauthScrap'])) {                
                include_once('login.php');
                //include_once('outh.php');                
                die();
            }    
        }
        if (isset($_COOKIE['oauthScrap']) && json_decode($_COOKIE['oauthScrap'])->sub_roles >= $routerConfig['subRole'] || strpos($_SERVER['REQUEST_URI'], 'source/') != FALSE || strpos($_SERVER['REQUEST_URI'], 'cron/') != FALSE ) {
            $currentController = new $routerConfig['controller']($routerConfig['function']);
        }else {
            $currentController = new DashboardController('noacces');
        }   
    }
} 

if (!isset($currentController) && !isset($_COOKIE['oauthScrap'])) {
    header('Location: /');
}

if (!isset($currentController) && isset($_COOKIE['oauthScrap'])) {
    include_once('nonfound.php');
    die;
}

/**
 * Función que carga una clase antes de contruirla
 */
spl_autoload_register(function ($className) {
    require_once (str_replace('\\', '/', $className) . '.php');
});
  




?>