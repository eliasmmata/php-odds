<?php 
namespace BesoccerOdds\Models;

use BesoccerOdds\Classes\Model;
use BesoccerOdds\Classes\Mysql_db;

    class TestModel extends Model {

        public $deep;
        public $bigData;
    
        public function __construct()
        {
            $this->deep = '';
            $this->bigData = '';
        }

        public function setDeep() {
            $dbDeep = new Mysql_db('deep');
            $this->deep = $dbDeep;                        
        }

        public function getDeep() {                        
            return $this->deep;
        }

        public function setBigdata() {
            $dbBigdata = new Mysql_db();
            $this->bigData = $dbBigdata;                        
        }

        public function getBigData() {                        
            return $this->bigData;
        }
    }
?>