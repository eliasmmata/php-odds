<?php 
/**
 * Clase para controlar los tiempos
 * @author Pablo Muñoz
 */

namespace BesoccerOdds\Classes;

class Timer{

    private $start;

    private $pauseTime;
    
    public function __construct ($start = 0) 
    {
        if ($start) {
            $this->start();
        }
    }

    /**
     * inicializa el tiempo
     */
    public function start() 
    {
        $this->start = $this->getTime();
        $this->pauseTime = 0;
    }

    /**
     * pausa el tiempo
     */
    public function pause()
    {
        $this->pauseTime = $this->getTime();
    }

    /**
     * reanuda el tiempo
     */
    public function unPause()
    {
        $this->start += ($this->getTime() - $this->pauseTime);
        $this->pauseTime = 0;
    }

    /**
     * get el valor del tiempo
     */
    public function get($decimals = 8)
    {   
        return round(($this->getTime() - $this->start), $decimals);
    }

    /**
     * formateo del tiempo en segundos
     */
    public function getTime()
    {
        list($usec,$sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    }
}