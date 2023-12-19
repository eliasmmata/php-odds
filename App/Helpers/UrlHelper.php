<?php

/**
 * Helper con función que ayudan a gestionar los parámetros de la petición actual
 * @author Yisus Gómez
 */

namespace BesoccerOdds\Helpers;

use BesoccerOdds\Classes\Helper;

class UrlHelper extends Helper{

    /**
     * Función que extrae todos los parámetros del POST
     * @author Yisus Gómez
     * @param array $keyPost (Claves que devolver)
     * @return array
     */
    static public function getPostParams():array
    {
        $postArray = [];

        foreach ($_POST as $key => $value) {
            if(!empty($value)){
                $postArray[$key] = $value;
            }
        }

        return $postArray;
    }

    /**
     * Función que extrae todos los parámetros del GET
     * @author Yisus Gómez
     * @return array
     */
    static public function getGetParams():array
    {
        $getArray = [];

        foreach ($_GET as $key => $value) {
            if(!empty($value)){
                $getArray[$key] = $value;
            }
        }

        return $getArray;
    }
    /**
     * Función que extrae todos los parámetros del SERVER
     * @author Yisus Gómez
     * @return array
     */
    static public function getUrlParams(){

        $urlArray = [];

        foreach ($_SERVER as $key => $value) {
            if(!empty($value)){
                $urlArray[$key] = $value;
            }
        }

        if(!empty($urlArray['REQUEST_URI'])){
            $urlArray['SLICED_REQUEST_URI'] = explode('/', $urlArray['REQUEST_URI']);
        }

        return $urlArray;
    }

}