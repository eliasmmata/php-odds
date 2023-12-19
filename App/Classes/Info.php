<?php

namespace BesoccerOdds\Classes;

use BeSoccerSDK\Classes\Show;

class Info {  
    
    /**
     * Información general de la herramienta
     */
    private $general;

    /**
     * Información acerca de las acciones o visuales
     */
    private $data = [
        'info' => [],
        'action' => []
    ];    

    function __constructor(){        
                               
    }
    
    /**
     * Devueve la información de la herramienta en cuestión
     * @return array
     */
    public function getInfo() : array 
    {          
        return array_merge($this->general, $this->data);
    }
    
    /**
     * Guarda la información de la herramienta
     * @param array $general
     * @param array $data
     */
    public function setInfo($general,$data) : void
    {        
        $this->general = $general;
        $this->data = $data;        
    }
}