<?php 

/**
 * Helper con funciones para el tratamiento de la barra izquierda del menú
 * @author Yisus Gómez
 */

namespace BesoccerOdds\Helpers;

use BesoccerOdds\Classes\Helper;

class LeftSidebarHelper extends Helper{

    /**
     * Devuelve la configuración de la barra lateral izquierda del menú
     * @return array
     */
    public static function getSidebar():array
    {

        $sideBar = array(
            // estos iconos van con Icomoon y no con Fontawesome
            0 => array('icon' => 'fa fa-wrench', 'name' => 'Data Info', 'url' => '/data_info', 'subsections' => Self::getDataInfoSubsection()),                   
            1 => array('icon' => 'fa-solid fa-hard-drive', 'name' => 'Football Data', 'url' => '/football_data', 'subsections' => Self::getFootballDataSubsection()),                   
            2 => array('icon' => 'fa-solid fa-hard-drive', 'name' => 'Goalserve', 'url' => '/goalserve', 'subsections' => Self::getGoalserveSubsection()),                   
            3 => array('icon' => 'fa-solid fa-hard-drive', 'name' => 'Enetpulse', 'url' => '/enetpulse', 'subsections' => Self::getEnetpulseSubsection())                 
        );

        return $sideBar;

    }

    /**
     * Devuelve la configuración del submenu de "Data Info"
     * @author Elías Moreno
     * @return array
     */
    public static function getDataInfoSubsection():array
    {
        return [                    
            '1' => array('icon' => 'fa-solid fa-shield', 'name' => 'Teams', 'url' => '/teams'),
            '2' => array('icon' => 'fa fa-trophy', 'name' => 'Leagues', 'url' => '/leagues'),
            '3' => array('icon' => 'fa-regular fa-futbol', 'name' => 'Matches', 'url' => '/matches'),
            '4' => array('icon' => 'fa-solid fa-dice', 'name' => 'Providers', 'url' => '/providers')
        ];
    } 
    
    /**
     * Devuelve la configuración del submenu de "Football Data"
     * @author Elías Moreno
     * @return array
     */
    public static function getFootballDataSubsection():array
    {
        return [                    
            '1' => array('icon' => 'fa-solid fa-shield', 'name' => 'Teams', 'url' => '/teams'),
            '2' => array('icon' => 'fa fa-trophy', 'name' => 'Leagues', 'url' => '/leagues')
        ];
    } 
    
    /**
     * Devuelve la configuración del submenu de "Goalserve"
     * @author Elías Moreno
     * @return array
     */
    public static function getGoalserveSubsection():array
    {
        return [                    
            '1' => array('icon' => 'fa-solid fa-circle-info', 'name' => 'Info', 'url' => '/info'),
            '2' => array('icon' => 'fa fa-bug', 'name' => 'Errors', 'url' => '/errors'),
        ];
    
    }

    /**
     * Devuelve la configuración del submenu de "Enetpulse"
     * @author Elías Moreno
     * @return array
     */
    public static function getEnetpulseSubsection():array
    {
        return [                    
            '1' => array('icon' => 'fa-solid fa-circle-info', 'name' => 'Info', 'url' => '/info'),
        ];
    }    

}


?>