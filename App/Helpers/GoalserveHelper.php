<?php

/**
 * Helper para funciones relacionadas con la fuente Goalserve
 * @author Elías Moreno
 */

namespace BesoccerOdds\Helpers;

use BesoccerOdds\Classes\Helper;


class GoalserveHelper extends Helper
{
    /**
     * Conversión error code en su explicación
     * @param string $countryCode
     * @return string
     */
    public static function errorCodeConvert($error): string
    {

        $errorCode = [
            "1" => "Hay equipos sin relacionar",
            "2" => "Fallo de la API externa, JSON vacío.",
            "3" => "No se han encontrado leagues IDs",
            "4" => "curl devuelve contenido vacío, sin JSON",
            "5" => "Hay partidos sin relacionar",
            "7" => "Log de todos los json que se reciben"
           
        ];

            return $errorCode[$error];
        }

   
}
