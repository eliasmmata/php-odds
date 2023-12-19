<?php 

/**
 * Clase padre para gestionar los models
 * @author Pablo Muñoz
 */

namespace BesoccerOdds\Classes;

class Model {
        
    private $name;
    private $db1;
    private $db2;
    private $db3;

    public function __construct() {
        $this->name = '';
        $this->db1 = '';
        $this->db2 = '';
        $this->db3 = '';
    }        

    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }

    public function getDB1() {
        return $this->db1;
    }

    public function setDB1($db) {
        $this->db1 = $db;
    }

    public function getDB2() {
        return $this->db2;
    }

    public function setDB2($db) {
        $this->db2 = $db;
    }

    public function getDB3() {
        return $this->db3;
    }

    public function setDB3($db) {
        $this->db3 = $db;
    }

}

?>