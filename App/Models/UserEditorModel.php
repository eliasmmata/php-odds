<?php 
namespace BesoccerOdds\Models;

use BesoccerOdds\Classes\Model;
use BesoccerOdds\Classes\Mysql_db;

    class UserEditorModel extends Model {

        public static function getUser($con) {            
            $sql = "SELECT * FROM editor_users LIMIT 5";            
            $data['data'] = $con->query($sql);
            $data['sql'] = $con->sql;
            return $data; 
        }       
    }
?>